@extends('layouts.app')

@section ('content')
<div class="d-flex flex-wrap">
    @foreach ($videos as $video)
        <div class="ml-2 px-5 my-2" style="width:436px">
            <a href="{{ action('VideoController@show', $video->id) }}">
               <img class="my-1" src="{{ $video->thumbnailPath }}" alt="{{ __('messages.Thumbnail unavailable') }}" width="426" height="240">   
            </a>
            <div class="my-2">
                <a href="{{ action('UserController@show', $video->owner_id) }}">
                        <img class="rounded-circle float-left mx-3" src="{{ $video->owner->avatarPath }}" alt="{{ __('messages.Avatar_unavailable') }}" width="64" height="64">
                </a>
                <div style="width: 400px">
                    <a href="{{ action('VideoController@show', $video->id) }}">
                       <h3 class="text-truncate"> {{ $video->title }} </h3> 
                    </a>
                    <a  href="{{ action('UserController@show', $video->owner_id) }}">
                        <h5 class="text-truncate">{{ $video->owner->name }} </h5>
                    </a>
                </div>
            </div>
        </div>
        
    @endforeach
</div>
@endsection