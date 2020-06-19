@extends ('layouts.app')

@section('content')
<div class="row">
    <div class="col-10">
        <div class="my-3">  
            <div class="float-right mr-5 mt-5">
                @include('subscription.operate')
            </div> 

            <div style="height: 150px">
                <img class="rounded-circle float-left mx-5" src="{{ $user->avatarPath }}" alt="{{ __('messages.Avatar_unavailable') }}" width="128" height="128">
                <h1> {{ $user->name }} </h1>
                @auth
                    @if (Auth::user()->id == $user->id || auth()->user()->isAdmin)
                        <form style="display: inline" action="{{ action('UserController@edit', $user->id) }}" method="get">
                            <button class="btn btn-primary">{{ __('messages.Edit_Profile') }}</button>
                        </form>
                        
                    @endif
                @endauth
            </div>
        </div>
        <hr>

        <div class="container-fluid">
            <div class="ml-5">
                @auth
                    @if (Auth::user()->id == $user->id)
                        <form style="display: inline" action="{{ action('VideoController@create', $user->id) }}" method="get">
                            <button class="btn btn-primary float-right">{{ __('messages.Upload_a_video') }}</button>
                        </form>
                        
                    @endif
                @endauth
                <h2>{{ $user->name }} {{ __('messages.videos') }}</h2>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($videos as $video)
                    @if (!$video->blocked && ($video->public || (Auth::check() && (auth()->user()->isAdmin || auth()->id() == $user->id))))
                        <div class="mr-2 px-5 my-2"  style="width:436px">
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
                    @endif

                @endforeach
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="ml-5">
                <h2>{{ __('messages.Liked_videos') }}</h2>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($liked_videos as $video)
                    @if (!$video->blocked && ($video->public || (Auth::check() && (auth()->user()->isAdmin || auth()->id() == $user->id))))
                        <div class="mr-2 px-5 my-2"  style="width:436px">
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
                    @endif

                @endforeach
            </div>
        </div>
    </div>
    
    
    <div class="col-2">
        <div class="ml-5 mb-3">
            <h2>{{ __('messages.Subscriptions') }}</h2>
        </div>
        
        <div>
            @foreach ($subscriptions as $author)
            <div class="my-2 container" style="height: 80px">
                    <a href="{{ action('UserController@show', $author->id) }}">
                            <img class="rounded-circle float-left mr-3" src="{{ $author->avatarPath }}" alt="{{ __('messages.Avatar_unavailable') }}" width="64" height="64">
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