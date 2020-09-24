<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionier extends Model
{
    protected $guarded = [];

    public function choices(){
        return $this->hasMany('App\Choice');
    }

    public function survey(){
        return $this->belongsTo('App\Survey');
    }

    public function rightanswer(){
        return $this->hasOne('App\Rightanswer');
    }
}
