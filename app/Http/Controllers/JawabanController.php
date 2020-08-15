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
    public function index()
    {
        //
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
   public function edit($id1, $id)
    {
        $jawaban = Jawaban::where([
            'id' => $id,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $id1
        ])->first();
        return view('jawabans.edit', compact('jawaban'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id1, $id)
    {
        $jawaban = Jawaban::where('id',$id)
        -> update([
            'jawaban' => $request -> jawaban,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $id1
        ]);

        return redirect("/pertanyaans/$id1/jawabans/$id")-> with('Success', 'Jawaban berhasil di edit');
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