@extends('dashboard.layouts.app')
@section('title', 'Quản Lý Tài Khoản')

@section('content')

@php
$breadcrumbs = [
[
'name' => 'Danh sách tài khoản',
'url' => route('user.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'fullname' => 'Họ Tên',
'email' => 'Email',
'gender' => 'Giới tính',
'role' => 'Chức Vụ',
'status' => 'Trạng Thái',
'action' => '',
];
@endphp
<div class="py-4">
    <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
    <x-Dashboard.Shared.ButtonCreate name='Taọ Tài Khoản' url='user.create' />
</div>

<x-Dashboard.Tables.Table name="tài khoản" :columns="$columns" create="user.create" :value="$users">
    @foreach ($users as $user)
    <tr>
        <td>
            {{ $user->user_id }}
        </td>
        <td>
            <div class="d-flex align-items-center">
                <img class="rounded-circle" src="{{Helpers::getUserAvatar($user->avatar)}}" style="max-width:50px"
                    alt="Avatar">

                <span class="mx-2">{{ $user->fullname }}</span>
            </div>
        </td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->gender == 'male' ? 'Nam' : 'Nữ' }}</td>
        <td class="text-center">
            @if ($user->role == 'admin')
            <span class="badge badge-sm ms-1 bg-success">Admin</span>
            @else
            <span class="badge badge-sm ms-1 bg-primary">Khách hàng</span>
            @endif
        </td>
        <td class="text-center">
            @if ($user->status == 'active')
            <span class="badge badge-sm ms-1 bg-success">Hoạt động</span>
            @else
            <span class="badge badge-sm ms-1 bg-danger">Khoá</span>
            @endif
        </td>
        <td>
            <x-Dashboard.Shared.ButtonAction :id="$user->user_id" show="user.show" edit="user.edit" delete="user.destroy" />
        </td>
    </tr>
    @endforeach
</x-Dashboard.Tables.Table>
@endsection