<?php

namespace App\Http\Controllers\Def;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller {
	
	# Index
	public function index() {
		return view('pages.default.index', [
			'movies' => \App\Movies::first(),
			'popularTv' => \App\Movies::first(),
			'persons' => \App\Persons::Sorted(),
			'mm' => \App\Rate::first(),
			'casts' => \App\Cast::first(),
			'likes' => \App\Likes::first(),
		]);
	}

	# Movis
	public function movies(Request $request) {
		$type = $request->type;
		return view('pages.default.movies', [
			'movies' => \App\Movies::Sorted()->Type($type)->paginate(35),
			'mm' => \App\Rate::first(),
		]);
	}

	# Show Movis
	public function showMovies($id, $slug) {

		$views = \App\Movies::find($id)->first();
		$views->views += 1; 
		$views->save();

		return view('pages.default.showmovies', [
			'movie' => \App\Movies::find($id),
			'casts' => \App\Cast::first(),
			'backdrops' => \App\Backdrops::first(),
			'comments' => \App\Comments::first(),
			'rate' => \App\Rate::first(),
			'user' => \App\User::first(),
		]);
	}

	# Celebs
	public function celebs() {
		return view('pages.default.celebs', [
			'celebs' => \App\Persons::Sorted()->paginate(35),
			'casts' => \App\Cast::first(),
		]);
	}

	# Show Celebs
	public function showCelebs($id, $slug) {
		$getPerson = \App\Persons::find($id);
		$showPerson = tmdb()->getPerson($getPerson->tmdb)->get();
		$person = \App\Persons::firstOrCreate(['tmdb' => $getPerson->tmdb]);

		if ($showPerson['biography'] == '') {
			$person->biography = 'We don\'t have a biography for ' . $showPerson['name'];
		} else {
			$person->biography = $showPerson['biography'];
		}

		if ($showPerson['birthday'] == '') {
			$person->birth_date = '-';
		} else {
			$person->birth_date = $showPerson['birthday'];
		}

		if ($showPerson['place_of_birth'] == '') {
			$person->birth_place = '--';
		} else {
			$person->birth_place = $showPerson['place_of_birth'];
		}

		if ($showPerson['gender'] == 1) {
			$person->sex = 'Female';
		} else {
			$person->sex = 'Male';
		}
		
		$person->save();


		return view('pages.default.showcelebs', [
			'celeb' => \App\Persons::find($id),
			'casts' => \App\Cast::first(),
		]);
	}

	# News
	public function news() {
		return view('pages.default.news', [
			'news' => \App\News::Sorted()->paginate(10),
		]);
	}

	# Show News
	public function showNews($id, $slug) {
		return view('pages.default.shownews', [
			'news' => \App\News::find($id),
			'user' => \App\User::first(),
			'comments' => \App\Comments::first(),
		]);
	}

	# Favs
	public function favs() {
		if (\Auth::check()) {
			return view('pages.default.favourites', [
				'favs' => \App\Likes::first(),
				'movies' => \App\Movies::LikedMovies(\Auth::user()->id),
				'mm' => \App\Rate::first(),
			]);
		}

		return redirect()->guest('/');
	}

	# Vote
	public function vote(Request $request) {
		$comment = \App\Rate::firstOrCreate(['user_id' => \Auth::user()->id, 'type' => $request->type, 'type_id' => $request->id]);
		$comment->user_id = \Auth::user()->id;
		$comment->type = $request->type;
		$comment->type_id = $request->id;
		$comment->stars = $request->point;
		$comment->save();
	}

	# Like
	public function like(Request $request) {
		$like = \App\Likes::firstOrCreate(['user_id' => \Auth::user()->id, 'c_id' => $request->id]);

		if ($like->exists) {
        	$delete_like = \App\Likes::where('c_id', $request->id)->where('user_id', \Auth::user()->id);
			$delete_like->delete();
        }

		$like->user_id = \Auth::user()->id;
		$like->c_id = $request->id;
		$like->save();
	}

	# Contact
	public function contact() {
		return view('pages.default.contact', [
			
		]);
	}

	public function contactSend(Request $request) {
		\Mail::send('emails.plain', ['html' => $request->get('content')], function ($message) use ($request) {
			$message->from($request->get('email'), $request->get('name') . ' ' . $request->get('surname'));
			$message->to(\App\Settings::first()->contact_email)->subject('Contact!');
		});

		session()->flash('success', trans('website.message-sent'));

		return redirect()->back();
	}

	public function showPage($slug) {
		return view('pages.default.page', [
			'page' => \App\Page::where('slug', $slug)->first(),
		]);
	}

	public function search(Request $request) {
		return view('pages.default.search', [
			'movies' => \App\Movies::where('title', 'LIKE', '%'.$request->v.'%')->get(),
			'persons' => \App\Persons::where('name', 'LIKE', '%'.$request->v.'%')->get(),
			'mm' => \App\Rate::first(),
			'casts' => \App\Cast::first(),
		]);
	}
}