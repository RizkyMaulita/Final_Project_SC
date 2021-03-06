<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\komentarpertanyaan;
use App\komentarjawaban;
use App\User;
use App\pertanyaan;
use App\pertanyaantag;
use App\jawaban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KomentarJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
    }
    // public function index()
    // {
    //     $komentar = komentarpertanyaan::all();
    //     //dd($komentar);
    //     return view('pertanyaans.index',compact('komentar'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $jawaban = jawaban::find($id);
        return view('komentarjawabans.create',compact('jawaban'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $komentar = komentarjawaban::create([
            'komentar' => $request->komentar,
            'user_id' => Auth::id(),
            'jawaban_id' => $id
        ]); 

        $idd = $komentar->jawaban->pertanyaan->id;
        return redirect("/pertanyaans/$idd")->with('berhasil','Komentar Anda Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komentar = komentarjawaban::find($id);
        return view('komentarjawabans.edit', compact('komentar'));
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
        $komentar = komentarjawaban::where('id',$id)
        ->update([
            'komentar' => $request -> komentar,
        ]);
        $comment = komentarjawaban::find($id);
        $idd = $comment->jawaban->pertanyaan->id;
        return redirect("/pertanyaans/$idd") -> with('Success', 'Komentar Anda telah diedit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = komentarjawaban::find($id);
        $idd = $comment -> jawaban -> pertanyaan -> id;
        $komentar = komentarjawaban::destroy($id);
        return redirect("/pertanyaans/$idd")->with('berhasil','Komentar Anda Berhasil Dihapus!');
    }
}

