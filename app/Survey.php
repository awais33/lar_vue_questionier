<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Survey extends Authenticatable

{
    protected $guard = 'admin';
    protected $guarded = [];

    public function questioniers(){
        return $this->hasMany('App\Questionier');
    }

    public function choices(){
        return $this->hasMany('App\Choice');
    }

    public function questions()
    {
        return $this->questioniers()->union($this->choices()->getQuery());
    }
}
