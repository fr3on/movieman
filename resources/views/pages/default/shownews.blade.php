@extends('layouts.default.layout')

@section('title', $news->title)

@section('content')
   <div class="page_c pb-m">
      <div class="row">
         <div class="news__full">
            <div class="news__full-image" style="background: url({{ env('APP_URL') }}{{ $news->image }}) center 27% no-repeat"></div>
            <div class="news__full-title"><h1>{{ $news->title }}</h1></div>

            <div class="news__full-nf">
               <p>{{ $news->created_at->diffInHours(Carbon\Carbon::now()) >= 1 ? Carbon\Carbon::now()->subHours($news->created_at->diffInHours())->diffForHumans() : Carbon\Carbon::now()->subMinutes($news->created_at->diffInMinutes())->diffForHumans() }}</p>

               <p>{{ count($comments->Show($news->id, 'news')->get()) }} {{ trans('website.comments') }}</p>
            </div>

            <div class="clear"></div>

            <div class="news__full-text">
               <p>{{ $news->content }}</p>
            </div>

            <div class="user__reviews shi__border-top">
               <h1 class="title ptb-m">{{ trans('website.user-r-c') }}</h1>
               @if(count($comments) > 0)
                  @foreach($comments->Sorted()->Show($news->id, 'news')->get() as $comment)
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
                     <input type="hidden" name="type_id" value="{{ $news->id }}">
                     <input type="hidden" name="type" value="news">

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
         </div><!--/.news__full-->
      </div>
   </div><!--/.page_c-->
@endsection