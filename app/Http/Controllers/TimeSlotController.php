<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time_slots = TimeSlot::orderBy('time_slot_id', 'DESC')->get();
        return view('dashboard.time-slot.index', compact('time_slots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.time-slot.create');
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
            'time_start.required' => 'Giờ bắt đầu không được bỏ trống',
            'time_start.string' => 'Giờ bắt đầu phải là chuỗi kí tự',
            'time_end.required' => 'Giờ kết thúc không được bỏ trống',
            'time_end.string' => 'Giờ kết thúc phải là chuỗi kí tự',
        ];

        $this->validate($request, [
            'time_start' => 'required|string',
            'time_end' => 'required|string',
        ], $messages);

        $data = $request->all();
        $status = TimeSlot::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo khung giờ thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('time-slot.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time_slot = TimeSlot::find($id);

        if (!$time_slot) {
            return abort(404, 'Mã khung giờ không tồn tại');
        }

        return view('dashboard.time-slot.detail', compact('time_slot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time_slot = TimeSlot::find($id);

        if (!$time_slot) {
            return abort(404, 'Mã khung giờ không tồn tại');
        }

        return view('dashboard.time-slot.edit', compact('time_slot'));
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
        $time_slot = TimeSlot::find($id);

        if (!$time_slot) {
            return abort(404, 'Mã khung giờ không tồn tại');
        }

        $messages = [
            'time_start.required' => 'Giờ bắt đầu không được bỏ trống',
            'time_start.string' => 'Giờ bắt đầu phải là chuỗi kí tự',
            'time_end.required' => 'Giờ kết thúc không được bỏ trống',
            'time_end.string' => 'Giờ kết thúc phải là chuỗi kí tự',
        ];

        $this->validate($request, [
            'time_start' => 'required|string',
            'time_end' => 'required|string',
        ], $messages);

        $data = $request->all();
        $status = $time_slot->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật khung giờ thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('time-slot.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time_slot = TimeSlot::find($id);

        if (!$time_slot) {
            return abort(404, 'Mã khung giờ không tồn tại');
        }

        try {
            $status = $time_slot->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá khung giờ thành công.');
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

        return redirect()->route('time-slot.index');
    }
}
