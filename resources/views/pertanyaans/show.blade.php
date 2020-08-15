@extends('adminlte.master')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> {{ $questions -> judul }} </h3>
                        <span class="float-sm-right">
                                @if($questions->user->id != Auth::id())

                                <a href="/pertanyaans/{{ $questions->id.',jawaban,up' }}/vote" class="m-1">
                                <i class="fa fa-thumbs-up " aria-hidden="true"></i></a>
                                @endif
                                <a class="btn btn-outline-secondary btn-xs">

                                {{ $vote['pertanyaan'] }}
                                </a>
                                
                                @if($vote['user'][ Auth::id() ] >=15 && $questions->user->id != Auth::id())
                                <a href="/pertanyaans/{{ $questions->id.',jawaban,down' }}/vote" class="m-1">
                                <i class="fa fa fa-thumbs-down text-red" aria-hidden="true"></i></a>
                                @endif
                            </span>
                        
                    </div>
                    <div class="card-body">
                        <p> {!! $questions -> isi !!} </p>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Jawaban </h3>
                    </div>
                    <div class="card-body">
                        @forelse($questions->jawaban as $jawaban)
                            <div> 
                                <div class="card">
                                    <div class="card-header justify-content-between">
                                        <span class="float-sm-left">
                                        <h5>{{ $jawaban -> user ->name }}</h5>
                                        
                                        </span>
                                        <span class="text-xs"> &nbsp &nbsp &nbsp Reputasi : {{ $vote['user'][ $jawaban->user->id ] }}</span>
                                        <span class="float-sm-right">
                                        @if($jawaban->pertanyaan->jawaban_tepat_id != NULL)
                                            <a class="m-1">
                                                <i class="fa fa-star text-orange" aria-hidden="true"></i>
                                            </a>  
                                        @endif
                                        @if($jawaban->user->id != Auth::id())
                                        <a href="/pertanyaans/{{ $jawaban->id.',jawaban,up' }}/vote/create" class="m-1">
                                        <i class="fa fa-thumbs-up " aria-hidden="true"></i></a>
                                        @endif
                                        <a class="btn btn-outline-secondary btn-xs">

                                            {{ $vote['jawaban'][ $jawaban->id ] }}
                                        </a>
                                        
                                        @if($vote['user'][ Auth::id() ] >=15 && $jawaban->user->id != Auth::id())
                                        <a href="/pertanyaans/{{ $jawaban->id.',jawaban,down' }}/vote/create" class="m-1">
                                        <i class="fa fa fa-thumbs-down text-red" aria-hidden="true"></i></a>
                                        @endif
                                        </span>
                                        
                                    </div>
                                    <div class=" card-body">
                                        <p class=" card-text">{!! $jawaban -> jawaban !!}</p>
                                        <!-- tombol -->
                                        <div style='display:flex;'>
                                        
                                        @if($jawaban -> user -> id == Auth::id())
                    
                                            <a href="/pertanyaans/{{ $jawaban -> id }}/jawabans" class="btn btn-primary btn-sm m-1">Tepat</a>
                                            <a href="/jawabans/{{ $jawaban -> id }}/edit" class="btn btn-primary btn-sm m-1">Ubah</a>
                                
                                            <form action="/jawabans/{{$jawaban -> id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="hapus" class="btn btn-danger btn-sm m-1">
                                            </form>
                                        @endif
                                        </div>
                                        <!-- <div class=" card-text"> -->
                                                <div class=" card"> 
                                                    <div class="card-header">
                                                        <h3 class="card-title"> Komentar </h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i> </button>
                                                    </div>
                                                </div>
                                                @forelse($jawaban->komentarJawaban as $komentar)
                                                <div class="card-body">
                                                    <div class="card p-1">
                                                        <h6> {{ $komentar -> user ->name }} </h6>
                                                        <p class="card-text">{!! $komentar -> komentar !!}</p>
                                                        <!-- tombol -->
                                                        <div style='display:flex;'>
                                                            @if($komentar -> jawaban -> user -> id == Auth::id() || $komentar -> user -> id == Auth::id())
                                                            @if($komentar -> user -> id == Auth::id())
                                                            <a href="/komentarjawabans/{{ $komentar -> id }}/edit" class="btn btn-primary btn-sm m-1">Ubah</a>
                                                            @endif
                                                            <form action="/komentarjawabans/{{ $komentar -> id }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" value="hapus" class="btn btn-danger btn-sm m-1">
                                                            </form>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <label align='center'> Belum ada komentar </label>
                                                @endforelse
                                                <a href="/jawabans/{{ $jawaban -> id }}/komentarjawabans/create" class="btn btn-primary btn-sm m-1">Komentar</a>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                            @empty
                                Belum ada jawaban
                            @endforelse
                            <a class="btn btn-primary mb-2" href="{{ $questions -> id }}/jawabans/create"> Buat Jawaban baru</a>
                    </div>
                </div>  
            </div>
          
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Informasi </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i> </button>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <dl class="row">
                        <dt class = "col-sm-6"> Nama Pembuat: </dt>
                        <dd class="col-sm-6"> {{$questions -> user -> name}} </dd>
                        <dt class=" col-sm-6"> Tanggal dibuat: </dt>
                        <dd class="col-sm-6"> {{$questions -> created_at}}</dd>
                        <dt class="col-sm-6"> Tanggal diupdate: </dt>
                        <dd class="col-sm-6"> {{$questions -> updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tags</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i> </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse($questions -> tag as $t)
                            <button class='btn btn-outline-secondary btn-sm'> {{ $t -> tag_name }} </button>
                            @empty 
                            No Tags
                        @endforelse 
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Komentar </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i> </button>
                        </div>
                    </div>
                    <div class="card-body"> 
                    @forelse($questions->komentarPertanyaan as $komentar)
                            <div>
                                <div class="card p-1">
                                       <h6> {{ $komentar -> user ->name }} </h6>
                                        <p class="card-text">{!! $komentar -> komentar !!}</p>
                                        <!-- tombol -->
                                        <div style='display:flex;'>
                                        @if($questions -> user -> id == Auth::id() || $komentar -> user -> id == Auth::id())
                                            @if($komentar -> user -> id == Auth::id())
                                            <a href="/komentarpertanyaans/{{ $komentar -> id }}/edit" class="btn btn-primary btn-sm m-1">Ubah</a>
                                            @endif
                                            <form action="/komentarpertanyaans/{{ $komentar -> id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="hapus" class="btn btn-danger btn-sm m-1">
                                            </form>
                                        @endif
                                        
                                        </div>
                                    
                                </div>
                            </div>

                        @empty
                            Belum ada komentar
                        @endforelse
                        <a class="btn btn-primary mb-2" href="{{ $questions -> id }}/komentarpertanyaans/create"> Buat Komentar baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection