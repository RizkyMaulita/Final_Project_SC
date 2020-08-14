<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use App\tag;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::all();
        //dd($pertanyaans);
        return view('pertanyaans.index',compact('pertanyaans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaans.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:160',
            'isi' => 'required|max:255',
        ]);
        
        $tag = $request->tags;
        $tags = explode(",", $tag);
        $tag_ids = [];

        foreach($tags as $t){
            $ta = tag::firstOrCreate(['tag_name' => $t]);
            if($t != "")$tag_ids[] = $ta->id;
        }

        $pertanyaan = pertanyaan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id()
        ]);

        $pertanyaan->tag()->sync($tag_ids);
        
        $user = User::find(Auth::id());
        $user->pertanyaan()->save($pertanyaan);

        return redirect('/pertanyaans')->with('berhasil','Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Pertanyaan::where('id', $id)->first();
        return view('pertanyaans.show',compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::where('id', $id)->first();
        return view('pertanyaans.edit', compact('pertanyaan'));
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
        $validatedData = $request->validate([
            'judul' => 'required|max:160',
            'isi' => 'required|max:255',
        ]);
        
        $tag = $request->tags;
        $tags = explode(",", $tag);
        $tag_ids = [];

        foreach($tags as $t){
            $ta = tag::firstOrCreate(['tag_name' => $t]);
            if($t != "")$tag_ids[] = $ta->id;
        }

        $tanya = pertanyaan::where('id',$id)
            ->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id()
        ]);
        
        $pertanyaan = pertanyaan::find($id);
        
        $pertanyaan->tag()->sync($tag_ids);
        $user = User::find(Auth::id());
        $user->pertanyaan()->save($pertanyaan);

        return redirect('/pertanyaans')->with('berhasil','Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = pertanyaan::find($id);
        $pertanyaan->tag()->sync([]);
        $pertanyaan->delete();
        
        return redirect('/pertanyaans')->with('berhasil','Data Berhasil Dihapus!');
    }
}
