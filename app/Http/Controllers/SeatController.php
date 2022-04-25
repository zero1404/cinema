<?php

namespace App\Http\Controllers;

use App\Models\Seat;
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
        return view('dashboard.seat.create');
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
        ];

        $this->validate($request, [
            'name' => 'required|string|max:50',
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

        return view('dashboard.seat.edit', compact('seat'));
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
        ];

        $this->validate($request, [
            'name' => 'required|string|max:50',
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
