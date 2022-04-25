<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Movie;
use App\Models\Room;
use App\Models\TimeSlot;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Show::orderBy('show_id', 'DESC')->get();
        return view('dashboard.show.index', compact('shows'));
    }


    public function chooseMovie(){
        $movies = Movie::all();
        return view('dashboard.show.choose-movie', compact('movies'));
    }

    public function createShow($id) {
        $movie = Movie::find($id);

        if (!$movie) {
            return abort(404, 'Mã phim không tồn tại');
        }

        $rooms = Room::all();
        $time_slot = TimeSlot::where()
        return view('dashboard.show.create', compact('rooms'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::all();
        $rooms = Room::all();
        return view('dashboard.show.create', compact('movies', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'date.required' => 'Ngày không được bỏ trống',
            'date.date' => 'Tên phải là chuỗi kí tự',
            'total_seat.required' => 'Số ghế không được bỏ trống',
            'total_seat.integer' => 'Số ghê phải là số nguyên',
            'seat_id.required' => 'Mã ghế không được bỏ trống',
            'seat_id.exists' => 'Mã ghế không hợp lệ'
        ];

        $this->validate($request, [
            'name' => 'required|string',
            'total_seat' => 'required|integer',
            'seat_id' => 'required|exists:seats,seat_id'
        ], $messages);

        $data = $request->all();

        $createdShow = Show::create($data);

        if ($createdShow) {
            request()->session()->flash('success', 'Tạo lịch chiếu thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('show.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Show::find($id);

        if (!$show) {
            return abort(404, 'Mã lịch chiếu không tồn tại');
        }

        return view('dashboard.show.detail', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = Show::find($id);

        if (!$show) {
            return abort(404, 'Mã lịch chiếu không tồn tại');
        }

        $seats = Seat::all();
        return view('dashboard.show.edit', compact('show', 'seats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $show = Show::find($id);

        if (!$show) {
            return abort(404, 'Mã lịch chiếu không tồn tại');
        }

        $messages = [
            'name.required' => 'Tên không được bỏ trống',
            'name.string' => 'Tên phải là chuỗi kí tự',
            'total_seat.required' => 'Số ghế không được bỏ trống',
            'total_seat.integer' => 'Số ghê phải là số nguyên',
            'seat_id.required' => 'Mã ghế không được bỏ trống',
            'seat_id.exists' => 'Mã ghế không hợp lệ'
        ];

        $this->validate($request, [
            'name' => 'required|string',
            'total_seat' => 'required|integer',
            'seat_id' => 'required|exists:seats,seat_id'
        ], $messages);

        $data = $request->all();

        $updatedShow = $show->fill($data)->save();

        if ($updatedShow) {
            request()->session()->flash('success', 'Cập nhật lịch chiếu thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('show.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Show::find($id);

        if (!$show) {
            return abort(404, 'Mã lịch chiếu không tồn tại');
        }

        try {
            $status = $show->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá lịch chiếu thành công.');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ((int)$ex->errorInfo[0] === 23000) {
                request()->session()->flash('error', 'Không thể xoá vì tồn tại ràng buộc khoá ngoại!');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        }

        return redirect()->route('show.index');
    }
}
