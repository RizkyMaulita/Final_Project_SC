@extends('adminlte.master')

@section('content')
<div class="mt-3 ml-3">
            @if(session('berhasil'))
                  <div class="alert alert-success">
                      {{ session('berhasil')}}
                  </div>
            @endif
                            <!-- yang ini menggunakan link  -->
          <!-- <a class="btn btn-primary mb-2" href="/posts/create"> Create New Post</a> -->
                              <!-- yang ini menggunakan nama route -->
          <a class="btn btn-primary mb-2" href="{{ route('pertanyaans.create') }}"> Buat pertanyaan baru</a>
          
          @forelse($pertanyaans as $key => $pertanyaan)

            <div class="card">
              <div class="card-header justify-content-between">
                <span class="float-sm-left">
                <h5>{{ $pertanyaan -> user ->name }}</h5>
                
                </span>
                <span class="text-xs"> &nbsp &nbsp &nbsp Reputasi : {{ $vote[2][ $pertanyaan->user->id ] }}</span>
                <span class="float-sm-right">
                  @if($pertanyaan -> user -> id != Auth::id())
                  <a href="/pertanyaans/{{ $pertanyaan->id.',pertanyaans,up' }}/vote" class="m-1">
                  <i class="fa fa-thumbs-up " aria-hidden="true"></i></a>
                  @endif
                  <a class="btn btn-outline-secondary btn-xs">

                    {{ $vote[0][ $pertanyaan->id ] }}
                  </a>
                  
                  @if($vote[2][ Auth::id() ] >=15 && $pertanyaan -> user -> id != Auth::id())
                  <a href="/pertanyaans/{{ $pertanyaan->id.',pertanyaans,down' }}/vote" class="m-1">
                  <i class="fa fa fa-thumbs-down text-red" aria-hidden="true"></i></a>
                  @endif
                </span>
                  
              </div>
              <div class="card-body">
                <h4 class="card-title">{{ $pertanyaan -> judul }}</h4>
                <br>
                <p class="card-text">{!! $pertanyaan -> isi !!}</p>
              </div> 
              
              <!-- tags -->
                
              <div class="mt-2 ml-3">
                <h7 >Tags :</h7>  
                @forelse($pertanyaan -> tag as $tag)
                <a href="#" class="btn btn-outline-secondary btn-xs m-1 ">{{$tag->tag_name}}</a>
                @empty
                Belum ada tags
                @endforelse
              </div>
                
              <!-- tombol -->
              <div style='display:flex;' class="ml-3">
                <a href="/pertanyaans/{{ $pertanyaan->id }}" class="btn btn-primary btn-sm m-1">Lihat</a>
                @if($pertanyaan -> user -> id == Auth::id())
                <a href="/pertanyaans/{{$pertanyaan->id }}/edit" class="btn btn-primary btn-sm m-1">Ubah</a>
                <form action="/pertanyaans/{{$pertanyaan->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="hapus" class="btn btn-danger btn-sm m-1">
                </form>
                @endif
              
              </div>
                <div class="row">
                <!-- jawaban -->
                  <div class="m-2 col-md">
                    <h6>Jawaban :</h6>
                    @if($pertanyaan->jawaban->count() > 0)
                      @if($pertanyaan->jawaban_tepat_id != NULL)
                        <?php 
                        $jawaban = $pertanyaan->j_tepat;
                        ?>
                      @else
                        <?php 
                        $s = $pertanyaan->jawaban->count();
                        $jawaban = $pertanyaan->jawaban[$s-1];
                        ?>
                      @endif
                        <div class="card">
                          <div class="card-header justify-content-between mt-2">
                            
                            <span class="float-sm-left">
                            
                            <h5>{{ $jawaban -> user ->name }}</h5>
                            
                            </span>
                            <span class="text-xs"> &nbsp &nbsp &nbsp Reputasi : {{ $vote[2][ $jawaban->user->id ] }}</span>
                            <span class="float-sm-right">
                            @if($pertanyaan->jawaban_tepat_id != NULL)
                              <a class="m-1">
                                <i class="fa fa-star text-orange" aria-hidden="true"></i>
                              </a>  
                            @endif
                              @if($jawaban->user->id != Auth::id())
                              <a href="/pertanyaans/{{ $jawaban->id.',pertanyaans,up' }}/vote/create" class="m-1">
                              
                              <i class="fa fa-thumbs-up " aria-hidden="true"></i></a>
                              @endif
                              <a class="btn btn-outline-secondary btn-xs">

                                {{ $vote[1][ $jawaban->id ] }}
                              </a>
                              @if($vote[2][ Auth::id() ] >=15 && $jawaban->user->id != Auth::id())
                              <a href="/pertanyaans/{{ $jawaban->id.',pertanyaans,down' }}/vote/create" class="m-1">
                              <i class="fa fa fa-thumbs-down text-red" aria-hidden="true"></i></a>
                              @endif
                            </span>
                              
                          </div>
                        
                          <div class="card-body">
                            <p class="card-text">{!! $jawaban -> jawaban !!}</p>
                          </div>
                        </div>
                      
                    @else
                      Belum Ada Jawaban
                    
                      @endif
                  
                  </div>
                
                <!-- komentar -->
                  <div class="m-2 col-md">
                    <h6>Komentar :</h6>
                    @if($pertanyaan->komentarPertanyaan->count() > 0)
                      <?php 
                      $s = $pertanyaan->komentarPertanyaan->count();
                      $komentar = $pertanyaan->komentarPertanyaan[$s-1];
                      ?>
                      <div class="card">
                        <div class="card-header p-3 pt-4">
                          <h6>{{ $komentar -> user ->name }}</h6>
                        </div>
                        <div class="card-body">
                          <p class="card-text">{!! $komentar -> komentar !!}</p>
                      </div>
                    </div>
                    @else
                      Belum Ada Komentar
                    
                      @endif
                  
                  </div>          
                </div>
              </div>
            @empty
                <h3>Belum Ada Pertanyaan</h3>
            
            @endforelse
              
              <!-- foreach dan forelse sesungguhnya sama, 
              tetapi kelebihan dari forelse ialah ketika data kosong, maka bisa memunculkan notif/alert  -->
<div>

@endsection