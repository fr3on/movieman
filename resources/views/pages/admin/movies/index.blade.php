@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Movies</h1></div>
	<div class="page--contentBody">
		<a href="{{ route('admin.movies.create') }}" class="button button--primary button--medium button--radius text--uppercase"><i class="icon ion-plus"></i> Add Movie</a>

		@if(session('success'))
		<div class="alert alert__success">
			<p>{{ session('success') }}</p>
		</div> 
		@endif
		@if (count($movies) > 0)
			<div class="app__list">
				@foreach($movies as $movie)
					<div class="app__item">
						<div class="app__image">
							<img src="https://image.tmdb.org/t/p/w45/{{ $movie->poster }}">
						</div>
						<div class="app__t">
							<h1>{{ $movie->title }}</h1>
						</div>

						<div class="app__actions">
							<a href="{{ route('admin.movies.edit', $movie->movie_id) }}" class="button button--edit color--grey"><i class="ion ion-edit"></i></a>
							<form action="{{ route('admin.movies.destroy', $movie->movie_id) }}" method="POST" class="float--left">
							    <input type="hidden" name="_method" value="DELETE">
							    <input type="hidden" name="_token" value="{{ csrf_token() }}">
							    <button class="button button--delete color--red"><i class="ion ion-trash-b"></i></button>
							</form>
						</div>

					</div>
				@endforeach
			</div>

			{{ $movies->links() }}
		@else
			<br clear="all">
			<br>
			<div class="log log--warning">Records Not Found.</div>
		@endif
	</div>
@endsection