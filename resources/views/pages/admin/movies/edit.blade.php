@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Update</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.movies.update', $movies->movie_id) }}" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
			<div class="form__group grid--12">
				<label class="label" for="title">Title</label>
                <input type="text" name="title" class="input input--large input--fluid" id="title" value="{{ $movies->title }}" />

                @if($errors->has('title'))
					<div class="log log--error">{{ $errors->first('title') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="genres">Genres</label>
                <input type="text" name="genres" class="input input--large input--fluid" id="genres" value="{{ $movies->genres }}"/>

                @if($errors->has('genres'))
					<div class="log log--error">{{ $errors->first('genres') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="overview">Overview</label>
                <textarea name="overview" class="input txt--large input--fluid" id="overview">{{ $movies->overview }}</textarea>

                @if($errors->has('overview'))
					<div class="log log--error">{{ $errors->first('overview') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="poster">Poster</label>
                <input type="text" name="poster" class="input input--large input--fluid" id="poster" value="{{ $movies->poster }}"/>

                @if($errors->has('poster'))
					<div class="log log--error">{{ $errors->first('poster') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="trailer">Trailer</label>
                <input type="text" name="trailer" class="input input--large input--fluid" id="trailer" value="{{ $movies->trailer }}"/>

                @if($errors->has('trailer'))
					<div class="log log--error">{{ $errors->first('trailer') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="runtime">Runtime</label>
                <input type="text" name="runtime" class="input input--large input--fluid" id="runtime" value="{{ $movies->runtime }}"/>

                @if($errors->has('runtime'))
					<div class="log log--error">{{ $errors->first('runtime') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="director">Director</label>
                <input type="text" name="director" class="input input--large input--fluid" id="director" value="{{ $movies->director }}"/>

                @if($errors->has('director'))
					<div class="log log--error">{{ $errors->first('director') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="writers">Writers</label>
                <input type="text" name="writers" class="input input--large input--fluid" id="writers" value="{{ $movies->writers }}"/>

                @if($errors->has('writers'))
					<div class="log log--error">{{ $errors->first('writers') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="release_date">Release Date</label>
                <input type="text" name="release_date" class="input input--large input--fluid" id="release_date" value="{{ $movies->release_date }}"/>

                @if($errors->has('release_date'))
					<div class="log log--error">{{ $errors->first('release_date') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="language">Language</label>
                <input type="text" name="language" class="input input--large input--fluid" id="language" value="{{ $movies->language }}"/>

                @if($errors->has('language'))
					<div class="log log--error">{{ $errors->first('language') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="budget">Budget</label>
                <input type="text" name="budget" class="input input--large input--fluid" id="budget" value="{{ $movies->budget }}"/>

                @if($errors->has('budget'))
					<div class="log log--error">{{ $errors->first('budget') }}</div>
				@endif
			</div>
			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection