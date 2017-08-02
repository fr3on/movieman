@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Add Slider</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.slider.store') }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form__group grid--12">
				<label class="label" for="id">ID</label>
                <input type="text" name="id" class="input input--large input--fluid" id="id" />

                @if($errors->has('id'))
					<div class="log log--error">{{ $errors->first('id') }}</div>
				@endif
			</div>


			<div class="form__group grid--12">
				<label for="image" class="image">
					<input type="file" class="input image__input" name="image" id="image">
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
                <input type="number" name="sort" class="input input--large input--fluid" id="sort" />

                @if($errors->has('sort'))
					<div class="log log--error">{{ $errors->first('sort') }}</div>
				@endif
			</div>

			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection