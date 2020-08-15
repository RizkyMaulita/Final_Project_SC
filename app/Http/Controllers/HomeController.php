<?php

namespace App\Http\Controllers;

use App\jawaban;
use App\pertanyaan;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::orderBy('created_at','desc')->get();
        $pertanyaan1 = pertanyaan::get();
        $jawaban1 = jawaban::get();
        $user1 = User:: get();

        $user = [];
        foreach($user1 as $use){
            $tampungan = 0;
            foreach($use->pertanyaan as $tanya){
                $up = $tanya->votePertanyaan->where('vote','up')->count();
                $down = $tanya->votePertanyaan->where('vote','down')->count();
                $tampungan += ($up * 10)-$down;
            }

            foreach($use->jawaban as $jawab){
            
                $up = $jawab->voteJawaban->where('vote','up')->count();
                $down = $jawab->voteJawaban->where('vote','down')->count();
                $tampungan += ($up * 10) - $down;
            }
            //dd($tampungan);
            $user[$use->id] = $tampungan;
            //dd($rep);
        }

        $jawaban = [];
        foreach($jawaban1 as $jawab){
            
            $up = $jawab->voteJawaban->where('vote','up')->count();
            $down = $jawab->voteJawaban->where('vote','down')->count();
            $rep = ($up) - ($down);
            $jawaban[$jawab->id] = $rep;
        }

        $pertanyaan = [];
        foreach($pertanyaan1 as $tanya){
            
            $up = $tanya->votePertanyaan->where('vote','up')->count();
            $down = $tanya->votePertanyaan->where('vote','down')->count();
            $rep = ($up) - ($down);
            $pertanyaan[$tanya->id] = $rep;
        }
        
        $vote[] = $pertanyaan;
        $vote[] = $jawaban;
        $vote[] = $user;

        //dd($vote);

        return view('pertanyaans.index',compact('pertanyaans','vote'));
    }
}
