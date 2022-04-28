<div class="item">
    <div class="movie-grid">
        <div class="movie-thumb c-thumb">
            <a href="{{ route('cinema.movie.detail', $movie->slug)}}">
                <img src="{{ Helpers::getMovieImage($movie->images) }}" alt="{{ $movie->title }}">
            </a>
        </div>
        <div class="movie-content bg-one">
            <h5 class="title m-0">
                <a href="{{ route('cinema.movie.detail', $movie->slug)}}">{{ $movie->title }}</a>
            </h5>
            <ul class="movie-rating-percent">
                <li>
                    <div class="thumb">
                        Thời lượng:
                    </div>
                    <span class="content">{{ $movie->duaration }}</span>
                </li>
                <li>
                    <div class="thumb">
                        Khởi chiếu
                    </div>
                    <span class="content">{{ Helpers::formatDate($movie->release_date)}}</span>
                </li>
            </ul>
        </div>
    </div> 
</div>