<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Persons extends Model {

	protected $table = 'persons';
	protected $primaryKey = 'person_id';
	protected $fillable = ['tmdb'];

	public $timestamps = true;

	public function setNameAttribute($value) {
		$this->attributes['name'] = $value;

		if (!$this->exists) {
			$this->attributes['slug'] = str_slug($value);
		}
	}

	public function scopeTMDB($query, $id){
        return $query->where('tmdb', $id)->select('person_id');
    }

    public function scopeShowid($query, $id){
        return $query->where('person_id', $id)->select('tmdb');
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'asc');
    }


}

