@extends('adminlte.master')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> {{ $questions -> judul }} </h3>
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
                                    <div class="card-header">
                                        {{ $jawaban -> user ->name }}
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $jawaban -> jawaban }}</p>
                                        <!-- tombol -->
                                        <div style='display:flex;'>
                                        <a href="#" class="btn btn-primary btn-sm m-1">Komentari</a>
                                        @if($questions -> user -> id == Auth::id() || $jawaban -> user -> id == Auth::id())
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
                                    </div>
                                </div>
                            </div>

                        @empty
                            Belum ada jawaban
                        @endforelse
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
                                            <a href="#" class="btn btn-primary btn-sm m-1">Ubah</a>
                                            @endif
                                            <form action="#" method="POST">
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