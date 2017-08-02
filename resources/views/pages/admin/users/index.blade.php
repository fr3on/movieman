@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Users</h1></div>
	<div class="page--contentBody">
		@if(session('success'))
		<div class="alert alert__success">
			<p>{{ session('success') }}</p>
		</div> 
		@endif

		@if (count($users) > 0)
			<div class="app__list">
				@foreach($users as $user)
					<div class="app__item">
						<div class="app__t" style="width: auto;">
							<h1>{{ $user->username }}</h1>
						</div>

						<div class="app__actions">
							<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="float--left">
							    <input type="hidden" name="_method" value="DELETE">
							    <input type="hidden" name="_token" value="{{ csrf_token() }}">
							    <button class="button button--delete color--red"><i class="ion ion-trash-b"></i></button>
							</form>
						</div>

					</div>
				@endforeach
			</div>

			{{ $users->links() }}
		@else
			<br clear="all">
			<br>
			<div class="log log--warning">Records Not Found.</div>
		@endif
	</div>
@endsection