@extends ('layouts.app')

@section('content')
<div class="col-9 my-3">
    <h1>{{ __('messages.Deleting') }} "{{ $video->title }}"</h1>
    <form style="display: inline" action="{{ action('VideoController@destroy', $video->id) }}" method="get">
        <button class="btn btn-danger col-sm my-1">{{ __('messages.Confirm') }}</button>
    </form>
    
    <form style="display: inline" action="{{ action('VideoController@show', $video->id) }}" method="get">
        <button class="btn btn-secondary col-sm my-1">{{ __('messages.Cancel') }}</button>
    </form>
    
</div>
@endsection