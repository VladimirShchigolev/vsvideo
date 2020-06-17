@extends ('layouts.app')

@section('content')
<div class="row">
    <div class="col-10">
        <div class="my-3">  
            <div class="float-right mr-5 mt-5">
                @include('subscription.operate')
            </div> 

            <div style="height: 150px">
                <img class="rounded-circle float-left mx-5" src="{{ $user->avatarPath }}" alt="Avatar unavailable" width="128" height="128">
                <h1> {{ $user->name }} </h1>
                @auth
                    @if (Auth::user()->id == $user->id || auth()->user()->isAdmin)
                        <a href = "{{ action('UserController@edit', $user->id) }}">
                            <button class="btn btn-primary">Edit Profile</button>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
        <hr>

        <div class="container-fluid">
            <div class="ml-5">
                @auth
                    @if (Auth::user()->id == $user->id)
                        <a href = "{{ action('VideoController@create', $user->id) }}">
                            <button class="btn btn-primary float-right">Upload a video</button>
                        </a>
                    @endif
                @endauth
                <h2>{{ $user->name }} videos</h2>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($videos as $video)
                    @if (!$video->blocked && ($video->public || (Auth::check() && (auth()->user()->isAdmin || auth()->id() == $user->id))))
                        <div class="mr-2 px-5 my-2"  style="width:436px">
                        <a href="{{ action('VideoController@show', $video->id) }}">
                           <img class="my-1" src="{{ $video->thumbnailPath }}" alt="Thumbnail unavailable" width="426" height="240">   
                        </a>
                        <div class="my-2">
                            <a href="{{ action('UserController@show', $video->owner_id) }}">
                                    <img class="rounded-circle float-left mx-3" src="{{ $video->owner->avatarPath }}" alt="Avatar unavailable" width="64" height="64">
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
                    @endif

                @endforeach
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="ml-5">
                <h2>Liked videos</h2>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($liked_videos as $video)
                    @if (!$video->blocked && ($video->public || (Auth::check() && (auth()->user()->isAdmin || auth()->id() == $user->id))))
                        <div class="mr-2 px-5 my-2"  style="width:436px">
                        <a href="{{ action('VideoController@show', $video->id) }}">
                           <img class="my-1" src="{{ $video->thumbnailPath }}" alt="Thumbnail unavailable" width="426" height="240">   
                        </a>
                        <div class="my-2">
                            <a href="{{ action('UserController@show', $video->owner_id) }}">
                                    <img class="rounded-circle float-left mx-3" src="{{ $video->owner->avatarPath }}" alt="Avatar unavailable" width="64" height="64">
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
                    @endif

                @endforeach
            </div>
        </div>
    </div>
    
    
    <div class="col-2">
        <div class="ml-5 mb-3">
            <h2>Subscriptions</h2>
        </div>
        
        <div>
            @foreach ($subscriptions as $author)
            <div class="my-2 container" style="height: 80px">
                    <a href="{{ action('UserController@show', $author->id) }}">
                            <img class="rounded-circle float-left mr-3" src="{{ $author->avatarPath }}" alt="Avatar unavailable" width="64" height="64">
                    </a>
                    <div class="pt-2">
                        <a href="{{ action('UserController@show', $author->id) }}">
                            <h2 class="text-truncate">{{ $author->name }} </h2>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection