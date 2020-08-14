@extends('adminlte.master')

@section('content')
    <div class="mt-3 ml-3">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pertanyaan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                  <div class="card pb-2 pt-2">
                    <div class="card-header">
                      {{ $pertanyaan -> user ->name }}
                    </div>
                    <div class="card-body">
                      <h4 class="card-title">{{ $pertanyaan -> judul }}</h4>
                      <br>
                      <p class="card-text">{{ $pertanyaan -> isi }}</p>
                      
                      <!-- tags -->
                      </div>
                      <div class="mt-2 ml-1" s>
                        <h7 >Tags :</h7>  
                        @forelse($pertanyaan -> tag as $tag)
                        <a href="#" class="btn btn-outline-secondary btn-sm m-1">{{$tag->tag_name}}</a>
                        @empty
                        Belum ada tags
                        @endforelse
                      </div>
                      
                      <!-- tombol -->
                      <div style='display:flex;'>
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
                      <!-- nav -->
                      <div>
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" href="#">Jawaban</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Komentar</a>
                          </li>
                        </ul>
                      </div>
                      <!-- jawaban -->
                      <div>
                        <div class="mt-2 p-2">
                          @forelse($pertanyaan->jawaban as $jawaban)
                          <div class="card-header">
                            {{ $jawaban -> user ->name }}
                          </div>
                          <div class="card-body">
                            <p class="card-text">{{ $jawaban -> jawaban }}</p>
                            <!-- tombol -->
                            <div style='display:flex;'>
                              <a href="#" class="btn btn-primary btn-sm m-1">Komentari</a>
                              @if($pertanyaan -> user -> id == Auth::id() || $jawaban -> user -> id == Auth::id())
                                @if($jawaban -> user -> id == Auth::id())
                                  <a href="#" class="btn btn-primary btn-sm m-1">Ubah</a>
                                @endif
                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="hapus" class="btn btn-danger btn-sm m-1">
                                </form>
                              @endif
                            
                            </div>
                            @empty
                            Belum Ada Jawaban
                          @endforelse
                        </div>
                      </div class="m-2 p-2">
                      <!-- komentar -->
                      <div>

                    </div>
                  </div>
                @empty
                    <h3>Belum Ada Pertanyaan</h3>
                @endforelse
                    
                    <!-- foreach dan forelse sesungguhnya sama, 
                    tetapi kelebihan dari forelse ialah ketika data kosong, maka bisa memunculkan notif/alert  -->
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                 </ul>
              </div> -->
            </div>
    </div>
@endsection