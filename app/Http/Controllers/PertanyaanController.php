<?php

namespace App\Http\Controllers;
use App\komentarjawaban;
use App\komentarpertanyaan;
use Illuminate\Http\Request;
use App\pertanyaan;
use App\tag;
use App\User;
use App\jawaban;
use App\votejawaban;
use App\votepertanyaan;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = pertanyaan::where('id', $id)->first();
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
        
        $apasih= pertanyaan::destroy($id);
        
        return redirect('/pertanyaans')->with('berhasil','Data Berhasil Dihapus!');
    }
}
