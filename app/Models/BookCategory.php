<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function Book(){
        return $this->hasMany(Book::class);
    }
}
