<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model {

	protected $table = 'likes';
	protected $primaryKey = 'like_id';
	protected $fillable = ['user_id'];

	public $timestamps = true;

	public function scopeF($query, $id){
    	return $query->where('c_id', $id)->where('user_id', \Auth::user()->id)->get();
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

