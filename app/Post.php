<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id'
    ];


    public function category(){
        // mi restituisce una singola entità
        return $this->belongsTo('App\Category');
    }
}
