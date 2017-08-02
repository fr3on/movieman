@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Update Slider</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.slider.update', $sliders->id) }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">

			<div class="form__group grid--12">
				<label class="label" for="id">ID</label>
                <input type="text" name="id" class="input input--large input--fluid" id="id" value="{{ $sliders->movie_id }}"/>

                @if($errors->has('id'))
					<div class="log log--error">{{ $errors->first('id') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label for="image" class="image">
					<input type="file" class="input image__input" name="image" id="image">
					<input type="hidden" name="old_image" value="{{ $sliders->image }}">
					<span class="image__text text--uppercase">Upload Image</span>
				</label>
			</div>

			<div class="imagePreview">
				
			</div>

			@if($errors->has('image'))
				<div class="log log--error">{{ $errors->first('image') }}</div><br>
			@endif

			<div class="form__group grid--12">
				<label class="label" for="sort">Sort</label>
                <input type="number" name="sort" class="input input--large input--fluid" id="sort"  value="{{ $sliders->sort }}"/>

                @if($errors->has('sort'))
					<div class="log log--error">{{ $errors->first('sort') }}</div>
				@endif
			</div>

			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection