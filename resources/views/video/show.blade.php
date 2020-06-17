@extends ('layouts.app')

@section('content')
<div class="col-9 my-3">
    <div>
        <div>
            @auth
                @if (Auth::user()->id == $video->owner_id || auth()->user()->isAdmin)
                    <a href = "{{ action('VideoController@edit', $video_id) }}">
                        <button class="btn btn-primary float-right mr-4">Edit video details</button>
                    </a>
                    <a href = "{{ action('VideoController@delete', $video_id) }}">
                        <button class="btn btn-primary float-right mx-4">Delete the video</button>
                    </a>
                @endif
            @endauth
            <h1> {{ $video->title }} </h1>
        </div>
        
        @if (!$video->blocked)
        <video width="1280" height="720" controls class="my-3">
            <source src="{{ $video->path }}" type="video/mp4">
             Your browser does not support the video tag.
         </video>
        @else
        <h1 class="text-danger">This video is blocked</h1>
        @endif
        
        
        <div class="float-right mr-2">
            @include('like.operate')
        </div>     
        
        <div class="float-right mr-5">
            @include('subscription.operate')
        </div> 
        
        <div style="height: 64px">
            <a href="{{ action('UserController@show', $video->owner_id) }}">
                <img class="rounded-circle float-left mx-3" src="{{ $video->owner->avatarPath }}" alt="Avatar unavailable" width="64" height="64">
            </a>
            <a href="{{ action('UserController@show', $video->owner_id) }}">
                <h1 class="mt-1 d-inline">{{ $video->owner->name }} </h1>
            </a>
        </div>


        
           
        
        <hr>
        
        <h3>Description</h3>
        <p> {{ $video->description }} </p>
    </div>
    <hr>

    @include('comment.create')
    @include('comment.index')
</div>
@endsection