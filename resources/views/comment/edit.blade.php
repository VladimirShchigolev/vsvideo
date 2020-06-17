@extends ('layouts.app')

@section('content')
<div class="col-8 my-3">
    @auth
    <form action="{{ action('CommentController@update', $comment->id) }}" method="post">
    {{ method_field('PATCH') }}
    @csrf
        <div class="card">
            <h4 class="list-group-item m-0">Edit the comment</h4>

            @if ($errors->any())
                <div class="alert alert-danger mb-0">

                    @if ($errors->has('text'))
                        <strong>{{ $errors->first('text') }}</strong><br>
                    @endif

                </div>
            @endif

            <div class="card-body">
                <div class="m-2">
                    <textarea class="form-control" id="text" name="text" rows="6" placeholder="Write your comment here!" required>{{ $comment->text }}</textarea>
                </div>
            </div>
        </div>
    <input class="btn btn-primary col-sm my-1" type="submit" value="Save changes" name="submit">
    </form>
    <a href = "{{ action('VideoController@show', $comment->video_id) }}">
        <button class="btn btn-secondary col-sm my-1">Cancel</button>
    </a>
    
    @else
    <h5>Log in to leave a comment</h5>
    @endauth
</div>
@endsection