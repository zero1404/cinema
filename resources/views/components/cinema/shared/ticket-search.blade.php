<!-- ==========Ticket-Search========== -->
<section class="search-ticket-section padding-top pt-lg-0">
    <div class="container">
        <div class="search-tab bg_img" data-background="{{ asset('cinema/images/ticket/ticket-bg01.jpg') }}">
            <div class="row align-items-center mb--20">
                <div class="col-lg-6 mb-20">
                    <div class="search-ticket-header">
                        <h6 class="category">Chào mừng bạn đến với Boleto Cinema </h6>
                        <h3 class="title">Bạn đang tìm gì?</h3>
                    </div>
                </div>
            </div>
            <div class="tab-area">
                <div class="tab-item active">
                    <form class="ticket-search-form" method="GET" action="{{ route('cinema.movie.search') }}">
                        <div class="form-group large">
                            <input type="text" name="keyword" placeholder="Nhập tên phim">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>    
<!-- ==========Ticket-Search========== -->