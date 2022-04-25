<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('user_id', 'DESC')->get();
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create');
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
            'first_name.string' => 'Tên phải là chuỗi kí tự',
            'first_name.required' => 'Tên không được bỏ trống',
            'first_name.max' => 'Tên không được vượt quá 100 kí tự',
            'last_name.string' => 'Họ phải là chuỗi kí tự',
            'last_name.required' => 'Họ không được bỏ trống',
            'last_name.max' => 'Họ không được vượt quá 100 kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email không có sẵn',
            'telephone.required' => 'Số điện thoại không được bỏ trống',
            'telephone.string' => 'Số điện thoại phải là chuỗi kí tự',
            'telephone.min' => 'Số điện thoại không được nhỏ hơn 10 kí tự',
            'telephone.max' => 'Số điện thoại không được lớn hơn 10 kí tự',
            'password.required' => 'Mật khẩu thoại không được bỏ trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.string' => 'Mật khẩu xác nhận phải là chuỗi kí tự',
            'repassword.same' => 'Mật khẩu xác nhận không giống với mật khẩu',
            'role.required' => 'Chưa chọn vai trò',
            'role.in' => 'Vai trò không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate(
            $request,
            [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'password' => 'required|string',
                'repassword' => 'required|string|same:password',
                'avatar' => 'nullable|string',
                'email' => 'required|email|unique:users',
                'telephone' => 'required|string|max:10',
                'role' => 'required|in:admin,customer',
                'status' => 'required|in:active,inactive',
            ],
            $messages
        );
        $data = $request->all();

        if (!$request->input('avatar')) {
            $data['avatar'] = env('DEFAULT_URL_AVATAR');
        }

        $data['password'] = Hash::make($request->password);
        $data['birthday'] = \Carbon\Carbon::parse($request->input('birthday'));
        $data['gender'] = $request->input('gender') == 'male';
        $status = User::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'Mã tài khoản không tồn tại');
        }

        return view('dashboard.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'Tài khoản không tồn tại');
        }

        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'Mã tài khoản không tồn tại');
        }

        $messages = [
            'first_name.string' => 'Tên phải là chuỗi kí tự',
            'first_name.required' => 'Tên không được bỏ trống',
            'first_name.max' => 'Tên không được vượt quá 100 kí tự',
            'last_name.string' => 'Họ phải là chuỗi kí tự',
            'last_name.required' => 'Họ không được bỏ trống',
            'last_name.max' => 'Họ không được vượt quá 100 kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email không có sẵn',
            'telephone.required' => 'Số điện thoại không được bỏ trống',
            'telephone.string' => 'Số điện thoại phải là chuỗi kí tự',
            'telephone.min' => 'Số điện thoại không được nhỏ hơn 10 kí tự',
            'telephone.max' => 'Số điện thoại không được lớn hơn 10 kí tự',
            'password.required' => 'Mật khẩu thoại không được bỏ trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.string' => 'Mật khẩu xác nhận phải là chuỗi kí tự',
            'repassword.same' => 'Mật khẩu xác nhận không giống với mật khẩu',
            'role.required' => 'Chưa chọn vai trò',
            'role.in' => 'Vai trò không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'avatar' => 'nullable|string',
            'email' => 'required|email',
            'telephone' => 'required|string|max:10',
            'role' => 'required|in:admin,customer',
            'status' => 'required|in:active,inactive',
        ], $messages);

        if ($request->input('email') != $user->email) {
            $this->validate($request, [
                'email' => 'required|email|unique:users',
            ], $messages);
        }

        $data = $request->all();

        $data['password'] = $user->password;

        if ($request->input('password')) {
            $this->validate($request, [
                'password' => 'required|string',
                'repassword' => 'required|string|same:password',
            ], $messages);
            $data['password'] = Hash::make($request->input('password'));
        }

        if (!$request->input('avatar')) {
            $data['avatar'] = env('DEFAULT_URL_AVATAR');
        }

        $data['birthday'] = \Carbon\Carbon::parse($request->input('birthday'));
        $data['gender'] = $request->input('gender') == 'male';

        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('user.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'Mã tài khoản không tồn tại');
        }

        try {
            $status = $user->delete();
            if ($status) {
                request()->session()->flash('success', 'Xoá tài khoản thành công.');
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

        return redirect()->route('user.index');
    }
}
