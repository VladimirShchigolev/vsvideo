@extends ('layouts.app')

@section('content')
<div class="col-9 my-3">
    <h1>{{ __('messages.Deleting') }} "{{ $video->title }}"</h1>
    <a href = "{{ action('VideoController@destroy', $video->id) }}">
        <button class="btn btn-danger col-sm my-1">{{ __('messages.Confirm') }}</button>
    </a>
    <a href = "{{ action('VideoController@show', $video->id) }}">
        <button class="btn btn-secondary col-sm my-1">{{ __('messages.Cancel') }}</button>
    </a>
</div>
@endsection