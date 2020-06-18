@extends ('layouts.app')

@section('content')
<div class="col-sm-8 my-3">
    <div class="card">
        <h4 class="list-group-item mb-0">{{ __('messages.Upload_a_video') }}</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger mb-0">
                @if ($errors->has('title'))
                    <strong>{{ $errors->first('title') }}</strong><br>
                @endif 
                @if ($errors->has('video'))
                    <strong>{{ $errors->first('video') }}</strong><br>
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
            </div>
        @endif
        
        <form action="{{ action('VideoController@store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="m-2">
                    <label for="title">{{ __('messages.Video_title') }}:</label>
                    <input class="form-control" type="text" id="title" name="title" required>
                </div>
                <div class="m-2">
                    <label for="video">{{ __('messages.Select_the_video_to_upload') }}:</label>
                    <input class="form-control-file" type="file" name="video" id="video" required>
                </div>
                <div class="m-2">
                    <label for="thumbnail">{{ __('messages.Select_the_thumbnail_to_upload') }}:</label>
                    <input class="form-control-file" type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="m-2">
                    <label for="description">{{ __('messages.Video_description') }}:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='public'>
                    <input class="form-check-input" type='checkbox' value='1' id="public" name='public'>
                    <label class="form-check-label" for="public">{{ __('messages.Open_for_public') }}</label>
                </div>
                
                <input class="btn btn-primary col-sm" type="submit" value="{{ __('messages.Upload') }}" name="submit">
            </div>
        </form>
    </div>
</div>
@endsection