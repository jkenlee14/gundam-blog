<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $table ='tablename'
    protected $table ='posts';
	public $primaryKey = 'id';
	public $timestamps = true;

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function category(){
		return $this -> belongsTo('App\Category');
	}

	public function tags(){
		return $this -> belongsToMany('App\Tag');
	}

	public static function archives(){
		return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
    	->groupBy('year', 'month')
    	->orderByRaw('min(created_at) desc')
    	->get()
    	->toArray();
	}
}
