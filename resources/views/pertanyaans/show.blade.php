@extends('adminlte.master')

@section('content')
<div class="mt-3 ml-3">
    <h4> {{ $pertanyaan -> judul}} </h4>
    <p> {{ $pertanyaan -> isi}} </p>
    <!-- <p> Author : {{ $post -> author -> name }} </p> -->

    <div>
        Tags: 
        @forelse($pertanyaan -> tags as $tag)
            <button class='btn btn-primary btn-sm'> {{ $tag -> tag_name }} </button>

            @empty 
            No Tags
        @endforelse
    </div>
</div>
  
@endsection