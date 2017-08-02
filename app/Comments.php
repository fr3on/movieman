<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Comments extends Model {

	protected $table = 'comments';
	protected $primaryKey = 'comment_id';
    protected $fillable = ['type_id'];

	public $timestamps = true;

	public function scopeShow($query, $id, $type){
        return $query->where('type_id', $id)->where('type', $type);
    }

    public function scopeName($query, $id){
        return $query->where('user_id', $id);
    }

	public function scopeSorted($query){
    	return $query->orderBy('created_at', 'desc');
    }
}

