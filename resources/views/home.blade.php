@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Kita Stuck </div>

                <div class="card-body">
                    Yuk Masuk ke Forum 'Kita Stuck'
                    <a href="/pertanyaans" class="btn btn-primary btn-sm m-1"> Forum </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
