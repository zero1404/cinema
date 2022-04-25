<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('room_id', 'DESC')->get();
        return view('dashboard.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seats = Seat::all();
        return view('dashboard.room.create', compact('seats'));
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

        $createdRoom = Room::create($data);

        if ($createdRoom) {
            request()->session()->flash('success', 'Tạo phòng thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return abort(404, 'Mã phòng không tồn tại');
        }

        return view('dashboard.room.detail', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return abort(404, 'Mã phòng không tồn tại');
        }

        $seats = Seat::all();
        return view('dashboard.room.edit', compact('room', 'seats'));
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
        $room = Room::find($id);

        if (!$room) {
            return abort(404, 'Mã phòng không tồn tại');
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

        $updatedRoom = $room->fill($data)->save();

        if ($updatedRoom) {
            request()->session()->flash('success', 'Cập nhật phòng thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return abort(404, 'Mã phòng không tồn tại');
        }

        try {
            $status = $room->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá phòng thành công.');
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

        return redirect()->route('room.index');
    }
}
