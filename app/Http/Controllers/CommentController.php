<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function abort;
use function auth;
use function redirect;
use function view;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function __construct()
    {
        $this->middleware('admin')->only(['index', 'create']);
        $this->middleware('notBlockedUser');
    }
    
    public function index($id)
    {
        $comments = Comment::where('video', $id);
        return view('comment.index', [compact($comments)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('comment.create', ['video_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'text' => 'required|string|min:1|max:1200',
            'video_id' => 'required|exists:App\Video,id'
        ];
        
        $this->validate($request, $rules);

        
        $data['video_id'] = intval($request->video_id);
        $data['owner_id'] = auth()->id();
        $data['text'] = $request->text;
        $data['edited'] = false;
        $data['creationDate'] = date('Y-m-d H:i:s');
        
        $comment = Comment::create($data);
        $comment->save();
        
        return redirect('/videos/'.$request->video_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $comment = Comment::findorFail($id);
        if (auth()->id() == $comment->owner_id || auth()->user()->isAdmin) {
            return view('comment.edit', ['comment'=>$comment]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'text' => 'required|string|min:1|max:1200',
        ];
        
        $this->validate($request, $rules);
        
        $comment = Comment::find($id);
        
        if (auth()->id() == $comment->owner_id || auth()->user()->isAdmin) {
            $comment->text = $request->text;
            $comment->edited = true;
            $comment->save();

            return redirect('/videos/'.$comment->video_id);
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function delete($id)
    {
        $comment = Comment::findorFail($id);
        if (auth()->id() == $comment->owner_id || auth()->id() == $comment->video->owner_id || auth()->user()->isAdmin) {
            return view('comment.delete', ['comment'=>$comment]);
        } else {
            abort(404);
        }
    }
    
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $video_id = $comment->video_id;
        if (auth()->id() == $comment->owner_id || auth()->id() == $comment->video->owner_id || auth()->user()->isAdmin) {
            $comment->delete();
            return redirect('/videos/'.$video_id);
        } else {
            abort(404);
        }
    }
}
