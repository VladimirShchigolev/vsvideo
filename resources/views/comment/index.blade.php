<div class="my-3">
    <h1 class="ml-auto">{{ __('messages.Comments') }}</h1>
    @foreach ($comments as $comment)
        <div class="mr-auto">
            <div>
                
                <table>
                    <tr>
                        <td>
                            <a href="{{ action('UserController@show', $comment->owner_id) }}">
                                    <img class="rounded-circle float-left mx-3" src="{{ $comment->owner->avatarPath }}" alt="{{ __('messages.Avatar_unavailable') }}" width="64" height="64">
                            </a>
                        </td>
                        <td class="container pt-3">
                            <div class="float-right d-inline-block">
                            @auth
                            @if (Auth::user()->id == $comment->owner_id || Auth::user()->id == $video->owner_id || auth()->user()->isAdmin)
                                @if (Auth::user()->id == $comment->owner_id || auth()->user()->isAdmin)
                                <form style="display: inline" action="{{ action('CommentController@edit', $comment->id) }}" method="get">
                                    <button class="btn btn-primary mb-1 float-right">{{ __('messages.Edit_the_comment') }}</button>
                                </form>
                                
                                @endif
                            <br>
                                <form style="display: inline" action="{{ action('CommentController@delete', $comment->id) }}" method="get">
                                    <button class="btn btn-primary mt-1 float-right">{{ __('messages.Delete_the_comment') }}</button>
                                </form>
                                
                            @endif
                            @endauth
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
