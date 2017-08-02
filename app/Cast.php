<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Cast extends Model {

	protected $table = 'casts';
	protected $primaryKey = 'cast_id';
    protected $fillable = ['person_id'];

	public $timestamps = true;

	public function scopeShow($query, $id){
    	return DB::table('persons')
            ->join('casts', 'persons.person_id', '=', 'casts.person_id')
            ->where('movies_id', $id)
            ->take(15)->get();
    }

    public function scopeCredits($query, $id){
        return $query->where('person_id', $id)->get();
    }

    public function scopeActing($query, $id){
        return DB::table('casts')
            ->join('movies', 'casts.movies_id', '=', 'movies.movie_id')
            ->where('person_id', $id)
            ->orderBy('release_date', 'desc')
            ->get();
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

