@extends('layouts.app')

@section ('content')
<div>
    @foreach ($videos as $video)
        <div class="container">
            <a href="{{ action('VideoController@show', $video->id) }}">
               <h1> {{ $video->title }} </h1> 
            </a>
        </div>
    @endforeach
</div>
@endsection