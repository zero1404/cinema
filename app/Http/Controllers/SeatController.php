<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Room;
use App\Models\TypeSeat;
use Illuminate\Http\Request;

class seatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seats = Seat::orderBy('seat_id', 'DESC')->get();
        return view('dashboard.seat.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();
        $type_seats = TypeSeat::all();
        return view('dashboard.seat.create', compact('rooms', 'type_seats'));
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
            'name.max' => 'Tên không được lớn hơn 50 kí tự',
            'type_seat_id.required' => 'Mã loại ghế không được bỏ trống',
            'type_seat_id.exists' => 'Mã loại ghế không hợp lệ',
            'room_id.required' => 'Mã phòng không được bỏ trống',
            'room_id.exists' => 'Mã phòng không hợp lệ'
        ];

        $this->validate($request, [
            'name' => 'required|string|max:50',
            'room_id' => 'required|exists:rooms,room_id',
            'type_seat_id' => 'required|exists:type_seats,type_seat_id',
        ], $messages);

        $data = $request->all();
        $status = Seat::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo ghế thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('seat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seat = Seat::find($id);

        if (!$seat) {
            return abort(404, 'Mã ghế không tồn tại');
        }

        return view('dashboard.seat.detail', compact('seat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seat = Seat::find($id);

        if (!$seat) {
            return abort(404, 'Mã ghế không tồn tại');
        }

        $rooms = Room::all();
        $type_seats = TypeSeat::all();
        return view('dashboard.seat.edit', compact('seat', 'rooms', 'type_seats'));
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
        $seat = Seat::find($id);

        if (!$seat) {
            return abort(404, 'Mã ghế không tồn tại');
        }

        $messages = [
            'name.required' => 'Tên không được bỏ trống',
            'name.string' => 'Tên phải là chuỗi kí tự',
            'name.max' => 'Tên không được lớn hơn 50 kí tự',
            'type_seat_id.required' => 'Mã loại ghế không được bỏ trống',
            'type_seat_id.exists' => 'Mã loại ghế không hợp lệ',
            'room_id.required' => 'Mã phòng không được bỏ trống',
            'room_id.exists' => 'Mã phòng không hợp lệ'
        ];

        $this->validate($request, [
            'name' => 'required|string|max:50',
            'room_id' => 'required|exists:rooms,room_id',
            'type_seat_id' => 'required|exists:type_seats,type_seat_id',
        ], $messages);

        $data = $request->all();
        $status = $seat->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật ghế thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('seat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seat = Seat::find($id);

        if (!$seat) {
            return abort(404, 'Mã ghế không tồn tại');
        }

        try {
            $status = $seat->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá ghế thành công.');
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

        return redirect()->route('seat.index');
    }
}
