<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        // restituisce un array di entità
        return $this->hasMany('App\Post');
    }
}
