<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    protected $table = 'pertanyaans';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jawaban()
    {
        return $this->hasMany('App\jawaban');
    }

    public function j_tepat()
    {
        return $this->belongsTo('App\jawaban','jawaban_tepat_id');
    }

    public function tag()
    {
        return $this->belongsToMany('App\tag','pertanyaantags','pertanyaan_id','tag_id');
    }
}
