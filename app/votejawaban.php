<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class votejawaban extends Model
{
    protected $guarded = [];

    //one to many user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //one to many jawaban
    public function jawaban()
    {
        return $this->belongsTo('App\jawaban');
    }
}
