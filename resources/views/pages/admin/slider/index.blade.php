@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Sliders</h1></div>
	<div class="page--contentBody">
		<a href="{{ route('admin.slider.create') }}" class="button button--primary button--medium button--radius text--uppercase"><i class="icon ion-plus"></i> Add Slider</a>
	
		@if(session('success'))
		<div class="alert alert__success">
			<p>{{ session('success') }}</p>
		</div> 
		@endif
		@if (count($sliders) > 0)
			<div class="app__list">
				@foreach($sliders as $slider)
					<div class="app__item">
						<div class="app__image" style="width: 80px;">
							<div style="background: url({{ env('APP_URL') }}{{ $slider->image }}) center top no-repeat; width: 80px; height: 100%; background-size: 160px; border-radius: 2px;"></div>
						</div>

						<div class="app__t">
							<h1>{{ $movies->Sid($slider->movie_id)->first()->title }}</h1>
						</div>
						

						<div class="app__actions">
							<a href="{{ route('admin.slider.edit', $slider->id) }}" class="button button--edit color--grey"><i class="ion ion-edit"></i></a>
							<form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" class="float--left">
							    <input type="hidden" name="_method" value="DELETE">
							    <input type="hidden" name="_token" value="{{ csrf_token() }}">
							    <button class="button button--delete color--red"><i class="ion ion-trash-b"></i></button>
							</form>
						</div>

					</div>
				@endforeach
			</div>

			{{ $sliders->links() }}
		@else
			<br clear="all">
			<br>
			<div class="log log--warning">Records Not Found.</div>
		@endif
	</div>
@endsection