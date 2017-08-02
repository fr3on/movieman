<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller {
	
	# Index
	public function index() {
		$movies = \App\Movies::where('type', 'movies')->first();
		$tv = \App\Movies::where('type', 'tv')->first();
		$persons = \App\Persons::first();
		$news = \App\News::first();
		$users = \App\User::first();
		
		if (count($tv) > 0) {
			$tv = \App\Movies::where('type', 'tv')->get();
		}

		if (count($movies) > 0) {
			$movies = \App\Movies::where('type', 'movies')->get();
		}

		if (count($persons) > 0) {
			$persons = \App\Persons::first()->get();
		}

		if (count($news) > 0) {
			$news = \App\News::first()->get();
		}

		if (count($users) > 0) {
			$users = \App\User::first()->get();
		}

		return view('pages.admin.index', [
			'movies' => $movies,
			'tv' => $tv,
			'persons' => $persons,
			'news' => $news,
			'users' => $users
		]);
	}
}