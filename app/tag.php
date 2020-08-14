<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $guarded = [];


    public function pertanyaan()
    {
        return $this->belongsToMany('App\pertanyaan','pertanyaantags','user_id','pertanyaan_id');
    }
}
