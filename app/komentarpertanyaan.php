<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komentarpertanyaan extends Model
{
    protected $table = 'komentarpertanyaans';
    protected $guarded = [];

    //one to many user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //one to many pertanyaan
    public function pertanyaan()
    {
        return $this->belongsTo('App\pertanyaan');
    }
}
