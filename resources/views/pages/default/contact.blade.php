@extends('layouts.default.layout')

@section('title', trans('website.contact'))

@section('content')
   <div class="page_c shi__border-top ptb-m">
      <div class="row">
         <h1 class="page_title">{{ trans('website.contact_h') }}</h1>
         <h3 class="page_subtitle">{{ trans('website.contact_s') }}</h3>

         @if(session('success'))
            <div class="alert-info mb-xs">
               <p>{{ session('success') }}</p>
            </div>
         @endif

         <form method="POST" action="{{ route('contact.send') }}" class="contact">
            {!! csrf_field() !!}
            <div class="form__group inputs-2">
               <input type="text" name="name" class="form__control inputs input-fluid" placeholder="{{ trans('website.name') }} *" id="name" required>
            </div>

            <div class="form__group inputs-2">
               <input type="text" name="surname" class="form__control inputs input-fluid" placeholder="{{ trans('website.surname') }} *" id="surname" required>
            </div>

            <div class="form__group inputs-2">
               <input type="email" name="email" class="form__control inputs input-fluid" placeholder="{{ trans('website.y-email') }} *" id="email" required>
            </div>

            <div class="form__group inputs-2">
               <input type="text" name="subject" class="form__control inputs input-fluid" placeholder="{{ trans('website.subject') }} *" id="subject" required>
            </div>

            <div class="form__group">
               <textarea name="content" class="form__control textarea input-fluid" placeholder="{{ trans('website.y-comment') }} *" id="content" required></textarea>
            </div>

            <button type="submit" class="button button-secondary button-medium">{{ trans('website.send-message') }}</button>
         </form>
      </div>
   </div><!--/.page_c-->
@endsection