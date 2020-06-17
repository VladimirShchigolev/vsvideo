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

                    @forelse($errors->all() as $error)
                        <h1 class="has-error text-danger">{{ $error }}</h1>
                    @empty
                        <h4>Hello and welcome to the VSvideo, {{ Auth::user()->name }}</h4>
                    @endforelse
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
