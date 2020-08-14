<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    protected $table = 'pertanyaans';
    protected $guarded = [];

    //one to many user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //one to many jawaban
    public function jawaban()
    {
        return $this->hasMany('App\jawaban');
    }

    //one to one jawaban
    public function j_tepat()
    {
        return $this->belongsTo('App\jawaban','jawaban_tepat_id');
    }

    //many to many tag
    public function tag()
    {
        return $this->belongsToMany('App\tag','pertanyaantags','pertanyaan_id','tag_id');
    }

    //one to many komentar pertanyaan
    public function komentarPertanyaan()
    {
        return $this->hasMany('App\komentarpertanyaan');
    }

    public function votePertanyaan()
    {
        return $this->hasMany('App\votepertanyaan');
    }

}
