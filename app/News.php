<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class News extends Model {

	protected $table = 'news';

	public $timestamps = true;

	public function setTitleAttribute($value) {
		$this->attributes['title'] = $value;

		if (!$this->exists) {
			$this->attributes['slug'] = str_slug($value);
		}
	}

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

