@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Settings</h1></div>
	<div class="page--contentBody">
		@if(session('success'))
		<div class="alert alert__success">
			<p>{{ session('success') }}</p>
		</div> <br><br>
		@endif

		<form action="{{ route('admin.settings.store') }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form__group grid--12">
				<label class="label" for="site_name">Site Name</label>
                <input type="text" name="site_name" class="input input--large input--fluid" id="site_name" value="{{ $settings->site_name }}" />

                @if($errors->has('site_name'))
					<div class="log log--error">{{ $errors->first('site_name') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="site_description">Site Description</label>
                <input type="text" name="site_description" class="input input--large input--fluid" id="site_description" value="{{ $settings->site_description }}" />

                @if($errors->has('site_description'))
					<div class="log log--error">{{ $errors->first('site_description') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="footer_text">Footer Text</label>
                <input type="text" name="footer_text" class="input input--large input--fluid" id="footer_text" value="{{ $settings->footer_text }}" />

                @if($errors->has('footer_text'))
					<div class="log log--error">{{ $errors->first('footer_text') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="contact_email">Contact  Us Email</label>
                <input type="text" name="contact_email" class="input input--large input--fluid" id="contact_email" value="{{ $settings->contact_email }}" />

                @if($errors->has('contact_email'))
					<div class="log log--error">{{ $errors->first('contact_email') }}</div>
				@endif
			</div>
			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Save</button>
		</form>
	</div>
@endsection