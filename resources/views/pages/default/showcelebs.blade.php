@extends('layouts.default.layout')

@section('title', $celeb->name)

@section('content')
   <div class="page_c shi__border-top ptb-m">
      <div class="row">
         <div class="celeb__page-left">
                <div class="personpl float-left">
                  <div class="image">
                     @if($celeb->image == env('APP_URL') . 'public/assets/images/movieman-poster.png')
                     <img src="{{ $celeb->image }}" alt="#">
                     @else
                     <img src="https://image.tmdb.org/t/p/w342/{{ $celeb->image }}" alt="#">
                     @endif
                  </div>

                  <div class="person__facts">
                     <h1 class="title">{{ trans('website.person-facts') }}</h1>

                     <div class="person__facts--cont">
                        <p class="pfc__list">{{ trans('website.gender') }}: <span>{{ $celeb->sex }}</span></p>
                        <p class="pfc__list">{{ trans('website.known-credits') }}: <span>@if(count($casts) > 0) {{ count($casts->Credits($celeb->person_id)) }} @endif</span></p>
                        <p class="pfc__list">{{ trans('website.birthday') }}: <span>{{ $celeb->birth_date }}</span></p>
                        <p class="pfc__list">{{ trans('website.birth-place') }}: <span>{{ $celeb->birth_place }}</span></p>
                     </div>
                  </div>
               </div>
         </div><!--/.celeb__page-left-->

         <div class="personpr float-right">
            <div class="personpr-item">
               <h1 class="title">{{ $celeb->name }}</h1>

               <div class="biography">
                  <h1 class="title">{{ trans('website.biography') }}</h1>
                  <p class="content">{{ $celeb->biography }}</p>
               </div>   

               <div class="person__moviesp">
                  <h1 class="title">{{ trans('website.known-for') }}</h1>

                  <div class="person__moviesp-cont">
                     @if(count($casts) > 0)
                        @foreach($casts->Acting($celeb->person_id) as $cast)
                           <div class="person__moviesp-item">
                              <div class="poster">
                                 <a href="{{ route('show.movies', ['id' => $cast->movie_id, 'slug' => $cast->slug]) }}"><img src="https://image.tmdb.org/t/p/w342/{{ $cast->poster }}"></a>
                              </div>
                              <h1 class="title"><a href="{{ route('show.movies', ['id' => $cast->movie_id, 'slug' => $cast->slug]) }}">{{ $cast->title }}</a></h1>
                           </div>
                        @endforeach  
                     @endif
                  </div>
               </div>
            </div><!--/.personprv-->

            <div class="clear"></div>

            <div class="person__zlists">
               <h1 class="title">{{ trans('website.acting') }}</h1>
               <div class="person__zlists-cont">
                  @if(count($casts) > 0)
                     @foreach($casts->Acting($celeb->person_id) as $cast)
                        <div class="person__zlists-item">
                           <span class="year">{{ Carbon\Carbon::parse($cast->release_date)->format('Y') }}</span>
                           <h1 class="title"><a href="{{ route('show.movies', ['id' => $cast->movie_id, 'slug' => $cast->slug]) }}">{{ $cast->title }}</a></h1>
                        </div><!--/.person__zlists-item-->
                     @endforeach  
                  @endif
               </div>
            </div><!--/.person__zlists-->
         </div><!--/.personpr-->
      </div>
   </div><!--/.page_c-->
@endsection