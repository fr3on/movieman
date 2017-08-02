@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Details</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.movies.store') }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form__group grid--12">
				<label class="label" for="type">Type</label>
				<select name="type" class="input sel--large input--fluid" id="type">
					<option value="movies">Movies</option>
					<option value="tv">Tv Shows</option>
				</select>
			</div>
			
			<div class="form__group grid--12">
				<label class="label" for="tmdb">TMDB id</label>
                <input type="text" name="tmdb" class="input input--large input--fluid" id="tmdb" />

                @if($errors->has('tmdb'))
					<div class="log log--error">{{ $errors->first('tmdb') }}</div>
				@endif
			</div>

			<button type="button" class="button button--primary button--medium button--radius text--uppercase button--bottom-medium" id="importMovies">Import Data</button>

			<div class="form__group grid--12">
				<label class="label" for="title">Title</label>
                <input type="text" name="title" class="input input--large input--fluid" id="title" />

                @if($errors->has('title'))
					<div class="log log--error">{{ $errors->first('title') }}</div>
				@endif
			</div>
			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>

		</div>

	
	</div>
@endsection