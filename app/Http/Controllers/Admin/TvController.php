<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TvController extends Controller {

	# getData
	public function getData($providerName, $id) {
		error_reporting(E_ALL ^ E_NOTICE);
		$showMovies = tmdb()->getTVShow($id)->get();
		$season = tmdb()->getSeason($id, 1)->get();

		$url = 'http://www.omdbapi.com/?i=' . $showMovies['external_ids']['imdb_id'];
    	$obj = json_decode(file_get_contents($url), true);

		$movie = \App\Movies::firstOrCreate(['tmdb_id' => $id, 'type' => 'tv']);
		$movie->title = $showMovies['name'];
		$movie->slug = str_slug($showMovies['name']);
		$genres = [];
		foreach ($showMovies['genres'] as $genre) {
			$genres[] = $genre['name'];
		}
		$movie->genres = implode(", ", $genres);
		$movie->overview = $showMovies['overview'];
		$movie->poster = $showMovies['poster_path'];
		$movie->trailer = $showMovies['videos']['results'][0]['key'];
		$movie->runtime = $showMovies['episode_run_time'][0];
		$writers = [];
		foreach ($season['episodes'][0]['crew'] as $writer) {
			if ($writer['department'] == 'Writing') {
            	$writers[] = $writer['name'];
            }
		}
		$movie->writers = implode(", ", $writers);
		
		$movie->release_date = $showMovies['first_air_date'];
		$movie->language = $showMovies['original_language'];
		$movie->imdb_rating = $obj['imdbRating'];
		$movie->tmdb_id = $showMovies['id'];
		$movie->type = 'tv';
		$movie->save();

		foreach ($showMovies['images']['backdrops'] as $backdrop => $bd) {
			$backdrop = \App\Backdrops::firstOrCreate(['movies_id' => $movie->movie_id, 'image' => $bd['file_path']]);
    		$backdrop->movies_id = $movie->movie_id;
    		$backdrop->image = $bd['file_path'];
    		$backdrop->save();
		}

		foreach ($season['credits']['cast'] as $cast) {
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

		foreach ($season['credits']['cast'] as $casts => $cast) {
			$person_id = \App\Persons::TMDB($cast['id'])->first()['person_id'];
			$casts = \App\Cast::firstOrCreate(['person_id' => $person_id]);
    		$casts->movies_id = $movie->movie_id;
    		$casts->person_id = $person_id;
    		$casts->character_name = $cast['character'];
    		$casts->save();
		}

		return \Response::json($showMovies);
	}
}