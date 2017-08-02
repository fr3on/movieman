<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model {

	protected $table = 'pages';
	protected $primaryKey = 'page_id';

	public $timestamps = true;

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

