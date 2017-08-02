@extends('layouts.default.layout')

@section('title', $tv->title)

@section('content')
            <div class="mm--slider slider--single">
               <!--
               @include('partials.default.slider')
               -->
            </div>


            <div class="page__c">
               <div class="row">
                  <div class="movie--page">
                  <div class="trailer">
                  <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $tv->trailer }}" frameborder="0" allowfullscreen></iframe>
                  </div>

                  <div class="movie__info">
                     <h1 class="title">Overview</h1>
                     <p class="text">{{ $tv->overview }}</p>

                     <h1 class="title">Crew</h1>
                     <p class="list"><span>Director:</span> {{ $tv->director }}</p>
                     <p class="list"><span>Writers:</span> {{ $tv->writers }}</p>
                     <h1 class="title">Cast</h1>
                     <div class="cast__list">
                     @if(count($casts) > 0)
                     @foreach($casts->Show($tv->tv_id) as $cast)
                        <div class="cast__item">
                           <div class="image">
                              <a href="{{ route('show.celebs', ['id' => $cast->person_id, 'slug' => $cast->slug]) }}"><img src="{{ $cast->image }}" alt="#"></a>
                           </div>
                           <div class="name">
                              <h1><a href="{{ route('show.celebs', ['id' => $cast->person_id, 'slug' => $cast->slug]) }}">{{ $cast->name }}</a> as {{ str_limit($cast->character_name, 14) }}</h1>
                           </div>
                        </div>
                     @endforeach  
                     @endif
                     </div>
                     <div class="clear"></div>
                     <h1 class="title">Backdrops</h1>

                     <div class="backdrops--slider">
                        @if(count($backdrops) > 0)
                        @foreach($backdrops->Show($tv->tv_id)->get() as $backdrop)
                           <div class="backdrops__item">
                              <a href="https://image.tmdb.org/t/p/original/{{ $backdrop->image }}" target="_blank"><img src="https://image.tmdb.org/t/p/w300/{{ $backdrop->image }}" alt="#"></a>
                           </div>
                        @endforeach  
                        @endif
                     </div>
                  </div>
               </div>


               </div>   
            </div>
            </div>

            <div class="moviePage__tab">
            <div class="moviePage__tab--header">
               <div class="row">
                  <ul class="mpt__list">
                     <li class="mpt__item active"><a href="#tab-1" class="mpt__link">User Reviews</a></li>
                     <li class="mpt__item"><a href="#tab-3" class="mpt__link">Movie Facts</a></li>
                     <li class="mpt__item"><a href="#tab-2" class="mpt__link">Rate This</a></li>
                  </ul>
               </div>
            </div>

            <div class="row">
               <div class="mpt__stage">
                  <div id="tab-1" class="mp_tab active">
                     @if(count($comments) > 0)
                     @foreach($comments->Sorted()->Show($tv->tv_id)->get() as $comment)
                        <div class="mpt__comments" data-id="{{ $comment->comment_id }}">
                        <div class="mpt__comments--head">
                           <div class="avatar">
                              <div class="avatar__image" style="background: url({{ $user->C($comment->user_id)->image }}) center 25% no-repeat; background-size: 40px !important;"></div>
                           </div>
                           <div class="user">
                              A Review by <span>{{ $user->C($comment->user_id)->username }}</span>
                           </div>
                           @if(Auth::check() && $comment->user_id == Auth::user()->id)
                           <button type="button" class="button button--secondary button--small" id="deleteComment">Delete</button>
                           @endif
                        </div>

                        <div class="mpt__comments--content">
                           <p>
                              {{ $comment->content }}
                           </p>
                        </div>
                     </div>
                     @endforeach  
                     @endif
                     
                     @if(Auth::check())
                     <form action="{{ route('add.com') }}" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type_id" value="{{ $tv->tv_id }}">
                        <input type="hidden" name="type" value="movies">

                        <div class="form__group grid--12">
                            <textarea name="content" class="form__control input--fluid textarea" id="content" required></textarea>

                           @if($errors->has('content'))
                           <div class="log log--error">{{ $errors->first('content') }}</div>
                        @endif
                        </div>
                        <br>
                        <button type="submit" class="button button--secondary button--medium">add review</button>
                     </form>
                     @else
                     <div class="mpt__comments--add">
                        <button class="button button--blue button--medium button--auth">Write your review</button>
                     </div>
                     @endif
                  </div>

                  <div id="tab-2" class="mp_tab">
                     <div class="vote" data-type="movies" data-id="{{ $tv->tv_id }}">
                        @if(Auth::check())
                           @if(count($rate) > 0 && $rate->MT($tv->tv_id) && $rate->U()->first())
                              @for ($i = 1; $i < $rate->MT($tv->tv_id)->first()->stars+1; $i++)
                                  <span class="vote__star vote__star-blue" id="vstar-{{ $i }}">{{ $i }}</span>
                              @endfor

                              @for ($i = $rate->MT($tv->tv_id)->first()->stars+1; $i < 11; $i++)
                                  <span class="vote__star" id="vstar-{{ $i }}">{{ $i }}</span>
                              @endfor
                           @else
                              @for ($i = 1; $i < 11; $i++)
                                  <span class="vote__star" id="vstar-{{ $i }}">{{ $i }}</span>
                              @endfor
                           @endif
                        @else

                        @endif
                     </div>
                  </div>
               </div>
@endsection