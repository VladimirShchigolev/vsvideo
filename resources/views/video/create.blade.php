@extends ('layouts.app')

@section('content')
<div class="col-sm-8 my-3">
    <div class="card">
        <h4 class="list-group-item mb-0">Upload a video</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger mb-0">
                @if ($errors->has('title'))
                    <strong>{{ $errors->first('title') }}</strong><br>
                @endif 
                @if ($errors->has('video'))
                    <strong>{{ $errors->first('video') }}</strong><br>
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
                    <label for="title">Video title:</label>
                    <input class="form-control" type="text" id="title" name="title" required>
                </div>
                <div class="m-2">
                    <label for="video">Select the video to upload:</label>
                    <input class="form-control-file" type="file" name="video" id="video" required>
                </div>
                <div class="m-2">
                    <label for="description">Video description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-check m-2">
                    <input type='hidden' value='0' name='public'>
                    <input class="form-check-input" type='checkbox' value='1' id="public" name='public'>
                    <label class="form-check-label" for="public">Open for public</label>
                </div>
                
                <input class="btn btn-primary col-sm" type="submit" value="Upload" name="submit">
            </div>
        </form>
    </div>
</div>
@endsection