<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jawaban;
use App\User;
use App\pertanyaan;
use App\pertanyaantag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $jawab = jawaban::find($id);
        $tany = $jawab->pertanyaan->id;
        $jawab->save();
        $tayo = pertanyaan::find($tany);
        $tayo->jawaban_tepat_id = $id;
        $tayo->save();
        $questions = pertanyaan::find($id);
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

        $up = $questions->votePertanyaan->where('vote','up')->count();
        $down = $questions->votePertanyaan->where('vote','down')->count();
        $rep = ($up) - ($down);
        $pertanyaan = $rep;
 
        
        $vote['pertanyaan'] = $pertanyaan;
        $vote['jawaban'] = $jawaban;
        $vote['user'] = $user;
        return view('pertanyaans.show',compact('questions','vote'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pertanyaan = pertanyaan::find($id);
        return view('jawabans.create',compact('pertanyaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $jawaban = jawaban::create([
            'jawaban' => $request->jawaban,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $id
        ]); 
        return redirect("/pertanyaans/$id")->with('berhasil','Jawaban Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id1)
    {
        // $jawaban = Jawaban::where([
        //     'id' => $id,
        //     'user_id' => Auth::id(),
        //     'pertanyaan_id' => $id1
        // ]) -> first();
        // return view('jawabans.show', compact('jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        // $pertanyaan = Pertanyaan::find($id1);
        $jawaban = Jawaban::find($id);
        return view('jawabans.edit', compact('jawaban'));
        
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $jawaban = Jawaban::where('id',$id)
        -> update([
            'jawaban' => $request -> jawaban,
        ]);

        $answer = Jawaban::find($id);
        // $pertanyaan = Pertanyaan::find($answer -> jawaban_id);
        // $user = User::find(Auth::id());
        // $user->pertanyaan()->jawaban()->save($jawaban);
        // return view ('/pertanyaans/show');
        
        return redirect("/pertanyaans/$answer->pertanyaan_id") -> with('Success','Jawaban telah di edit');
        // return redirect("/pertanyaans/$id1/jawabans/$id")-> with('Success', 'Jawaban berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $answer = Jawaban::find($id);
        // $pertanyaan = Pertanyaan::find($answer -> pertanyaan_id);
        // $answer -> delete();
        // $pertanyaan = Pertanyaan::find($jawaban -> pertanyaan_id);
        // $jawaban->delete();
        $answer = Jawaban ::find($id);
        $answer->pertanyaan->jawaban_tepat_id = NULL;
        $jawaban = Jawaban::destroy($id);
        return redirect("/pertanyaans/$answer->pertanyaan_id")->with('berhasil','Jawaban Anda Berhasil Dihapus!');
    }
}
