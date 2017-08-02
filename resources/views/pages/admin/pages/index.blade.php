@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Pages</h1></div>
	<div class="page--contentBody">
		<a href="{{ route('admin.pages.create') }}" class="button button--primary button--medium button--radius text--uppercase"><i class="icon ion-plus"></i> Add Page</a>
		@if(session('success'))
		<div class="alert alert__success">
			<p>{{ session('success') }}</p>
		</div> 
		@endif

		@if (count($pages) > 0)
			<div class="app__list">
				@foreach($pages as $page)
					<div class="app__item">
						<div class="app__t" style="width: auto;">
							<h1>{{ $page->title }}</h1>
						</div>

						<div class="app__actions">
							<a href="{{ route('admin.pages.edit', $page->page_id) }}" class="button button--edit color--grey"><i class="ion ion-edit"></i></a>
							<form action="{{ route('admin.pages.destroy', $page->page_id) }}" method="POST" class="float--left">
							    <input type="hidden" name="_method" value="DELETE">
							    <input type="hidden" name="_token" value="{{ csrf_token() }}">
							    <button class="button button--delete color--red"><i class="ion ion-trash-b"></i></button>
							</form>
						</div>

					</div>
				@endforeach
			</div>

			{{ $pages->links() }}
		@else
			<br clear="all">
			<br>
			<div class="log log--warning">Records Not Found.</div>
		@endif
	</div>
@endsection