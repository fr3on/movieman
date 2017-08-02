@inject('menu', 'App\Menu')
@inject('news', 'App\News')
@inject('movies', 'App\Movies')
@inject('settings', 'App\Settings')

<div class="blocks float-left">
   <div class="row">
      <h1 class="logo"><a href="{{ env('APP_URL') }}">{{ $settings->first()->site_name }}</a></h1>
   </div>

   <div class="block-navigation nvblocks">
	    <div class="row">
	        <ul class="block__list">
	        	@foreach($menu->OfBlock()->get() as $men)
	            <li class="block__item">
	                <a href="{{ env('APP_URL') }}{{ $men->slug }}" class="block__link">{{ $men->title }}</a>
	            </li>
	            @endforeach
	        </ul>
	    </div>
	</div>
	<div class="news-feed-block nvblocks">
	    <div class="row">
	        <div class="nvblocks-head">
	            <h1 class="title float-left">{{ trans('website.news-feed') }}</h1>
	            <a href="{{ route('news') }}" class="see-all float-right">{{ trans('website.see-all') }}
	                <i class="icon icon-back-grey"></i>
	            </a>
	        </div>
	        <div class="nvblocks-body news-feed__body">
	            <ul class="news-feed__list">
	            	@foreach($news->Sorted()->get() as $nw)
	            	<li class="news-feed__item">
	                    <a href="{{ route('show.news', ['id' => $nw->id, 'slug' => $nw->slug]) }}" class="news-feed__link">
	                        {{ $nw->title }}
	                    </a>
	                </li>
	            	@endforeach
	            </ul>
	        </div>
	    </div>
	</div>
	<div class="movie-card-block nvblocks">
	    <div class="row">
	        <div class="nvblocks-head">
	            <h1 class="title float-left">{{ trans('website.movie-card') }}</h1>
	        </div>
	        <div class="nvblocks-body">
	            @foreach($movies->ByMovies()->Released()->HasImdb()->take(1)->random(1)->get() as $movie)
	            	<div class="card__image">
		                <div class="movie__card-image" style="background: url(https://image.tmdb.org/t/p/w300/{{ $movie->poster }}) center 5% no-repeat; background-size: cover;"></div>
		            </div>

		            <div class="movie__card-description">
		            	<h1 class="title">
		                    <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="movie__card-link">{{ str_limit($movie->title, 12) }} ({{ Carbon\Carbon::parse($movie->release_date)->format('Y') }})</a>
		                </h1>

		                <div class="rating" data-value="{{ $movie->imdb_rating / 10 }}">
	                        <span class="rating__number">{{ $movie->imdb_rating }}</span>
	                    </div>

	                    <p class="movie__card-list blue">{{ str_limit(str_replace(', ', '/', $movie->genres), 32) }}</p>
	                    <p class="movie__card-list black">{{ trans('website.directing') }}: <span class="grey">{{ $movie->director }}</span></p>
	                    <p class="movie__card-list black">{{ trans('website.language') }}: <span class="grey">{{ $movie->language }}</span></p>
	                    <p class="movie__card-list black">{{ trans('website.budget') }}: <span class="grey">${{ number_format($movie->budget) }}</span></p>

	                    <p class="text">
                        	{{ str_limit($movie->overview, 220) }}
                     	</p>
		            </div>
	            @endforeach
	        </div>
	    </div>
	</div>
	
</div>