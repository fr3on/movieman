<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	protected $table = 'rate';
	protected $primaryKey = 'rate_id';
    protected $fillable = ['user_id'];

	public $timestamps = true;

	public function scopeM($query, $id){
    	return $query->where('type_id', $id)->get();
    }

    public function scopeMME($query, $id){
        return $query->where('type_id', $id)
                     ->get();
    }

    public function scopeU($query){
    	return $query->where('user_id', \Auth::user()->id)->get();
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

