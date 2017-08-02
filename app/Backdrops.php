<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Backdrops extends Model {

	protected $table = 'backdrops';
	protected $primaryKey = 'backdrop_id';
	protected $fillable = ['movies_id', 'image', 'type'];

	public $timestamps = true;

	public function scopeShow($query, $id){
    	return $query->where('movies_id', $id);
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

