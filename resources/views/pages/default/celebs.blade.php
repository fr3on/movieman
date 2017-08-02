@extends('layouts.default.layout')

@section('title', trans('website.celebrities'))

@section('content')
   <div class="page_c shi__border-top">
      <div class="row">
         @if (count($celebs) > 0)
            @foreach($celebs as $celeb)
               <div class="person__item">
                  <div class="person__item-image">
                     <a href="{{ route('show.celebs', ['id' => $celeb->person_id, 'slug' => $celeb->slug]) }}" class="show__item-link">
                        @if($celeb->image == env('APP_URL') . 'public/assets/images/movieman-poster.png')
                        <img src="{{ $celeb->image }}" alt="{{ $celeb->name }}" class="image show__item-img show__item-back">
                        @else
                        <img src="https://image.tmdb.org/t/p/w154/{{ $celeb->image }}" alt="{{ $celeb->name }}" class="image show__item-img show__item-back">
                        @endif
                     </a>
                  </div>

                  <div class="show__item-description">
                     <h1 class="title"><a href="{{ route('show.celebs', ['id' => $celeb->person_id, 'slug' => $celeb->slug]) }}">{{ str_limit($celeb->name, 13) }}</a></h1>
                     <p class="text">{{ trans('website.movie-tvc') }}: @if(count($casts) > 0) {{ count($casts->Credits($celeb->person_id)) }} @endif</p>
                  </div>
               </div><!--/.person__item-->
            @endforeach
         @endif

         {{ $celebs->links() }}
      </div>
   </div><!--/.page_c-->
@endsection