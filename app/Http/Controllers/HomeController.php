<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Show;
use App\Models\User;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Helpers;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $movies_now_showing = Movie::where('status', 'active')->whereDate('release_date', '<=', Carbon::now())->orderBy('movie_id', 'DESC')->get();
        $movies_up_comming = Movie::where('status', 'active')->whereDate('release_date', '>', Carbon::now())->orderBy('movie_id', 'DESC')->get();
        return view('cinema.home.index', compact('movies_now_showing', 'movies_up_comming'));
    }
    
    public function showAbout()
    {
        return view('cinema.home.about');
    }


    public function showContact()
    {
        return view('cinema.home.contact');
    }

    public function searchMovie(Request $request)
    {
        $keyword = $request->keyword;
        $movies = Movie::orwhere('title', 'like', '%' . $keyword . '%')
            ->orwhere('slug', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);
        return view('cinema.movie.search', compact('movies', 'keyword'));
    }

    public function showListMovie(Request $request)
    {
        $movies = Movie::orderBy('movie_id', 'DESC')->paginate(12);
        return view('cinema.movie.list', compact('movies'));
    }

    public function showMovieDetail($slug)
    {
        $movie = Movie::getBySlug($slug);
        if (!$movie) {
            abort(404);
        }
        return view('cinema.movie.detail', compact('movie'));
    }

    public function showMovieByCategory(Request $request, $slug)
    {
        $category = Category::getBySlug($slug);
        $movies = $category->movies()->paginate(12);
        return view('shop.product.index', compact('movies', 'category'));
    }

    public function showLogin()
    {
        return view('cinema.auth.login');
    }

    public function showRegister()
    {
        return view('cinema.auth.register');
    }


    public function chooseShow(Request $request, $movieId) {
        $movie = Movie::find($movieId);

        if(!$movie) {
            return abort(404);
        }
        $selected_date = Carbon::today('Asia/Ho_Chi_Minh');
        
        if($request->method() === "POST") {
            $selected_date = Carbon::parse($request->input('date'));
        }

        $list_date = Show::where([
            ['movie_id' , '=', $movie->movie_id],
            ['status', '=', 'active'],
        ])->whereDate('date', '>=', Carbon::today('Asia/Ho_Chi_Minh'))->groupBy('date')->get()->pluck('date');

        $list_shows = Show::where([
            ['movie_id' , '=', $movie->movie_id],
            ['status', '=', 'active'],
        ])->whereDate('date', '=', $selected_date)->get();

        return view('cinema.booking.choose-show', compact('movie', 'list_shows', 'selected_date', 'list_date'));
    }

    public function chooseSeat(Request $request, $movieId, $showId) {
        $movie = Movie::find($movieId);
        $show = Show::find($showId);
        
        if(!$movie || !$show) {
            return abort(404);
        }

        Helpers::disableUnpaidSeat();

        $all_seats = Seat::where('room_id', $show->room->room_id)->orderBy('name', 'DESC')->get();

        $group_seat = $all_seats->reduce(function ($carry, $seat) {
            $first_letter = $seat['name'][0];

            if ( !isset($carry[$first_letter]) ) {
                $carry[$first_letter] = [];
            }
    
            $carry[$first_letter][] = $seat;
    
            return $carry;    
        }, []);


        return view('cinema.booking.choose-seat', compact('movie', 'show', 'group_seat'));
    }

    public function getSeatIds(Request $request, $movieId, $showId) {
        $movie = Movie::find($movieId);
        $show = Show::find($showId);
        
        if(!$movie || !$show) {
            return abort(404);
        }

        $seat_ids = explode(',', $request->input('seat_ids'));
        $seats = Seat::find($seat_ids);

        $request->session()->put('movie', $movie);
        $request->session()->put('show', $show);
        $request->session()->put('seats', $seats);
        return redirect()->route('cinema.booking.payment');
    }

    public function showPayment(Request $request) {
        $movie = $request->session()->get('movie');
        $show = $request->session()->get('show');
        $seats = $request->session()->get('seats');

        if(!$movie  || !$show || !$seats) {
            return abort(404);
        }

        $group_seat = $seats->reduce(function ($carry, $seat) {
            $type_seat_name = $seat->typeSeat->name;

            if ( !isset($carry[$type_seat_name]) ) {
                $carry[$type_seat_name] = [];
            }
    
            $carry[$type_seat_name][] = $seat;
    
            return $carry;    
        }, []);

        return view('cinema.booking.payment', compact('movie', 'show', 'seats', 'group_seat'));
    }

    public function payment(Request $request) {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'telephone' => 'numeric|required',
            'email' => 'string|email|required',
            'movie_id' => 'required|integer|exists:movies,movie_id',
            'show_id' => 'required|integer|exists:shows,show_id',
            'seat_ids' => 'required'
        ]);

        $movie = Movie::find($request->input('movie_id'));
        $show = Show::find($request->input('show_id'));
        
        $seat_ids = explode(',', $request->input('seat_ids'));
        $seats = Seat::find($seat_ids);

        if(!$movie || !$show || count($seat_ids) === 0) {
            return abort(404);
        }

        try {
            DB::transaction(function() use($request, $seats, $show, $movie) {
                foreach($seats as $seat) {
                    if($seat->isFree($show->show_id) === false) throw new \Exception('Gh??? ???? c?? ng?????i ?????t');
                }

                $booking = new Booking();
                $booking['booking_number'] = Helpers::generateOrderNumber(Booking::count());
                $booking["first_name"] = $request->input("first_name");
                $booking["last_name"] = $request->input("last_name");
                $booking["telephone"] = $request->input("telephone");
                $booking["email"] = $request->input("email");
                $booking["payment_method"] = 'offline';
                $booking["show_id"] = $show->show_id;
                $booking["status"] = 'unpaid';
                $booking['user_id'] = Auth::id();
                $booking->save();

                $tickeds = [];
                $amount = 0;
                foreach ($seats as $seat) {
                    $price = $seat->typeSeat->price + $show->room->price;
                    $amount += $price;

                    $tickeds[] = [
                        'price' => $price,
                        'booking_id' => $booking->booking_id,
                        'seat_id' => $seat->seat_id,
                        'show_id' => $show->show_id,
                        'status' => 'active',
                    ];
                }

                Ticket::insert($tickeds);
                $booking->fill([
                    'amount' => $amount,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString(),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
                    ])->save();

                $request->session()->put('movie', $movie);
                $request->session()->put('show', $show);
                $request->session()->put('booking', $booking);

            });
        } catch (\Exception $e) {
            $request->put('error_booking', true);
            return redirect()->route('cinema.booking.failed')->with('error', $e->getMessage());
        }
        return redirect()->route('cinema.booking.success');
    }

    public function showBookingSuccess(Request $request) {
        $movie = $request->session()->pull('movie');
        $show = $request->session()->pull('show');
        $booking = $request->session()->pull('booking');

        if(!$booking) {
            return redirect()->route('cinema.booking.list');
        }

        return view('cinema.booking.success', compact('movie', 'show', 'booking'));
    }

    public function showBookingFailed(Request $request) {
        $isHasError = $request->session()->pull('error_booking');

        if(!$isHasError) {
            return redirect()->route('cinema.home');
        }

        return view('cinema.booking.failed');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('cinema.user.profile', compact('user'));
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('shop.user.change-password', compact('user'));
    }

    public function getBookingList()
    {
        Helpers::disableUnpaidSeat();
        $bookings = Booking::getListBooking();
        return view('cinema.booking.list', compact('bookings'));
    }

    public function getDetailBooking($id)
    {
        Helpers::disableUnpaidSeat();
        $booking = Booking::find($id);

        if(!$booking) {
            return abort(404, 'M?? ????n ?????t h??ng kh??ng t???n t???i');
        }

        return view('cinema.booking.detail', compact('booking'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $messages = [
            'firstname.string' => 'T??n ph???i l?? chu???i k?? t???',
            'firstname.required' => 'T??n kh??ng ???????c b??? tr???ng',
            'firstname.max' => 'T??n kh??ng ???????c v?????t qu?? 100 k?? t???',
            'lastname.string' => 'H??? ph???i l?? chu???i k?? t???',
            'lastname.required' => 'H??? kh??ng ???????c b??? tr???ng',
            'lastname.max' => 'H??? kh??ng ???????c v?????t qu?? 100 k?? t???',
            'email.required' => 'Email kh??ng ???????c b??? tr???ng',
            'email.email' => 'Email kh??ng h???p l???',
            'email.unique' => 'Email kh??ng c?? s???n',
            'telephone.required' => 'S??? ??i???n tho???i kh??ng ???????c b??? tr???ng',
            'telephone.string' => 'S??? ??i???n tho???i ph???i l?? chu???i k?? t???',
            'telephone.min' => 'S??? ??i???n tho???i kh??ng ???????c nh??? h??n 10 k?? t???',
            'telephone.max' => 'S??? ??i???n tho???i kh??ng ???????c l???n h??n 10 k?? t???',
        ];

        $this->validate($request, [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'telephone' => 'required|string|min:10|max:10',
        ], $messages);

        if ($request->email != $user->email) {
            $this->validate($request, ['email' => 'required|email|unique:users,email,' . $user->email], $messages);
        }
        $data = $request->all();

        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'C???p nh???t t??i kho???n th??nh c??ng.');
        } else {
            request()->session()->flash('error', 'C?? l???i x???y ra, vui l??ng th??? l???i!');
        }
        return redirect()->route('cinema.profile');
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $messages = [
            'oldpassword.required' => 'M???t kh???u hi???n t???i kh??ng ???????c b??? tr???ng',
            'oldpassword.string' => 'M???t kh???u hi???n t???i ph???i l?? chu???i k?? t???',
            'password.required' => 'M???t kh???u m???i kh??ng ???????c b??? tr???ng',
            'password.string' => 'M???t kh???u m???i ph???i l?? chu???i k?? t???',
            'password.different' => 'M???t kh???u m???i ph???i kh??c v???i m???t kh???u hi???n t???i',
            'repassword.required' => 'M???t kh???u x??c nh???n kh??ng ???????c b??? tr???ng',
            'repassword.string' => 'M???t kh???u x??c nh???n ph???i l?? chu???i k?? t???',
            'repassword.same' => 'M???t kh???u x??c nh???n ph???i gi???ng v???i m???t kh???u m???i',
        ];

        $this->validate($request, [
            'oldpassword' => ['required', 'string', new MatchOldPassword],
            'password' => 'string|required|different:oldpassword',
            'repassword' => 'string|required|same:password',
        ], $messages);

        $user->password = Hash::make($request->password);
        $status = $user->save();

        if ($status) {
            request()->session()->flash('success', 'C???p nh???t m???t kh???u th??nh c??ng.');
        } else {
            request()->session()->flash('error', 'C?? l???i x???y ra, vui l??ng th??? l???i!');
        }
        return redirect()->route('cinema.change-password-profile');
    }

    public function updateAvatar(Request $request)
    {
        $user = User::find(Auth::id());
        $currentAvatar = $user->avatar;
        $messages = [
            'avatar.required' => 'Ch??a ch???n ???nh',
            'avatar.image' => 'T???p tin ph???i l?? ???nh',
            'avatar.mimes' => '?????nh d???nh ???nh kh??ng cho ph??p'
        ];
        $this->validate($request, ['avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|required'], $messages);
        $image = $request->file('avatar');
        $storedPath = $image->move('images/avatar', Str::uuid() . '.' . $image->extension());
        $user->avatar = $storedPath;
        $status = $user->save();
        if ($status) {
            if ($currentAvatar != $storedPath) {
                Storage::delete($currentAvatar);
            }
            request()->session()->flash('success', 'C???p nh???t ???nh ?????i di???n th??nh c??ng.');
        } else {
            request()->session()->flash('error', 'C?? l???i x???y ra, vui l??ng th??? l???i!');
        }
        return redirect()->route('cinema.profile');
    }
}
