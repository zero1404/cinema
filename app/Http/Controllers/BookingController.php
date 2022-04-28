<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Helpers;

class BookingController extends Controller
{
    public function __construct()
    {
        Helpers::disableUnpaidSeat();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::orderBy('booking_id', 'DESC')->get();
        return view('dashboard.booking.index', compact('bookings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);

        if(!$booking) {
            return abort(404, 'Mã đơn đặt hàng không tồn tại');

        }

        return view('dashboard.booking.detail', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::find($id);

        if(!$booking) {
            return abort(404, 'Mã đơn đặt hàng không tồn tại');

        }

        return view('dashboard.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if(!$booking) {
            return abort(404, 'Mã đơn đặt hàng không tồn tại');

        }

        $messages = [
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate($request, [
            'status' => 'required|in:paid,unpaid,canceled',
        ], $messages);

        $data = $request->all();
        $data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        
        $status = $booking->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật đơn hàng thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('booking.index');
    }
}
