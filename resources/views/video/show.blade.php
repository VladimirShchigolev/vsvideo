@extends ('layouts.app')

@section('content')
<div class="my-3">
    <h1> {{ $video->title }} </h1>
    <video width="1280" height="720" controls>
        <source src="{{ $video->path }}" type="video/mp4">
         Your browser does not support the video tag.
     </video>
    <h3>Description</h3>
    <p> {{ $video->description }} </p>
</div>

@endsection