@extends('layouts.default.layout')

@section('title', $movie->title)

@section('content')
   <div class="page_c shi__border-top ptb-m">
      <div class="row">
         <div class="movie-page">
            <div class="trailer">
               <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $movie->trailer }}" frameborder="0" allowfullscreen></iframe>
            </div><!--/.trailer-->

            <div class="movie__info">
               <h1 class="title">{{ trans('website.overview') }}</h1>
               <p class="text">{{ $movie->overview }}</p>
               @if($movie['director'] !== null || $movie['writers'] !== '')
               <h1 class="title">{{ trans('website.crew') }}</h1>
               @endif

               @if($movie['director'] !== null)
                  <p class="list"><span>{{ trans('website.director') }}:</span> {{ $movie->director }}</p>
               @endif

               @if($movie['writers'] !== '')
                  <p class="list"><span>{{ trans('website.writers') }}:</span> {{ $movie->writers }}</p>
               @endif

               <h1 class="title">{{ trans('website.cast') }}</h1>

               <div class="cast__list">
               @if(count($casts) > 0)
               @foreach($casts->Show($movie->movie_id) as $cast)
                  <div class="cast__item">
                     <div class="image">
                        <a href="{{ route('show.celebs', ['id' => $cast->person_id, 'slug' => $cast->slug]) }}">
                        @if($cast->image == env('APP_URL') . 'public/assets/images/movieman-poster.png')
                         <img src="{{ $cast->image }}" alt="#"></a>
                        @else
                         <img src="https://image.tmdb.org/t/p/w92/{{ $cast->image }}" alt="#"></a>
                        @endif
                     </div>
                     <div class="name">
                        <h1>
                           <a href="{{ route('show.celebs', ['id' => $cast->person_id, 'slug' => $cast->slug]) }}">{{ str_limit($cast->name, 14) }}</a> 
                           {{ trans('website.as') }} {{ str_limit($cast->character_name, 12) }}
                        </h1>
                     </div>
                  </div>
               @endforeach  
               @endif
               </div><!--/.cast__list-->

               <div class="clear"></div>

               <h1 class="title">{{ trans('website.backdrops') }}</h1>

               <div class="backdrops-slider">
                  @if(count($backdrops) > 0)
                  @foreach($backdrops->Show($movie->movie_id)->get() as $backdrop)
                     <div class="backdrops__item">
                        <a href="https://image.tmdb.org/t/p/original/{{ $backdrop->image }}" target="_blank">
                           <img src="https://image.tmdb.org/t/p/w300/{{ $backdrop->image }}" alt="#">
                        </a>
                     </div>
                  @endforeach  
                  @endif
               </div><!--/.backdrops-slider-->
            </div><!--/.movie__info-->
         </div><!--/.movie-page-->
      </div>
   </div><!--/.page_c-->

   <div class="moviePage__tab">
      <div class="moviePage__tab-header">
         <div class="row">
            <ul class="mpt__list">
               <li class="mpt__item active"><a href="#tab-1" class="mpt__link">{{ trans('website.user-reviews') }}</a></li>
               <li class="mpt__item"><a href="#tab-2" class="mpt__link">{{ trans('website.rate-this') }}</a></li>
            </ul>
         </div>
      </div>

      <div class="row">
         <div class="mpt__stage">
            <div id="tab-1" class="mp_tab active">
               @if(count($comments) > 0)
                  @foreach($comments->Sorted()->Show($movie->movie_id, 'movies')->get() as $comment)
                     <div class="mpt__comments" data-id="{{ $comment->comment_id }}">
                        <div class="mpt__comments-head">
                           <div class="avatar">
                              <div class="avatar__image" style="background: url({{ env('APP_URL') }}{{ $user->C($comment->user_id)->image }}) center 25% no-repeat; background-size: 40px !important;"></div>
                           </div>
                           <div class="user">
                              {{ trans('website.review-by') }} <span>{{ $user->C($comment->user_id)->username }}</span>
                           </div>
                           @if(Auth::check() && $comment->user_id == Auth::user()->id)
                              <button type="button" class="button button-secondary button-small" id="deleteComment">{{ trans('website.delete') }}</button>
                           @endif
                        </div>

                        <div class="mpt__comments-content">
                           <p>{{ $comment->content }}</p>
                        </div>
                     </div><!--/.mpt__comments-->
                  @endforeach
               @endif

               @if(Auth::check())
                  <form action="{{ route('add.com') }}" enctype="multipart/form-data" method="post">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="type_id" value="{{ $movie->movie_id }}">
                     <input type="hidden" name="type" value="movies">

                     <div class="form__group grid--12">
                        <textarea name="content" class="form__control input-fluid textarea" id="content" required></textarea>

                        @if($errors->has('content'))
                           <div class="log log-error">{{ $errors->first('content') }}</div>
                        @endif
                     </div>
                     <br>
                     <button type="submit" class="button button-secondary button-medium">{{ trans('website.add-review') }}</button>
                  </form>
               @else
                  <div class="mpt__comments-add">
                     <button class="button button-blue button-medium button-auth">{{ trans('website.write-review') }}</button>
                  </div>
               @endif
            </div>

            <div id="tab-2" class="mp_tab">
               <div class="vote" data-type="movies" data-id="{{ $movie->movie_id }}">
                  @if(Auth::check())
                     @if(count($rate) > 0 && count($rate->M($movie->movie_id)) > 0 && $rate->U()->first())
                        @for ($i = 1; $i < $rate->M($movie->movie_id)->first()->stars+1; $i++)
                           <span class="vote__star vote__star-blue" id="vstar-{{ $i }}">{{ $i }}</span>
                        @endfor
                        @for ($i = $rate->M($movie->movie_id)->first()->stars+1; $i < 11; $i++)
                           <span class="vote__star" id="vstar-{{ $i }}">{{ $i }}</span>
                        @endfor
                     @else
                        @for ($i = 1; $i < 11; $i++)
                           <span class="vote__star" id="vstar-{{ $i }}">{{ $i }}</span>
                        @endfor
                     @endif
                  @else
                     <button class="button button-blue button-medium button-auth">{{ trans('website.rate-this') }}</button>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div><!--/.moviePage__tab-->
@endsection