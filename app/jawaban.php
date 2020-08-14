<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function pertanyaan()
    {
        return $this->belongsTo('App\pertanyaan');
    }

    public function j_tepat()
    {
        return $this->hasOne('App\pertanyaan','jawaban_tepat_id');
    }
}
