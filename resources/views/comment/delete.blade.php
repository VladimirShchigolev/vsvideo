@extends ('layouts.app')

@section('content')
<div class="col-9 my-3">
    <h1>{{ __('messages.Deleting_comment') }} "{{ $comment->text }}"</h1>
    <form style="display: inline" action="{{ action('CommentController@destroy', $comment->id) }}" method="get">
        <button class="btn btn-danger col-sm my-1">{{ __('messages.Confirm') }}</button>
    </form>
    <form style="display: inline" action="{{ action('VideoController@show', $comment->video_id) }}" method="get">
        <button class="btn btn-secondary col-sm my-1">{{ __('messages.Cancel') }}</button>
    </form>
</div>
@endsection