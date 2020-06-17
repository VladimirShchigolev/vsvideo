@extends ('layouts.app')

@section('content')
<div class="col-sm-8 my-3">
    <form action="{{ action('VideoController@update', $video->id) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        <div class="card">
            <h4 class="list-group-item mb-0">Edit video details</h4>

            @if ($errors->any())
                <div class="alert alert-danger mb-0">
                    @if ($errors->has('title'))
                        <strong>{{ $errors->first('title') }}</strong><br>
                    @endif 
                    @if ($errors->has('thumbnail'))
                        <strong>{{ $errors->first('thumbnail') }}</strong><br>
                    @endif 
                    @if ($errors->has('description'))
                        <strong>{{ $errors->first('description') }}</strong><br>
                    @endif
                    @if ($errors->has('public'))
                        <strong>{{ $errors->first('public') }}</strong><br>
                    @endif 
                    @if ($errors->has('blocked'))
                        <strong>{{ $errors->first('blocked') }}</strong><br>
                    @endif 
                </div>
            @endif


            <div class="card-body">
                <div class="m-2">
                    <label for="title">Edit video title:</label>
                    <input class="form-control" type="text" id="title" name="title" value="{{ $video->title }}" required>
                </div>
                <div class="m-2">
                    <label for="thumbnail">Select the new thumbnail to upload:</label>
                    <input class="form-control-file" type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="m-2">
                    <label for="description">Edit video description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $video->description }}</textarea>
                </div>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='public'>
                    <input class="form-check-input" type='checkbox' value='1' id="public" name="public" @if ($video->public) checked @endif>
                    <label class="form-check-label" for="public">Open for public</label>
                </div>
                
                @if (auth()->user()->isAdmin)
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='blocked'>
                    <input class="form-check-input" type='checkbox' value='1' id="blocked" name="blocked" @if ($video->blocked) checked @endif>
                    <label class="form-check-label" for="blocked">Blocked</label>
                </div>
                @endif
            </div>   
        </div>
        <input class="btn btn-primary col-sm my-2" type="submit" value="Save Changes" name="submit">
    </form>
        <a href = "{{ action('VideoController@show', $video->id) }}">
            <button class="btn btn-secondary col-sm my-1">Cancel</button>
        </a>
    
</div>
@endsection