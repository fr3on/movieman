@extends('layouts.default.layout')

@section('title', $page->title)

@section('content')
 	<div class="page_c shi__border-top ptb-m">
      <div class="row">
      	<h1 class="page_title">{{ $page->title }}</h1>
        <p class="page_t ptb-m">{!! $page->content !!}</p>
      </div>
    </div><!--/.page_c-->
@endsection