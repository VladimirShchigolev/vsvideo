@auth
<script type="application/javascript">
$(document).ready(function () {
    $(".container").off('click', '#like.btn-primary').on('click', '#like.btn-primary', function (e) {
        var url = "{{ action('LikeController@store') }}";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { owner_id: {{ auth()->id() }}, video_id: {{ $video_id }}, _token: CSRF_TOKEN },
            success: function (data) {
                $("#like.btn-primary").text("{{ __('messages.Dislike') }}");
                $("#like.btn-primary").toggleClass("btn-primary btn-secondary"); 
                like_count = Number($("#like_count").text());
                $("#like_count").text((like_count+1).toString(10));
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    })
    $(".container").off('click', '#like.btn-secondary').on('click', '#like.btn-secondary', function (e) {
        var url = "{{ action('LikeController@destroy') }}";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: { owner_id: {{ auth()->id() }}, video_id: {{ $video_id }}, _token: CSRF_TOKEN },
            success: function (data) {
                $("#like.btn-secondary").text("{{ __('messages.Like') }}");
                $("#like.btn-secondary").toggleClass("btn-primary btn-secondary"); 
                like_count = Number($("#like_count").text());
                $("#like_count").text((like_count-1).toString(10));
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    })
});
</script>
@endauth

<div class="container">
    <div class="d-inline-block my-1 mr-2">
        <h4 class="d-inline-block align-top">{{ __('messages.Likes') }}:</h4> 
        <h4 class="d-inline-block align-top" id="like_count">{{ $like_count }}</h4>
    </div>
    
    @auth
        @if (App\Like::where('owner_id', auth()->id())->where('video_id', $video_id)->exists())
            <button id="like" class='btn btn-secondary d-inline-block'>{{ __('messages.Dislike') }}</button>
        @else
            <button id="like" class='btn btn-primary d-inline-block'>{{ __('messages.Like') }}</button>
        @endif
    @endauth
</div>