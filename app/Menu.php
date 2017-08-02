<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model {

	protected $table = 'navigation';
	protected $primaryKey = 'menu_id';

	public $timestamps = true;

	public function scopeOfBlock($query){
    	return $query->where('menu', 'block');
    }

    public function scopeOfFooter($query){
        return $query->where('menu', 'footer');
    }

	public function scopeSorted($query){
    	return $query->orderBy('sort', 'desc');
    }
}

