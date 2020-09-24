<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $guarded = [];

    public function questionier(){
        return $this->belongsTo('App\questionier');
    }

    public function survey(){
        return $this->belongsTo('App\Survey');
    }
}
