<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;

class MoviesController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.movies.index', [
			'movies' => \App\Movies::Sorted()->paginate(10)
		]);
	}

	# Create
	public function create() {
		return view('pages.admin.movies.create', [
			'persons' => \App\Persons::Sorted()->get()
		]);
	}

	# Edit
	public function edit($id) {
		return view('pages.admin.movies.edit', [
	    	'movies' => \App\Movies::find($id),
	    ]);
  	}

	# getData
	public function getData($providerName, $id) {
		error_reporting(E_ALL ^ E_NOTICE);
		$showMovies = tmdb()->getMovie($id)->get();

		$url = 'http://www.omdbapi.com/?i=' . $showMovies['imdb_id'];
    	$obj = json_decode(file_get_contents($url), true);

		$movie = \App\Movies::firstOrCreate(['tmdb_id' => $showMovies['id'], 'type' => 'movies']);
		$movie->title = $showMovies['original_title'];
		$movie->slug = str_slug($showMovies['original_title']);
		$genres = [];
		foreach ($showMovies['genres'] as $genre) {
			$genres[] = $genre['name'];
		}
		$movie->genres = implode(", ", $genres);
		$movie->overview = $showMovies['overview'];
		$movie->poster = $showMovies['poster_path'];
		$movie->trailer = $showMovies['trailers']['youtube'][0]['source'];
		$movie->runtime = $showMovies['runtime'];
		$director = [];
		foreach ($showMovies['casts']['crew'] as $genre) {
			if ($genre['job'] == 'Director') {
            	$director[] = $genre['name'];
            }
		}
		$movie->director = implode(", ", $director);
		$writers = [];
		foreach ($showMovies['casts']['crew'] as $writer) {
			if ($writer['department'] == 'Writing') {
            	$writers[] = $writer['name'];
            }
		}
		$movie->writers = implode(", ", $writers);
		$movie->release_date = $showMovies['release_date'];
		$movie->language = $showMovies['original_language'];
		$movie->budget = $showMovies['budget'];
		$movie->imdb_rating = $obj['imdbRating'];
		$movie->tmdb_id = $showMovies['id'];
		$movie->type = 'movies';
		$movie->save();

		foreach ($showMovies['images']['backdrops'] as $backdrop => $bd) {
			$backdrop = \App\Backdrops::firstOrCreate(['movies_id' => $movie->movie_id, 'image' => $bd['file_path']]);
    		$backdrop->movies_id = $movie->movie_id;
    		$backdrop->image = $bd['file_path'];
    		$backdrop->save();
		}

		foreach ($showMovies['casts']['cast'] as $cast) {
			$showPerson = tmdb()->getPerson($cast['id'])->get();
			$person = \App\Persons::firstOrCreate(['tmdb' => $cast['id']]);
    		$person->name = $cast['name'];
    		$person->slug = str_slug($cast['name']);
    		$person->image = $cast['profile_path'];
    		if ($cast['profile_path'] == '') {
    			$person->image = env('APP_URL').'public/assets/images/movieman-poster.png';
    		}
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
			$person->birth_place = $showPerson['place_of_birth'];
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
    		$person->tmdb = $cast['id'];
    		$person->save();
		}

		foreach ($showMovies['casts']['cast'] as $casts => $cast) {
			$person_id = \App\Persons::TMDB($cast['id'])->first()['person_id'];
			$casts = \App\Cast::firstOrCreate(['movies_id' => $movie->movie_id, 'character_name' => $cast['character']]);
    		$casts->movies_id = $movie->movie_id;
    		$casts->person_id = $person_id;
    		$casts->character_name = $cast['character'];
    		$casts->save();
		}

		return \Response::json($showMovies);
	}

	# Store
	public function store(Requests\StoreMoviesRequest $request) {
		session()->flash('success', 'Success!');
		return redirect()->route('admin.movies.index');
	}

	# Update
	public function update(Requests\UpdateMoviesRequest $request, $id) {
		$movie = \App\Movies::find($id);
		$movie->title = $request->title;
		$movie->genres = $request->genres;
		$movie->overview = $request->overview;
		$movie->poster = $request->poster;
		$movie->runtime = $request->runtime;
		$movie->director = $request->director;
		$movie->writers = $request->writers;
		$movie->release_date = $request->release_date;
		$movie->language = $request->language;
		$movie->budget = $request->budget;

		session()->flash('success', 'Success!');
		return redirect()->route('admin.movies.index');
	}

	# Delete
	public function destroy($id){
		$movie = \App\Movies::find($id);
		$movie->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.movies.index');
  	}
}
