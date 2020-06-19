@extends ('layouts.app')

@section('content')
<div class="col-9 my-3">
    <div>
        <div>
            @auth
                @if (Auth::user()->id == $video->owner_id || auth()->user()->isAdmin)
                    <form style="display: inline" action="{{ action('VideoController@edit', $video_id) }}" method="get">
                        <button class="btn btn-primary float-right mr-4">{{ __('messages.Edit_video_details') }}</button>
                    </form>
                    <form style="display: inline" action="{{ action('VideoController@delete', $video_id) }}" method="get">
                        <button class="btn btn-primary float-right mx-4">{{ __('messages.Delete_the_video') }}</button>
                    </form>
                    
                @endif
            @endauth
            <h1> {{ $video->title }} </h1>
        </div>
        
        @if (!$video->blocked)
        <video width="1280" height="720" controls class="my-3">
            <source src="{{ $video->path }}" type="video/mp4">
             {{ __('messages.Your_browser_does_not_support_the_video_tag') }}
         </video>
        @else
        <h1 class="text-danger">{{ __('messages.This_video_is_blocked') }}</h1>
        @endif
        
        
        <div class="float-right mr-2">
            @include('like.operate')
        </div>     
        
        <div class="float-right mr-5">
            @include('subscription.operate')
        </div> 
        
        <div style="height: 64px">
            <a href="{{ action('UserController@show', $video->owner_id) }}">
                <img class="rounded-circle float-left mx-3" src="{{ $video->owner->avatarPath }}" alt="{{ __('messages.Avatar_unavailable') }}" width="64" height="64">
            </a>
            <a href="{{ action('UserController@show', $video->owner_id) }}">
                <h1 class="mt-1 d-inline">{{ $video->owner->name }} </h1>
            </a>
        </div>
        
        <hr>
        
        <h3>{{ __('messages.Description') }}</h3>
        <p> {{ $video->description }} </p>
    </div>
    <hr>

    @include('comment.create')
    @include('comment.index')
</div>
@endsection