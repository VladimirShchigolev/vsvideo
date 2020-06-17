@extends ('layouts.app')

@section('content')
<div class="col-9 my-3">
    <h1>Deleting comment "{{ $comment->text }}"</h1>
    <a href = "{{ action('CommentController@destroy', $comment->id) }}">
        <button class="btn btn-danger col-sm my-1">Confirm</button>
    </a>
    <a href = "{{ action('VideoController@show', $comment->video_id) }}">
        <button class="btn btn-secondary col-sm my-1">Cancel</button>
    </a>
</div>
@endsection