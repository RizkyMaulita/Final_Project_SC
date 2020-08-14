@extends('adminlte.master')

@section('content')
<div class="mt-3 ml-3">
    <h4> {{ $questions -> judul}} </h4>
    <p> {!! $questions -> isi !!} </p>
    <p> Author : {{ $questions -> user -> name }} </p>

    <div>
        Tags: 
        @forelse($questions -> tag as $t)
            <button class='btn btn-primary btn-sm'> {{ $t -> tag_name }} </button>

            @empty 
            No Tags
        @endforelse
    </div>
</div>
  
@endsection