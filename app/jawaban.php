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
        return $this->belongsTo('App\Pertanyaan');
    }

    public function j_tepat()
    {
        return $this->hasOne('App\Pertanyaan','jawaban_tepat_id');
    }
}
