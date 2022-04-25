@extends('dashboard.layouts.app')
@section('title', 'Thông báo')

@php
$breadcrumbs = [
[
'name' => 'Thông báo',
'url' => route('dashboard.notification.index'),
'active' => true
]
];
$notifications = Auth::user()->notifications()->paginate(15);
@endphp

@section('content')
<div class="d-flex justify-content-between align-items-center pt-4 pb-2 pb-md-4">
  <div class="mb-n4">
    <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  </div>
  <div class="d-block d-sm-flex">
    <div class="mb-3 mb-md-0"><button type="button"
        class="btn btn-gray-800 d-inline-flex alignpitems-center dropdown-toggle arrow-none" data-bs-toggle="dropdown"
        aria-expanded="false">Tuỳ chọn <svg class="icon icon-xs ms-2" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg></button>
      <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1" style="">
        <a class="dropdown-item d-flex align-items-center" href="#" id="actionMultiMark"><svg
            class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z"
              clip-rule="evenodd"></path>
          </svg> Đánh dấu đã đọc </a>
        <div role="separator" class="dropdown-divider my-1"></div><a class="dropdown-item d-flex align-items-center"
          href="#" id="actionMultiDelete"><svg class="dropdown-icon text-danger me-2" fill="currentColor"
            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd"></path>
          </svg> Xoá</a>
      </div>
    </div>
  </div>
</div>

<div class="message-wrapper border-0 bg-white shadow rounded mb-4">
  @forelse ($notifications as $notification)
  <div class="card hover-state border-bottom rounded-0 rounded-top py-3">
    <div class="card-body d-flex align-items-center flex-wrap flex-lg-nowrap py-0">
      <div class="col-1 align-items-center px-0 d-none d-lg-flex">
        <div class="form-check inbox-check me-2 mb-0"><input class="form-check-input" type="checkbox"
            value="{{ $notification->id }}">
        </div>
        <svg id="notify-{{ $notification->id }}"
          class="icon icon-sm rating-star d-none d-lg-inline-block @if($notification->unread()) text-warning @endif"
          fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
          </path>
        </svg>
      </div>
      <div class="col-10 col-lg-2 ps-0 ps-lg-3 pe-lg-3"><a
          href="{{ route('dashboard.notification.show', $notification->id)}}" class="d-flex align-items-center"><i
            class="fas {{ $notification->data['fas']}} mx-2"></i><span class="h6 fw-bold mb-0">{{
            $notification->data['content']}}</span></a></div>
      <div class="col-2 col-lg-2 d-flex align-items-center justify-content-end px-0 order-lg-4">
        <div class="text-muted small d-none d-lg-block">{{ $notification->created_at->format('d/m/Y - H:i') }}</div>
        <div class="dropdown ms-3"><button type="button" class="btn btn-sm fs-6 px-1 py-0 dropdown-toggle"
            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><svg class="icon icon-xs"
              fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
              </path>
            </svg></button>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1" style=""><a
              class="dropdown-item d-flex align-items-center" href="javascript:void(0)"
              onclick="handleMarkAsRead({ids:'{{$notification->id}}' })"><svg class="dropdown-icon text-gray-400 me-2"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z"
                  clip-rule="evenodd"></path>
              </svg> Đánh dấu đã đọc </a>
            <div role="separator" class="dropdown-divider my-1"></div><a class="dropdown-item d-flex align-items-center"
              href="javascript:void(0)" onclick="handleDeleteNotify({ids:'{{$notification->id}}' })"><svg
                class="dropdown-icon text-danger me-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"></path>
              </svg> Xoá</a>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-7 d-flex align-items-center mt-3 mt-lg-0 ps-0"><a
          href="{{ route('dashboard.notification.show', $notification->id)}}"
          class="fw-normal text-gray-600-900 truncate-text"><span class="fw-bold ps-lg-5">{{
            $notification->data['content']}}</span></a></div>
    </div>
  </div>
  <div class="row p-4">
    <span style="float:right">{{$notifications->links('dashboard.layouts.pagination')}}</span>
  </div>
  @empty
  <p class='py-4 text-center'>Không có thông báo</p>
  @endforelse
</div>
</div>
@endsection

@push('scripts')
<script>
  $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const handleDeleteNotify = (ids) => {
    Swal.fire({
        title: "Bạn có muốn xoá?",
        text: "Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xác nhận",
        cancelButtonText: "Huỷ",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: `{{route('dashboard.notification.destroy')}}`,
                data: {
                    ids,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (error) {
                    location.reload();
                },
            });
        }
    });
};

const handleMarkAsRead = (ids) => {
    $.ajax({
        type: "post",
        url: `{{route('dashboard.notification.mark-as-read')}}`,
        data: {
            ids,
        },
        success: function (response) {
            for (const notify of response.data) {
                $(`#notify-${notify}`).removeClass("text-warning");
            }

            $("input[type=checkbox]:checked").each(function (i) {
                if (response.data.includes($(this).val())) {
                    $(this).prop("checked", false);
                }
            });
        },
        error: function (error) {},
    });
};

const getSelectedCheckbox = () => {
    const value = [];
    $("input[type=checkbox]:checked").each(function (i) {
        value[i] = $(this).val();
    });
    return value;
};

$(function () {
    $("#actionMultiMark").click(function () {
        handleMarkAsRead(getSelectedCheckbox());
    });

    $("#actionMultiDelete").click(function () {
        handleDeleteNotify(getSelectedCheckbox());
    });
});

</script>
@endpush