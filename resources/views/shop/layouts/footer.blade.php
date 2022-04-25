<x-Shop.Shared.Subcribe />

<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">ABCBOOK</h2>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="{{ route('shop.home') }}"><span
                                    class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="{{ route('shop.home') }}"><span
                                    class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="{{ route('shop.home') }}"><span
                                    class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Menu</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('shop.product-list') }}" class="py-2 d-block">Shop</a></li>
                        <li><a href="{{ route('shop.home') }}" class="py-2 d-block">Giới Thiệu</a></li>
                        <li><a href="{{ route('shop.home') }}" class="py-2 d-block">Tin Tức</a></li>
                        <li><a href="{{ route('shop.contact') }}" class="py-2 d-block">Liên Hệ Chúng Tôi</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Hỗ Trợ</h2>
                    <div class="d-flex">
                        <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                            <li><a href="#" class="py-2 d-block">Thông tin vận chuyển</a></li>
                            <li><a href="#" class="py-2 d-block">Trả hàng &amp; Đổi hàng</a></li>
                            <li><a href="#" class="py-2 d-block">Điều khoản &amp; điều kiện</a></li>
                            <li><a href="#" class="py-2 d-block">Chính Sách Bảo Mật</a></li>
                        </ul>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('shop.contact') }}" class="py-2 d-block">FAQs</a></li>
                            <li><a href="{{ route('shop.contact') }}" class="py-2 d-block">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Chi tiết liên hệ</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">180 Cao Lỗ,
                                    Phường 4, Quận 8</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span
                                        class="text">0901234567</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span
                                        class="text">stu@gmail.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template
                    is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a
                        href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Logout -->
<div class="modal fade" id="modalLogout" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #000 !important" id="staticBackdropLabel">Xác nhận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có muốn đăng xuất không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4 py-2" data-dismiss="modal">Huỷ</button>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4 py-2">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>


<script src="{{ asset('shop/js/jquery.min.js') }}"></script>
<script src="{{ asset('shop/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('shop/js/popper.min.js') }}"></script>
<script src="{{ asset('shop/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('shop/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('shop/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('shop/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('shop/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('shop/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('shop/js/aos.js') }}"></script>
<script src="{{ asset('shop/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('shop/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('shop/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('shop/js/google-map.js') }}"></script>
<script src="{{ asset('shop/js/notyf.min.js') }}"></script>
<script src="{{ asset('shop/js/main.js') }}"></script>
<script src="{{ asset('shop/js/custom.js') }}"></script>
@stack('scripts')