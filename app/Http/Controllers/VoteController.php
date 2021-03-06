<?php

namespace App\Http\Controllers;

use App\User;
use App\jawaban;
use App\pertanyaan;
use App\votejawaban;
use App\votepertanyaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param)
    {
        $id = explode(',',$param);
        $user = Auth::User();
        $vote = votepertanyaan::where('user_id',$user->id)
                    ->where('pertanyaan_id',$id[0])
                    ->first();
        
        if($vote == NULL){
            $newVote = new votepertanyaan;
            $newVote->user_id = $user->id;
            $newVote->pertanyaan_id = $id[0];
            $newVote->vote = $id[2];
            $newVote->save();
        }else if($id[2] == "up"){
            $vote->vote = "up";
            $vote->save();
        }else if($id[2] == "down"){
            $vote->vote = "down";
            $vote->save();
        }

        //dd($vote);

        if($id[1]=="pertanyaans"){
            return redirect('/pertanyaans');
        }else if($id[1]=="jawab"){
            return redirect("/pertanyaans/$id[0]");
        }
        else{
            $jawab = jawaban::find($id[0]);
            $idd = $jawab->pertanyaan->id;
            return redirect("/pertanyaans/$idd");
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($param)
    {
        $id = explode(',',$param);
        $user = Auth::User();
        $vote = votejawaban::where('user_id',$user->id)
                    ->where('jawaban_id',$id[0])
                    ->first();
        
        if($vote == NULL){
            $newVote = new votejawaban;
            $newVote->user_id = $user->id;
            $newVote->jawaban_id = $id[0];
            $newVote->vote = $id[2];
            $newVote->save();
        }else if($id[2] == "up"){
            $vote->vote = "up";
            $vote->save();
        }else if($id[2] == "down"){
            $vote->vote = "down";
            $vote->save();
        }

        //dd($vote);

        if($id[1]=="pertanyaans"){
            return redirect('/pertanyaans');
        }else{
            $jawab = jawaban::find($id[0]);
            $idd = $jawab->pertanyaan->id;
            return redirect("/pertanyaans/$idd");
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
        

      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
