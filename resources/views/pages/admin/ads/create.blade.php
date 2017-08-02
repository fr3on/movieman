@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Create New</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.news.store') }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form__group grid--12">
				<label class="label" for="title">Title</label>
                <input type="text" name="title" class="input input--large input--fluid" id="title" />
			</div>

			<div class="form__group grid--12">
				<label class="label" for="content">Text</label>
                <textarea name="content" class="input txt--large input--fluid" id="content"></textarea>
			</div>

			<div class="form__group grid--12">
				<label for="image" class="image">
					<input type="file" class="input image__input" name="image" id="image">
					<span class="image__text text--uppercase">Upload Image</span>
				</label>
			</div>

			<div class="imagePreview">
				
			</div>

			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection