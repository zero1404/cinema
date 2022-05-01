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
        $time_slots = TimeSlot::all();
        $shows = Show::where('movie_id', $movie->movie_id)->get();
        return view('dashboard.show.create', compact('shows', 'movie', 'rooms', 'time_slots'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
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
            'movie_id.required' => 'Mã phim không được bỏ trống',
            'movie_id.exists' => 'Mã phim không hợp lệ',
            'time_slot_id.required' => 'Mã khung giờ không được bỏ trống',
            'time_slot_id.exists' => 'Mã khung giờ không hợp lệ',
            'room_id.required' => 'Mã phòng không được bỏ trống',
            'room_id.exists' => 'Mã phòng không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'price.numeric' => 'Giá phải là số',
            'date.required' => 'Ngày chiếu không được bỏ trống',
            'date.date' => 'Ngày chiếu không hợp lệ'
        ];

        $this->validate($request, [
            'movie_id' => 'required|exists:movies,movie_id',
            'time_slot_id' => 'required|exists:time_slots,time_slot_id',
            'room_id' => 'required|exists:rooms,room_id',
            'status' => 'required|in:active,inactive',
            'price' => 'nullable|numeric',
            'date' => 'required|date',
        ], $messages);
        
        $data = $request->all();

        $isExist = Show::where([
            'movie_id' => $data["movie_id"],
            'time_slot_id' => $data["time_slot_id"]
        ])->get();

        if(count($isExist) > 0) {
            return redirect()->back()->with('error', 'Trùng khung giờ!');

        } else {
            $createdShow = Show::create($data);
        
            if ($createdShow) {
                request()->session()->flash('success', 'Tạo lịch chiếu thành công.');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        
            return redirect()->route('show.index');
        }

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

        $rooms = Room::all();
        $time_slots = TimeSlot::all();
        return view('dashboard.show.edit', compact('show', 'rooms', 'time_slots'));
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
            'movie_id.required' => 'Mã phim không được bỏ trống',
            'movie_id.exists' => 'Mã phim không hợp lệ',
            'time_slot_id.required' => 'Mã khung giờ không được bỏ trống',
            'time_slot_id.exists' => 'Mã khung giờ không hợp lệ',
            'room_id.required' => 'Mã phòng không được bỏ trống',
            'room_id.exists' => 'Mã phòng không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'price.numeric' => 'Giá phải là số',
            'date.required' => 'Ngày chiếu không được bỏ trống',
            'date.date' => 'Ngày chiếu không hợp lệ'
        ];

        $this->validate($request, [
            'movie_id' => 'required|exists:movies,movie_id',
            'time_slot_id' => 'required|exists:time_slots,time_slot_id',
            'room_id' => 'required|exists:rooms,room_id',
            'status' => 'required|in:active,inactive',
            'price' => 'nullable|numeric',
            'date' => 'required|date',
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
