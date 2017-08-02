@extends('layouts.default.layout')

@section('title', trans('website.home'))

@section('content')
   <div class="page_c shi__border-top ptb-m">
      <div class="row">
         @if (count($movies) > 0)
            @foreach($movies as $movie)
            <div class="show__item">
               <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-link show__item-h">
                  <img src="https://image.tmdb.org/t/p/w342/{{ $movie->poster }}" alt="{{ $movie->title }}" class="image show__item-img show__item-back">
               </a>

               <div class="show__item-hover">
                  <a href="{{ route('show.movies', ['id' => $movie->movie_id, 'slug' => $movie->slug]) }}" class="show__item-hoverimg show__item-link float-left">
                     <img src="https://image.tmdb.org/t/p/w342/{{ $movie->poster }}" alt="{{ $movie->title }}" class="image show__item-img">
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
      </div>
   </div><!--/.page_c-->
@endsection