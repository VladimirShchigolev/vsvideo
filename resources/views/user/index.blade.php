@extends ('layouts.app')

@section('content')
<div class="container">
    
    
    <div class="ml-5 mb-3">
        <h2>{{ __('messages.Users') }}</h2>
    </div>

    <div>
        @foreach ($users as $user)
        <div class="my-2 container" style="height: 80px">
            <a href="{{ action('UserController@show', $user->id) }}">
                    <img class="rounded-circle float-left mr-3" src="{{ $user->avatarPath }}" alt="{{ __('messages.Avatar_unavailable') }}" width="64" height="64">
            </a>
            <div class="pt-2">
                <a href="{{ action('UserController@show', $user->id) }}">
                    <h2 class="text-truncate">{{ $user->name }} </h2>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
</div>

@endsection