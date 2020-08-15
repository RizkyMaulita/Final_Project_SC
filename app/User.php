<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //one to many pertanyaan
    public function pertanyaan()
    {
        return $this->hasMany('App\pertanyaan');
    }

    //one to many komentar pertanyaan
    public function komentarPertanyaan()
    {
        return $this->hasMany('App\komentarpertanyaan');
    }

    //one to many komentar jawaban
    public function komentarJawaban()
    {
        return $this->hasMany('App\komentarjawaban');
    }

    public function voteJawaban()
    {
        return $this->hasMany('App\votejawaban');
    }

    public function votePertanyaan()
    {
        return $this->hasMany('App\votepertanyaan');
    }

}
