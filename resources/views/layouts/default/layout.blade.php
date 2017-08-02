@inject('settings', 'App\Settings')
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="_token" content="{{ csrf_token() }}">
   <meta name="description" content="{{ $settings->first()->site_description }}">
   <title>{{ $settings->first()->site_name }} - @yield('title')</title>
   <link rel="stylesheet" href="{{ asset('/public/assets/css/style.css') }}">
</head>
<body>

   <div class="overlay"></div>
   <div class="container content">
      <div class="header-line"></div>
      @include('partials.default.left')
      <!--/.blocks-->

      <div class="capps float-left">
         <div class="row">
            <div class="search-form">
               <form method="GET" action="{{ route('search') }}">
                  <div class="form__group">
                     <input type="search" name="v" class="form__search" placeholder="{{ trans('website.search-text') }}">
                  </div>
                     
                  <div class="form__group">
                     <button type="submit" class="button button-search">{{ trans('website.search') }}</button>
                  </div>
               </form>
            </div><!--/.search-form-->

            @if(Auth::check())
            <div class="popup__auth">
               <a href="{{ route('favs') }}"><div class="avatar__image" style="background: url({{ env('APP_URL') }}{{ Auth::user()->image }}) center 30% no-repeat; background-size: cover !important; width: 56px; height: 51px; border-radius: 2px;"></div></a>
               <a href="{{ route('logout') }}" class="button button-logout" title="{{ trans('website.log-out') }}">x</a>
            </div>
            @else
            <div class="popup__auth">
               <button class="button button-auth"><i class="icon-user"></i></button>
            </div>

            <div class="popup__auth-box">
               <div class="popup__auth-box-head">
                  <div class="rowz">
                     <h1 class="title">{{ trans('website.login-head') }}</h1>
                     <button class="button button__popup-close"><i class="icon-close"></i></button>
                  </div>
               </div>
               <div class="popup__auth-box-body">
                  <div class="rowz">
                     <form method="POST" action="{{ route('login.post') }}">
                        {!! csrf_field() !!}
                        <div class="form__group">
                           <input type="text" name="username" class="form__control input-login input-fluid" placeholder="{{ trans('website.enter-username') }}" id="username">
                        </div>

                        <div class="form__group form__group-addon">
                           <input type="password" name="password" class="form__control input-login input-password input-fluid" placeholder="{{ trans('website.enter-password') }}" id="password">
                           <a href="{{ url('/password/email') }}" class="lost-password">{{ trans('website.forgot-password') }}</a>
                        </div>

                        <button class="button button-primary button-large butoon-fluid">{{ trans('website.log-into-myaccount') }}</button>
                     </form>

                     <p class="new__acc">
                        {{ trans('website.donthave-account') }} <a href="{{ url('/register') }}">{{ trans('website.sign-up-now') }}</a>
                     </p>

                     <div class="other__auth">
                        <h1 class="title">{{ trans('website.login-with') }}</h1>
                        <ul class="oauth__list">
                           <li class="oauth__item"><a href="{{ route('auth.social', ['facebook']) }}" class="oauth__link facebook">{{ trans('website.login-facebook') }}</a></li>
                           <li class="oauth__item"><a href="{{ route('auth.social', ['twitter']) }}" class="oauth__link twitter">{{ trans('website.login-twitter') }}</a></li>
                           <li class="oauth__item"><a href="{{ route('auth.social', ['google']) }}" class="oauth__link google">{{ trans('website.login-google') }}</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div><!--/.popup__auth-box-->
            @endif
            </div><div class="clear"></div>
            @yield('content')
      </div><!--/.capps-->
      @include('partials.default.footer')
      <!--/.footer-->
   </div><!--/.content-->

   <script>var vars={site_url:"{{ env('APP_URL') }}",token:"{{ csrf_token() }}"};</script>
   <script src="{{ asset('/public/assets/js/movieman.js') }}"></script>
   <!--/script-->
</body>
</html>