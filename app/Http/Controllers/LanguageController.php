<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('language_id', 'DESC')->get();
        return view('dashboard.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.language.create');
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
        $status = Language::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo ngôn ngữ thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('language.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return abort(404, 'Mã ngôn ngữ không tồn tại');
        }

        return view('dashboard.language.detail', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return abort(404, 'Mã ngôn ngữ không tồn tại');
        }

        return view('dashboard.language.edit', compact('language'));
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
        $language = Language::find($id);

        if (!$language) {
            return abort(404, 'Mã ngôn ngữ không tồn tại');
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
        $status = $language->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật ngôn ngữ thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }

        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return abort(404, 'Mã ngôn ngữ không tồn tại');
        }

        try {
            $status = $language->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xoá ngôn ngữ thành công.');
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

        return redirect()->route('language.index');
    }
}
