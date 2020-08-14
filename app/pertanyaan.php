<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Jawaban');
    }

    public function j_tepat()
    {
        return $this->belongsTo('App\Jawaban','jawaban_tepat_id');
    }
}
