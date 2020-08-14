<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komentarjawaban extends Model
{
    protected $table = 'komentarjawabans';
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
