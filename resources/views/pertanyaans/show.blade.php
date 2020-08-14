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
                        <p> isi Jawaban </p>
                    </div>
                </div>  
            </div>
          
            <div class="col-md-3">
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
                        <p> Isi Komentar </p>
                    </div>
                </div>
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
            </div>
        </div>
    </div>



@endsection