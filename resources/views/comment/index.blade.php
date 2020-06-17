<div class="my-3">
    <h1 class="ml-auto">Comments</h1>
    @foreach ($comments as $comment)
        <div class="mr-auto">
            <div>
                
                <table>
                    <tr>
                        <td>
                            <a href="{{ action('UserController@show', $comment->owner_id) }}">
                                    <img class="rounded-circle float-left mx-3" src="{{ $comment->owner->avatarPath }}" alt="Avatar unavailable" width="64" height="64">
                            </a>
                        </td>
                        <td class="container pt-3">
                            <div class="float-right d-inline-block">
                            @if (Auth::user()->id == $video->owner_id || auth()->user()->isAdmin)
                                <a href = "{{ action('CommentController@edit', $comment->id) }}">
                                    <button class="btn btn-primary mb-1 float-right">Edit the comment</button>
                                </a>
                            <br>
                                <a href = "{{ action('CommentController@delete', $comment->id) }}">
                                    <button class="btn btn-primary mt-1 float-right">Delete the comment</button>
                                </a>
                            @endif
                            </div>
                            <div class="wrapper">
                                <a href="{{ action('UserController@show', $comment->owner_id) }}">
                                   <h5 class="d-inline"> {{ $comment->owner->name }} </h5>
                                </a>

                                <p class="text-break"> {{ $comment->text }} </p>

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            
        </div>
    <hr>
    @endforeach
</div>
