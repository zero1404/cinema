
    <!-- ==========Newslater-Section========== -->
    <footer class="footer-section">
        <div class="newslater-section padding-bottom">
            <div class="container">
                <div class="newslater-container bg_img" data-background="{{ asset('cinema/images/newslater/newslater-bg01.jpeg') }}">
                    <div class="newslater-wrapper">
                        <h5 class="cate">Đăng ký nhận tin tức mới với Boleto </h5>
                        <h3 class="title">để nhận được những ưu đãi độc quyền</h3>
                        <form class="newslater-form">
                            <input type="text" placeholder="Nhập email">
                            <button type="submit">Đăng Ký</button>
                        </form>
                        <p>Chúng tôi tôn trọng quyền riêng tư của bạn, vì vậy chúng tôi không bao giờ chia sẻ thông tin của bạn</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-top">
                <div class="logo">
                    <a href="{{ route('cinema.home')}}">
                        <img src="{{ asset('cinema/images/footer/footer-logo.png') }}" alt="footer">
                    </a>
                </div>
                <ul class="social-icons">
                    <li>
                        <a href="#0">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0" class="active">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-google"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-area">
                    <div class="left">
                        <p>Copyright © {{ Date('Y') }} </a></p>
                    </div>
                    <ul class="links">
                        <li>
                            <a href="#">Giới thiệu </a>
                        </li>
                        <li>
                            <a href="#">Điều khoản sử dụng</a>
                        </li>
                        <li>
                            <a href="#">Chính sách bảo mật</a>
                        </li>
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li>
                            <a href="#">Phản hồi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- ==========Newslater-Section========== -->