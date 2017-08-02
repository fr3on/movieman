@extends('layouts.admin.layout')

@section('content')
	<div class="page--contentHead"><h1 class="title">Dashboard</h1></div>
	<div class="page--contentBody">
		<div class="sbox">
			<h1>Movies</h1>
			<span>{{ count($movies) }}</span>
		</div>

		<div class="sbox">
			<h1>TV Shows</h1>
			<span>{{ count($tv) }}</span>
		</div>

		<div class="sbox">
			<h1>Persons</h1>
			<span>{{ count($persons) }}</span>
		</div>

		<div class="sbox">
			<h1>News</h1>
			<span>{{ count($news) }}</span>
		</div>

		<div class="sbox">
			<h1>Users</h1>
			<span>{{ count($users) }}</span>
		</div>

		<div class="clear"></div>
	</div>
@endsection