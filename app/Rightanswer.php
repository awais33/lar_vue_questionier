<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rightanswer extends Model
{
    protected $guarded = [];

    public function questionier(){
        return $this->belongsTo('App\Questionier');
    }
}
