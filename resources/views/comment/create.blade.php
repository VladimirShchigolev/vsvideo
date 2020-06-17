<div class="col-8 my-3">
    @auth
    <div class="card">
        <h4 class="list-group-item m-0">Write a comment</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger mb-0">
                
                @if ($errors->has('text'))
                    <strong>{{ $errors->first('text') }}</strong><br>
                @endif
                
            </div>
        @endif
        
        <form action="{{ action('CommentController@store') }}" method="post">
            @csrf
            <div class="card-body">
                
                <div class="m-2">
                    <textarea class="form-control" id="text" name="text" rows="2" placeholder="Write your comment here!" required></textarea>
                </div>
                <input type="hidden" value="{{ $video_id }}" name="video_id">
                
                <input class="btn btn-primary mx-2" type="submit" value="Leave a comment" name="submit">
            </div>
        </form>
    </div>
    @else
    <h5>Log in to leave a comment</h5>
    @endauth
</div>