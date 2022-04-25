const notyf = new Notyf({
    position: {
        x: "right",
        y: "top",
    },
    types: [
        {
            type: "info",
            background: "#82ae46",
        },
    ],
    duration: 3000,
});

const formatCurrency = (price) =>
    new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(price);

function addCart(id) {
    const cart_count = $("#cart_count");
    const regex = /^\/product\/.*$/g;
    let quantity = 1;
    const path = window.location.pathname;
    if (regex.test(path)) {
        quantity = $("#quantity").val();
    }

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "get",
        data: {
            quantity,
        },
        url: `${window.location.origin}/cart/${id}`,
        success: function (response) {
            const { count, isUpdate } = response;
            if (isUpdate) {
                cart_count.html(
                    `<span class="icon-shopping_cart"></span>[${count}]`
                );
            }
            notyf.open({
                type: "info",
                message: "Thêm vào giỏ hàng thành công",
            });

            const path = window.location.pathname.substr(1, 4);
            if (path === "cart" && count > 0) {
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        },
        error: function (error) {
            if (error.status === 401) {
                window.location.href = "/user/login";
                return;
            }
            notyf.open({
                type: "error",
                message: "Có lỗi xảy ra!",
                duration: 3000,
            });
        },
    });
}

let timeout = null;

function updateCart(event, id) {
    clearTimeout(timeout);
    timeout = setTimeout(function () {
        const quantity = parseInt(event.target.value);
        if (quantity == 0) {
            notyf.open({
                type: "error",
                message: "Số lượng phải lớn hơn 0",
                duration: 3000,
            });
            return false;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                quantity,
            },
            type: "put",
            url: `${window.location.origin}/cart/${id}`,
            success: function (response) {
                const { total_item, total, discount_money } = response;
                const total_price_item = $(`[data-price="${id}"]`);

                total_price_item.text(formatCurrency(total_item));

                const subtotal_price = $("#subtotal");
                subtotal_price.text(formatCurrency(total));

                const total_price = $("#total-price");
                total_price.text(formatCurrency(total - discount_money));
                $("#discount-price").text(formatCurrency(discount_money));

                notyf.open({
                    type: "info",
                    message: "Cập nhật giỏ hàng thành công!",
                });
            },
            error: function (error) {
                if (error.status === 401) {
                    window.location.href = "/login";
                    return;
                }
                const { type } = error.responseJSON;
                const message =
                    type && type == "quantity"
                        ? "Số lượng lớn hơn số lượng hàng có sẵn"
                        : "Có lỗi xảy ra";
                notyf.open({
                    type: "error",
                    message,
                    duration: 3000,
                });
                //console.log(error.responseJSON);
            },
        });
    }, 2000);
}

function removeCart(id) {
    const cart_count = $("#cart_count");
    const row = $(`[data-row="${id}"]`);
    if (row.hasClass("disabled")) return;
    row.addClass("fadeOutRightBig disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "delete",
        url: `${window.location.origin}/cart/${id}`,
        success: function (response) {
            const { total, discount_money } = response;
            let count = parseInt(cart_count.text().replace(/[^0-9]/g, "_"));
            count = count > 1 ? count - 1 : 0;
            row.fadeOut(400, function () {
                row.remove();
            });
            cart_count.html(
                `<span class="icon-shopping_cart"></span>[${count}]`
            );
            const subtotal_price = $("#subtotal");
            subtotal_price.text(formatCurrency(total));

            const total_price = $("#total-price");
            total_price.text(formatCurrency(total - discount_money));

            $("#discount-price").text(formatCurrency(discount_money));
            notyf.open({
                type: "info",
                message: "Cập nhật giỏ hàng thành công!",
            });
            if (!total) {
                setTimeout(() => {
                    location.reload();
                }, 5500);
            }
        },
        error: function (error) {
            if (error.status === 401) {
                window.location.href = "/login";
                return;
            }
            notyf.open({
                type: "error",
                message: "Có lỗi xảy ra!",
                duration: 3000,
            });
            console.log(error.responseJSON);
        },
    });
}

$("#province").change(function () {
    const id = $(this).find("option:selected").val();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "get",
        url: `${window.location.origin}/address/districts/${id}`,
        success: function (data) {
            const { districts } = data;
            const districtSelect = $("#district");
            districtSelect.empty();

            const wardSelect = $("#ward");
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

$("#district").change(function () {
    const id = $(this).find("option:selected").val();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "get",
        url: `${window.location.origin}/address/wards/${id}`,
        success: function (data) {
            const { wards } = data;
            const wardSelect = $("#ward");
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

$("#order").click(function () {
    const firstname = $('input[name="firstname"]').val().trim();
    const lastname = $('input[name="lastname"]').val().trim();
    const province = $("#province").find("option:selected").text().trim();
    const district = $("#district").find("option:selected").text().trim();
    const ward = $("#ward").find("option:selected").text().trim();
    const address = $('input[name="address"]').val().trim();
    const telephone = $('input[name="telephone"]').val().trim();
    const email = $('input[name="email"]').val().trim();
    const note = $('textarea[name="note"]').val().trim();
    const data = {
        firstname,
        lastname,
        province,
        district,
        ward,
        address,
        telephone,
        email,
        note,
    };
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        data,
        url: `${window.location.origin}/order`,
        success: function (data) {
            window.location.href = `${window.location.origin}/order-success`;
        },
        error: function (error) {
            if (error.status === 401) {
                window.location.href = "/login";
                return;
            }
            if (error.responseJSON.type == "empty-form") {
                notyf.open({
                    type: "error",
                    message: error.responseJSON.message,
                    duration: 3000,
                });
            }
            if (error.responseJSON.type == "cart-empty") {
                notyf.open({
                    type: "error",
                    message: "Giỏ hàng trống",
                    duration: 3000,
                });
                setTimeout(function () {
                    location.reload();
                }, 3500);
            }
            notyf.open({
                type: "error",
                message: "Đặt hàng không thành công.",
                duration: 3000,
            });
        },
    });
});

$("#coupon-input").focus(function () {
    $("#coupon-msg").hide("slow", function () {
        $("#coupon-msg").remove();
    });
});

$("#inputAvatar").change(function () {
    if ($(this).val() == "") {
        $("#btn-avatar").attr("disabled", true);
    } else {
        $("#btn-avatar").attr("disabled", false);
    }
});
$("input, select, textarea").focus(function () {
    const msg = $(this).nextAll(".text-danger");
    msg.hide("slow", function () {});
});
