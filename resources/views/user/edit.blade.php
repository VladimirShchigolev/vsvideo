@extends ('layouts.app')

@section('content')
<div class="my-3">  
    <div style="height: 150px">
        <img class="rounded-circle float-left mx-5" src="{{ $user->avatarPath }}" alt="Avatar unavailable" width="128" height="128">
        <h1> {{ $user->name }} </h1>
        
    </div>
</div>
<hr>

<div class="col-sm-8 my-3">
    <div class="card">
        <h4 class="list-group-item mb-0">Change Profile Info</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger mb-0">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong><br>
                @endif 
                @if ($errors->has('avatar'))
                    <strong>{{ $errors->first('avatar') }}</strong><br>
                @endif 
            </div>
        @endif
        
        <form action="{{ action('UserController@update', $user->id) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="card-body">
                <div class="m-2">
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="m-2">
                    <label for="avatar">Select the thumbnail to upload:</label>
                    <input class="form-control-file" type="file" name="avatar" id="avatar">
                </div>
                @if (auth()->user()->isAdmin)
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='blocked'>
                    <input class="form-check-input" type='checkbox' value='1' id="blocked" name="blocked" @if ($user->isBlocked) checked @endif>
                    <label class="form-check-label" for="blocked">Blocked</label>
                </div>
                @endif
                
                <input class="btn btn-primary col-sm" type="submit" value="Save" name="submit">
            </div>
        </form>
    </div>
</div>
@endsection