@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Create New</h1></div>
	<div class="page--contentBody">
		<form action="{{ route('admin.persons.update', $persons->person_id) }}" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
			<div class="form__group grid--12">
				<label class="label" for="name">Name</label>
                <input type="text" name="name" class="input input--large input--fluid" id="name" value="{{ $persons->name }}"/>

                @if($errors->has('name'))
					<div class="log log--error">{{ $errors->first('name') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="image">Image</label>
                <input type="text" name="image" class="input input--large input--fluid" id="image" value="{{ $persons->image }}"/>

                @if($errors->has('image'))
					<div class="log log--error">{{ $errors->first('image') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="biography">Biography</label>
                <textarea name="biography" class="input txt--large input--fluid" id="biography">{{ $persons->biography }}</textarea>

                @if($errors->has('biography'))
					<div class="log log--error">{{ $errors->first('biography') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="birth_date">Birth Date</label>
                <input type="text" name="birth_date" class="input input--large input--fluid" id="birth_date" value="{{ $persons->birth_date }}"/>

                @if($errors->has('birth_date'))
					<div class="log log--error">{{ $errors->first('birth_date') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="birth_place">Birth Place</label>
                <input type="text" name="birth_place" class="input input--large input--fluid" id="birth_place" value="{{ $persons->birth_place }}"/>

                @if($errors->has('birth_place'))
					<div class="log log--error">{{ $errors->first('birth_place') }}</div>
				@endif
			</div>

			<div class="form__group grid--12">
				<label class="label" for="sex">Sex</label>
                <input type="text" name="sex" class="input input--large input--fluid" id="sex" value="{{ $persons->sex }}"/>

                @if($errors->has('sex'))
					<div class="log log--error">{{ $errors->first('sex') }}</div>
				@endif
			</div>
			<button type="submit" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium">Submit</button>
			<button type="reset" class="button button--grey button--medium button--radius text--uppercase button--bottom-medium button--left-small">Reset</button>
		</form>
	</div>
@endsection