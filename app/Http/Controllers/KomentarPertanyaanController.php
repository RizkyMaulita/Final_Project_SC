<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\komentarpertanyaan;
use App\User;
use App\pertanyaan;
use App\pertanyaantag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KomentarPertanyaanController extends Controller
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
        $pertanyaan = pertanyaan::find($id);
        return view('komentarpertanyaans.create',compact('pertanyaan'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $komentar = komentarpertanyaan::create([
            'komentar' => $request->komentar,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $id
        ]); 
        return redirect("/pertanyaans/$id")->with('berhasil','Komentar Anda Berhasil Ditambahkan!');
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
        $komentar = komentarpertanyaan::find($id);
        return view('komentarpertanyaans.edit', compact('komentar'));
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
        $komentar = komentarpertanyaan::where('id',$id)
        ->update([
            'komentar' => $request -> komentar,
        ]);
        $comment = komentarpertanyaan::find($id);
        $idd = $comment->pertanyaan->id;
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
        $comment = komentarpertanyaan::find($id);
        $idd = $comment -> pertanyaan -> id;
        $komentar = komentarpertanyaan::destroy($id);
        return redirect("/pertanyaans/$idd")->with('berhasil','Komentar Anda Berhasil Dihapus!');
    }
}
