@extends('layouts.default.layout')

@section('title', trans('website.news-box'))

@section('content')
   <div class="page_c shi__border-top ptb-m">
      <div class="row">
         @if (count($news) > 0)
            @foreach($news as $nw)
               <div class="newsp__item">
                  <div class="newsp__item-image" style="background: url({{ env('APP_URL') }}{{ $nw->image }}) center 25% no-repeat">
                     <a href="{{ route('show.news', ['id' => $nw->id, 'slug' => $nw->slug]) }}">
                        <div class="row">
                           <div class="newsp-bottom">
                              <h3>
                                 {{ $nw->created_at->diffInHours(Carbon\Carbon::now()) >= 1 ? Carbon\Carbon::now()->subHours($nw->created_at->diffInHours())->diffForHumans() : Carbon\Carbon::now()->subMinutes($nw->created_at->diffInMinutes())->diffForHumans() }}
                              </h3>

                              <div class="newsp-white">
                                 <h1 class="title">{{ str_limit($nw->title, 59) }}</h1>
                              </div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            @endforeach
         @endif

         {{ $news->links() }}
      </div>
   </div><!--/.page_c--> 
@endsection