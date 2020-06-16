@extends('layouts.app')

@section ('content')
<div class="d-flex flex-wrap">
    @foreach ($videos as $video)
        <div class="mx-auto px-5 my-2">
            <a href="{{ action('VideoController@show', $video->id) }}">
               <img src="{{ $video->thumbnailPath }}" alt="Thumbnail unavailable" width="426" height="240">
               <h3> {{ $video->title }} </h3> 
            </a>
        </div>
    @endforeach
</div>
@endsection