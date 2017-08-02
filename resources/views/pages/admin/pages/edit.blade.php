@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Update Page</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.pages.update', $pages->page_id) }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			 <input type="hidden" name="_method" value="PUT">

			<div class="form__group grid--12">
				<label class="label" for="title">Title</label>
                <input type="text" name="title" class="input input--large input--fluid" id="title" value="{{ $pages->title }}" />
                @if($errors->has('title'))
					<div class="log log--error">{{ $errors->first('title') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="slug">Slug</label>
                <input type="text" name="slug" class="input input--large input--fluid" id="slug" value="{{ $pages->slug }}"/>
                @if($errors->has('slug'))
					<div class="log log--error">{{ $errors->first('slug') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="content">Text</label>
                <textarea name="content" class="input txt--large input--fluid" rows="10" id="content" style="height: auto;">{{ $pages->content }}</textarea>
                @if($errors->has('content'))
					<div class="log log--error">{{ $errors->first('content') }}</div>
				@endif
			</div>

			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection