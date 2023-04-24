<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{

    protected $fillable = [
        'title',
        'keyword',
        'thumbnail',
        'poster',
        'genre_id',
        'detail',
        'a_language',
        'rating',
        'upload_audio',
        'maturity_rating',
        'featured',
        'type',
        'status',
        'is_protect',
        'password',
        'audiourl',
        'slug',
    ];
    public function menus()
    {
        return $this->hasMany('App\MenuVideo');
    }
    public function comments()
    {
        return $this->hasMany('App\MovieComment', 'audio_id');
    }
    public function subcomments()
    {
        return $this->hasMany('App\MovieSubcomment', 'audio_id');
    }
}
