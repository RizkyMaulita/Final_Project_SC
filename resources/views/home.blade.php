@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8">
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
        </div> -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Kamu stack dalam mengerjakan coding ? </div>

                <div class="card-body">
                    <p> Sama !! Daripada kita bingung karena stack, lebih baik masuk yuk ke Forum 'Kita Stack' </p>
                    <a href="/pertanyaans" class="btn btn-primary btn-sm m-1"> Forum Kita Stack </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
