@extends('layouts.default.layout')

@section('title', trans('website.home'))

@section('content')
<div class="row">
   <div class="mm-slider slider-single">
   @include('partials.default.slider')
   </div><!--/.mm-slider-->
</div>
<div class="show-items">
   <div class="row">
      <h1 class="title float-left">{{ trans('website.up-coming-movies') }}</h1>
      <a href="{{ route('movies', ['type=u']) }}" class="see-all float-right">{{ trans('website.see-all') }} <i class="icon icon-back-grey"></i></a>

      <div class="show-items-body scroll-pane horizontal-only">
         @if (count($movies) > 0)
            @foreach($movies->Sorted()->ByMovies()->Upcoming()->take(17)->get() as $movie)
            <div class="show__item">
               <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-link show__item-h">
                  <img src="https://image.tmdb.org/t/p/w342/{{ $movie->poster }}" alt="{{ $movie->title }}" class="image show__item-img show__item-back">
               </a>

               <div class="show__item-hover">
                  <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-hoverimg show__item-link float-left">
                     <div class="show__item-play"></div>
                  </a>

                  <div class="show__item-hoverinfo float-left">
                     <h1 class="title"><a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}">{{ str_limit($movie->title, 24) }}</a></h1>

                     <p class="list">{{ trans('website.director') }}: <span>{{ $movie->director }}</span></p>
                     <p class="text">{{ str_limit($movie->overview, 100) }}</p>

                     @if($movie->imdb_rating != 'N/A')
                     <div class="imdb float-left">
                        <div class="sl">IMDB</div>
                        <div class="sr">{{ $movie->imdb_rating }}</div>
                     </div>
                     @endif

                     @if(count($mm) > 0 && count($mm->MME($movie->movie_id)) >= 10)
                     <div class="mm float-left">
                        <div class="sl">MM</div>
                        <div class="sr">{{ number_format($movie->MM($movie->movie_id), 1, '.', ',') }}</div>
                     </div>
                     @endif
                  </div>
               </div>
            </div><!--/.show-item-->
            @endforeach
         @endif
      </div><!--/.scroll-pane-->
   </div>
</div><!--/.show-items-->

<div class="show-items">
   <div class="row">
      <h1 class="title float-left">{{ trans('website.popular-onmovieman') }}</h1>
      <a href="{{ route('movies', ['type=p']) }}" class="see-all float-right">{{ trans('website.see-all') }} <i class="icon icon-back-grey"></i></a>

      <div class="show-items-body scroll-pane horizontal-only">
         @if (count($movies) > 0)
            @foreach($movies->Views()->ByMovies()->Released()->take(17)->get() as $movie)
            <div class="show__item">
               <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-link show__item-h">
                  <img src="https://image.tmdb.org/t/p/w154/{{ $movie->poster }}" alt="{{ $movie->title }}" class="image show__item-img show__item-back">
               </a>

               <div class="show__item-hover">
                  <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-hoverimg show__item-link float-left">
                     
                     <div class="show__item-play"></div>
                  </a>

                  <div class="show__item-hoverinfo float-left">
                     <h1 class="title"><a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}">{{ str_limit($movie->title, 24) }}</a></h1>

                     <p class="list">{{ trans('website.director') }}: <span>{{ $movie->director }}</span></p>
                     <p class="text">{{ str_limit($movie->overview, 100) }}</p>

                     @if($movie->imdb_rating != 'N/A')
                     <div class="imdb float-left">
                        <div class="sl">IMDB</div>
                        <div class="sr">{{ $movie->imdb_rating }}</div>
                     </div>
                     @endif

                     @if(count($mm) > 0 && count($mm->MME($movie->movie_id)) >= 10)
                     <div class="mm float-left">
                        <div class="sl">MM</div>
                        <div class="sr">{{ number_format($movie->MM($movie->movie_id), 1, '.', ',') }}</div>
                     </div>
                     @endif
                  </div>
               </div>
            </div><!--/.show-item-->
            @endforeach
         @endif
      </div><!--/.scroll-pane-->
   </div>
</div><!--/.show-items-->

<div class="show-items with-description shi__border-top">
   <div class="row">
      <h1 class="title float-left">{{ trans('website.celebrity-wall') }}</h1>
      <a href="{{ route('celebs') }}" class="see-all float-right">{{ trans('website.see-all') }} <i class="icon icon-back-grey"></i></a>

      <div class="show-items-body scroll-pane horizontal-only">
         @if (count($persons) > 0)
            @foreach($persons->take(17)->get() as $person)
            <div class="person__item">
               <div class="person__item-image">
                  <a href="{{ route('show.celebs', ['id' => $person->person_id, 'slug' => $person->slug]) }}" class="show__item-link">
                     <img src="https://image.tmdb.org/t/p/w154/{{ $person->image }}" alt="{{ $person->name }}" class="image show__item-img show__item-back">
                  </a>
               </div>

               <div class="show__item-description">
                  <h1 class="title"><a href="{{ route('show.celebs', ['id' => $person->person_id, 'slug' => $person->slug]) }}">{{ str_limit($person->name, 13) }}</a></h1>
                  <p class="text">{{ trans('website.movie-tvc') }}: @if(count($casts) > 0) {{ count($casts->Credits($person->person_id)) }} @endif</p>
               </div>
            </div>
            @endforeach
         @endif 
      </div><!--/.scroll-pane-->
   </div>
</div><!--/.show-items-->

<div class="show-items">
   <div class="row">
      <h1 class="title float-left">{{ trans('website.popular-tv') }}</h1>
      <a href="{{ route('movies', ['type=tv']) }}" class="see-all float-right">{{ trans('website.see-all') }} <i class="icon icon-back-grey"></i></a>

      <div class="show-items-body scroll-pane horizontal-only">
         @if (count($movies) > 0)
            @foreach($movies->Views()->ByTv()->Released()->take(17)->get() as $movie)
            <div class="show__item">
               <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-link show__item-h">
                  <img src="https://image.tmdb.org/t/p/w342/{{ $movie->poster }}" alt="{{ $movie->title }}" class="image show__item-img show__item-back">
               </a>

               <div class="show__item-hover">
                  <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-hoverimg show__item-link float-left">
                     <div class="show__item-play"></div>
                  </a>

                  <div class="show__item-hoverinfo float-left">
                     <h1 class="title"><a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}">{{ str_limit($movie->title, 24) }}</a></h1>

                     <p class="list">{{ trans('website.writers') }}: <span>{{ $movie->writers }}</span></p>
                     <p class="text">{{ str_limit($movie->overview, 100) }}</p>

                     @if($movie->imdb_rating != 'N/A')
                     <div class="imdb float-left">
                        <div class="sl">IMDB</div>
                        <div class="sr">{{ $movie->imdb_rating }}</div>
                     </div>
                     @endif

                     @if(count($mm) > 0 && count($mm->MME($movie->movie_id)) >= 10)
                     <div class="mm float-left">
                        <div class="sl">MM</div>
                        <div class="sr">{{ number_format($movie->MM($movie->movie_id), 1, '.', ',') }}</div>
                     </div>
                     @endif
                  </div>
               </div>
            </div><!--/.show-item-->
            @endforeach
         @endif
      </div><!--/.scroll-pane-->
   </div>
</div><!--/.show-items-->
@endsection