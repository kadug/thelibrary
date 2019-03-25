<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model{
	public $timestamps = false;

	public function Category(){
		return $this->belongsTo(BookCategory::class);
	}
}
