@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Create New</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.ads.store') }}" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form__group grid--12">
				<label class="label" for="google_analytics">Google Analytics</label>
                <textarea name="google_analytics" class="input txt--large input--fluid" id="google_analytics"></textarea>
			</div>

			<div class="form__group grid--12">
				<label class="label" for="ad_1">Ad slot #1</label>
                <textarea name="ad_1" class="input txt--large input--fluid" id="ad_1"></textarea>
			</div>

			<div class="form__group grid--12">
				<label class="label" for="ad_2">Ad slot #2</label>
                <textarea name="ad_2" class="input txt--large input--fluid" id="ad_2"></textarea>
			</div>

			<div class="form__group grid--12">
				<label class="label" for="ad_3">Ad slot #3</label>
                <textarea name="ad_3" class="input txt--large input--fluid" id="ad_3"></textarea>
			</div>

			<div class="form__group grid--12">
				<label class="label" for="ad_4">Ad slot #4</label>
                <textarea name="ad_4" class="input txt--large input--fluid" id="ad_4"></textarea>
			</div>

			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection