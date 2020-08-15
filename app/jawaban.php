<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    protected $guarded = [];
    
    // one to many user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //one to many pertanyaan
    public function pertanyaan()
    {
        return $this->belongsTo('App\pertanyaan');
    }

    //one to one pertanyaan
    public function j_tepat()
    {
        return $this->hasOne('App\pertanyaan','jawaban_tepat_id');
    }

    public function komentarJawaban()
    {
        return $this->hasMany('App\komentarjawaban');
    }

    public function voteJawaban()
    {
        return $this->hasMany('App\votejawaban');
    }

    
}
