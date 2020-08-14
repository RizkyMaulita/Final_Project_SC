@extends('adminlte.master')

@section('content')
<div class="ml-3 mt-3">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Question's Edit {{$pertanyaan -> id}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/pertanyaans/{{$pertanyaan -> id}}" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="judul"> Judul </label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $pertanyaan->judul) }}" placeholder="Masukkan judul pertanyaan">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror  
                </div>
                  <div class="form-group">
                    <label for="isi"> Isi Pertanyaan </label>
                    <input type="text" class="form-control" id="isi" name="isi" value="{{ old('isi',$pertanyaan->isi) }}" placeholder="Masukkan isi pertanyaan">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror 
                </div>
                <div class="form-group">
                    <label for="tags"> Tags </label>
                    <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags','') }}" placeholder="Pisahkan dengan koma, contoh: postingan,beritaterkini,update">
                    <!-- @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror  -->
                </div>
             </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> Update </button>
                </div>
              </form>
            </div>
</div>
@endsection