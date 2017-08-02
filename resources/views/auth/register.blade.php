@extends('layouts.default.layout')

@section('title', trans('website.register'))

@section('content')
   <div class="page_c shi__border-top ptb-m">
      <div class="row">
         <h1 class="page_title text-center">{{ trans('website.register') }}</h1>
         <h3 class="page_subtitle text-center">{{ trans('website.register_s') }}</h3>

         <form method="POST" action="{{ route('auth.post.register') }}" class="register">
            {!! csrf_field() !!}
            @if (count($errors) > 0)
               @foreach ($errors->all() as $error)
                  <div class="alert-info mb-xs">
                     {{ $error }}
                  </div>
               @endforeach
            @endif
            <div class="form__group">
               <input type="text" name="username" class="form__control inputs input-fluid" placeholder="{{ trans('website.username') }} *" id="username">
            </div>

            <div class="form__group">
               <input type="email" name="email" class="form__control inputs input-fluid" placeholder="{{ trans('website.email') }} *" id="email">
            </div>

            <div class="form__group">
               <input type="password" name="password" class="form__control inputs input-fluid" placeholder="{{ trans('website.password') }} *" id="password">
            </div>

            <button type="submit" class="button button-secondary button-medium input-fluid">{{ trans('website.create-account') }}</button>
         </form>
      </div>
   </div><!--/.page_c-->
@endsection