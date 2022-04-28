<?php

namespace App\Http\Controllers;

use App\Models\TypeSeat;
use Illuminate\Http\Request;

class TypeSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seats = TypeSeat::orderBy('type_seat_id', 'DESC')->get();
        return view('dashboard.type-seat.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.type-seat.create');
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
            'price.numeric' => 'Gía phải là số',
        ];

        $this->validate($request, [
            'name' => 'required|string|max:50',
            'price' => 'nullable|numeric',
        ], $messages);

        $data = $request->all();
        $status = TypeSeat::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo loại ghế thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('type-seat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type_seat = TypeSeat::find($id);

        if (!$type_seat) {
            return abort(404, 'Mã loại ghế không tồn tại');
        }

        return view('dashboard.type-seat.detail', compact('type_seat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_seat = TypeSeat::find($id);

        if (!$type_seat) {
            return abort(404, 'Mã loại ghế không tồn tại');
        }

        return view('dashboard.type-seat.edit', compact('type_seat'));
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
        $type_seat = TypeSeat::find($id);

        if (!$type_seat) {
            return abort(404, 'Mã loại ghế không tồn tại');
        }

        $messages = [
            'name.required' => 'Tên không được bỏ trống',
            'name.string' => 'Tên phải là chuỗi kí tự',
            'name.max' => 'Tên không được lớn hơn 50 kí tự',
            'price.numeric' => 'Gía phải là số',
        ];

        $this->validate($request, [
            'name' => 'required|string|max:50',
            'price' => 'nullable|numeric',
        ], $messages);

        $data = $request->all();
        $status = $type_seat->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật loại ghế thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('type-seat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type_seat = TypeSeat::find($id);

        if (!$type_seat) {
            return abort(404, 'Mã loại ghế không tồn tại');
        }

        try {
            $status = $type_seat->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá loại ghế thành công.');
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

        return redirect()->route('type-seat.index');
    }
}
