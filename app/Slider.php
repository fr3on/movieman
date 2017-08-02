<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Slider extends Model {

	protected $table = 'slider';

	public $timestamps = true;

	public function scopeShowm($query){
    	return DB::table('movies')
            ->join('slider', 'movies.movie_id', '=', 'slider.movie_id')
            ->orderBy('sort', 'asc')
            ->get();
    }

	public function scopeSorted($query){
    	return $query->orderBy('sort', 'desc');
    }
}

