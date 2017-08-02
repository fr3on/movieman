<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Movies extends Model {

	protected $table = 'movies';
	protected $primaryKey = 'movie_id';
	protected $fillable = ['tmdb_id', 'type'];

	public $timestamps = true;

	public function setTitleAttribute($value) {
		$this->attributes['title'] = $value;

		if (!$this->exists) {
			$this->attributes['slug'] = str_slug($value);
		}
	}

    public function scopeUpcoming($query){
        return $query->where('release_date', '>', \Carbon\Carbon::today());
    }

    public function scopeReleased($query){
        return $query->where('release_date', '<', \Carbon\Carbon::today());
    }

    public function scopeType($query, $type){
        if ($type == null) {
            return $query->where('type', 'movies')->orderBy('created_at', 'desc');
        }

        if ($type == 'u') {
            return $query->where('release_date', '>', \Carbon\Carbon::today());
        }

        if ($type == 'p') {
            return $query->orderBy('views', 'desc');
        }

        if ($type == 'movies') {
            return $query->where('type', 'movies');
        }

        if ($type == 'tv') {
            return $query->where('type', 'tv');
        }
    }

    public function scopeByMovies($query){
        return $query->where('type', 'movies');
    }

    public function scopeByTv($query){
        return $query->where('type', 'tv');
    }

	public function scopeLikedMovies($query, $user){
    	return \DB::table('movies')
            ->join('likes', 'movies.movie_id', '=', 'likes.c_id')
            ->where('user_id', $user)
            ->get();
    }

    public function scopeMM($query, $id){
    	return \DB::table('movies')
            ->join('rate', 'movies.movie_id', '=', 'rate.type_id')
            ->where('type_id', '=', $id)
            ->avg('stars');
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }

    public function scopeViews($query){
        return $query->orderBy('views', 'desc');
    }

    public function scopeHasImdb($query){
        return $query->where('imdb_rating', '!=', 'N/A');
    }

    public function scopePopular($query){
    	return $query->orderBy('imdb_rating', 'desc');
    }

    public function scopeSid($query, $id){
        return $query->where('movie_id', $id);
    }

    public function scopeRandom($query){
        return $query->orderBy(\DB::raw('RAND()'));
    }

}

