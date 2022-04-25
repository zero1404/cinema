$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".btnDelete", function (e) {
        const form = $(this).closest("form");
        e.preventDefault();
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
                form.submit();
            }
        });
    });

    // Auto close flash message;
    setTimeout(function () {
        $(".alert").slideUp();
    }, 4000);

    const dataTableEl = d.getElementById("datatable");
    if (dataTableEl) {
        new simpleDatatables.DataTable(dataTableEl, {
            labels: {
                placeholder: "Tìm kiếm...",
                perPage: "{select} mục trên mỗi trang",
                noRows: "Danh sách trống",
                noResults:
                    "Không có kết quả nào phù hợp với truy vấn tìm kiếm của bạn",
                info: "Hiển thị {start} - {end} trong tổng {rows} dòng", //
            },
        });
    }

    $("#inputProvince").change(function () {
        const id = $(this).find("option:selected").val();
        $.ajax({
            type: "get",
            url: `${window.location.origin}/address/districts/${id}`,
            success: function (data) {
                const { districts } = data;
                const districtSelect = $("#inputDistrict");
                districtSelect.empty();

                const wardSelect = $("#inputWard");
                wardSelect.empty();

                districtSelect.append(
                    '<option value="">Chọn thành phố/quận</option>'
                );

                wardSelect.append('<option value="">Chọn phường/xã</option>');

                districts.forEach((district) => {
                    districtSelect.append(
                        `<option value="${district.id}">${district.name_with_type}</option>`
                    );
                });
            },
            error: function (error) {
                if (error.status === 401) {
                    window.location.href = "/login";
                    return;
                }
                notyf.open({
                    type: "error",
                    message: "Không thể lấy danh sách thành phố/quận!",
                    duration: 3000,
                });
            },
        });
    });

    $("#inputDistrict").change(function () {
        const id = $(this).find("option:selected").val();
        $.ajax({
            type: "get",
            url: `${window.location.origin}/address/wards/${id}`,
            success: function (data) {
                const { wards } = data;
                const wardSelect = $("#inputWard");
                wardSelect.empty();
                wardSelect.append('<option value="">Chọn phường/xã</option>');

                wards.forEach((ward) => {
                    wardSelect.append(
                        `<option value="${ward.id}">${ward.name_with_type}</option>`
                    );
                });
            },
            error: function (error) {
                if (error.status === 401) {
                    window.location.href = "/login";
                    return;
                }
                notyf.open({
                    type: "error",
                    message: "Không thể lấy danh sách thành phường/xã!",
                    duration: 3000,
                });
            },
        });
    });
});
