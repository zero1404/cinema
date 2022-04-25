<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::orderBy('actor_id', 'DESC')->get();
        return view('dashboard.actor.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.actor.create');
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
            'first_name.required' => 'Tên không được bỏ trống',
            'first_name.string' => 'Tên phải là chuỗi kí tự',
            'first_name.min' => 'Tên phải bao gồm ít nhất 1 kí tự',
            'first_name.max' => 'Tên không được lớn hơn 30 kí tự',
            'last_name.required' => 'Họ không được bỏ trống',
            'last_name.string' => 'Họ phải là chuỗi kí tự',
            'last_name.min' => 'Họ phải bao gồm ít nhất 1 kí tự',
            'last_name.max' => 'Họ không được lớn hơn 80 kí tự',
            'avatar.string' => 'Ảnh phải là chuỗi kí tự',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
        ];

        $this->validate($request, [
            'first_name' => 'required|string|min:1|max:30',
            'last_name' => 'required|string|min:1|max:80',
            'avatar' => 'nullable|string',
            'description' => 'nullable|string',
        ], $messages);

        $data = $request->all();
        $status = Actor::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo diễn viên thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('actor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return abort(404, 'Mã ngôn ngữ không tồn tại');
        }

        return view('dashboard.actor.detail', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return abort(404, 'Mã diễn viên không tồn tại');
        }

        return view('dashboard.actor.edit', compact('actor'));
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
        $actor = Actor::find($id);

        if (!$actor) {
            return abort(404, 'Mã diễn viên không tồn tại');
        }

        $messages = [
            'first_name.required' => 'Tên không được bỏ trống',
            'first_name.string' => 'Tên phải là chuỗi kí tự',
            'first_name.min' => 'Tên phải bao gồm ít nhất 1 kí tự',
            'first_name.max' => 'Tên không được lớn hơn 30 kí tự',
            'last_name.required' => 'Họ không được bỏ trống',
            'last_name.string' => 'Họ phải là chuỗi kí tự',
            'last_name.min' => 'Họ phải bao gồm ít nhất 1 kí tự',
            'last_name.max' => 'Họ không được lớn hơn 80 kí tự',
            'avatar.string' => 'Ảnh phải là chuỗi kí tự',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
        ];

        $this->validate($request, [
            'first_name' => 'required|string|min:1|max:30',
            'last_name' => 'required|string|min:1|max:80',
            'avatar' => 'nullable|string',
            'description' => 'nullable|string',
        ], $messages);

        $data = $request->all();
        $status = $actor->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật diễn viên thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('actor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return abort(404, 'Mã diễn viên không tồn tại');
        }

        try {
            $status = $actor->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá diễn viên thành công.');
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

        return redirect()->route('actor.index');
    }
}
