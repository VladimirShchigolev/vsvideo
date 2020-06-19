<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Subscription;
use App\User;
use App\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function abort;
use function auth;
use function redirect;
use function view;

class VideoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
        $this->middleware('notBlockedUser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (! auth()->check()) {
            $videos = Video::where('public', true)->orderBy('uploadDate', 'desc')->get();
        }
        else if (auth()->check()) {
            if (auth()->user()->personalisation == 0) {
                $query = Video::orderBy('uploadDate', 'desc');
                if (! auth()->user()->isAdmin) {
                    $videos = $query->where('public', true);
                }
                $videos = $query->get();
            }
            else {
                $query = Video::leftJoin(\DB::raw('(Select * From subscriptions where subscriber_id ='.auth()->id().') S'), 'S.author_id', '=', 'videos.owner_id');
                //dd($query->get());
                if (! auth()->user()->isAdmin) {
                    $query = $query->where('public', true);
                }
                $videos = $query->orderBy(\DB::raw('ISNULL(S.author_id), S.author_id'), 'ASC')
                        ->orderBy('uploadDate', 'desc')->groupBy('videos.id')->get(['videos.*']);
              
                //dd($videos);
            }
        }
        //dd($videos);
        return view('video.index', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('video.create');
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
            'title' => 'required|string|min:3|max:200',
            'video' => 'required|mimes:mp4',
            'thumbnail' => 'image|mimes:jpeg,png,jpg',
            'description' => 'nullable|string|max:1200',
            'public' => 'required|integer|min:0|max:1'
        ];
        
        $this->validate($request, $rules);

        
        $data['title'] = $request->title;
        if ($request->has('description') && !empty($request->description)) {
            $data['description'] = $request->description;
        } else {
            $data['description'] = "";
        }
        $data['public'] = boolval($request['public']);
        $data['uploadDate'] = date('Y-m-d H:i:s');
        $data['owner_id'] = auth()->id();
        $data['path'] = '';
        $data['thumbnailPath'] = '/uploads/thumbnails/0.jpg';
       
        $video = Video::create($data);
        $video->save();
        
        $file = $request->file('video');
        $file->move('uploads/videos/', $video->id.'.mp4');
        $video->path = '/uploads/videos/'.$video->id.'.mp4';
        
        if ($request->exists('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail->move('uploads/thumbnails/', $video->id.'.'.$thumbnail->getClientOriginalExtension());
            $video->thumbnailPath = '/uploads/thumbnails/'.$video->id.'.'.$thumbnail->getClientOriginalExtension();
        }
        
        $video->save();
        return redirect('/videos/'.$video->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $video = Video::findorFail($id);
        $user = User::findOrFail($video->owner_id);
        $like_count = Like::where('video_id', $id)->count();
        $subscription_count = Subscription::where('author_id', $user->id)->count();
        return view('video.show', ['video'=>$video, 'comments'=>$video->comments, 'user'=>$user, 'video_id'=>$video->id, 'like_count'=>$like_count, 'subscription_count'=>$subscription_count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $video = Video::findorFail($id);
        if (auth()->id() == $video->owner_id || auth()->user()->isAdmin) {
            return view('video.edit', ['video'=>$video]);
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
            'title' => 'required|string|min:3|max:200',
            'thumbnail' => 'image|mimes:jpeg,png,jpg',
            'description' => 'nullable|string|max:1200',
            'public' => 'required|integer|min:0|max:1',
            'blocked' => 'integer|min:0|max:1'
        ];
        
        $this->validate($request, $rules);

        if ($request->has('description') && !empty($request->description)) {
            $description = $request->description;
        } else {
            $description = "";
        }
        
        $video = Video::find($id);
        
        if (auth()->id() == $video->owner_id || auth()->user()->isAdmin) {
        
            $video->title = $request->title;
            $video->description = $description;
            $video->public = boolval($request['public']);
            
            if ($request->has('blocked')) {
                $video->blocked = boolval($request['blocked']);
            }

            if ($request->exists('thumbnail')) {
                $old_thumbnail = substr($video->thumbnailPath, 1);
                if ($old_thumbnail != 'uploads/thumbnails/0.jpg') {
                    File::delete($old_thumbnail);
                }
                
                $thumbnail = $request->file('thumbnail');
                $thumbnail->move('uploads/thumbnails/', $id.'.'.$thumbnail->getClientOriginalExtension());
                $video->thumbnailPath = '/uploads/thumbnails/'.$id.'.'.$thumbnail->getClientOriginalExtension();
            }
            $video->save();
            return redirect('/videos/'.$video->id);
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
        $video = Video::findorFail($id);
        if (auth()->id() == $video->owner_id || auth()->user()->isAdmin) {
            return view('video.delete', ['video'=>$video]);
        } else {
            abort(404);
        }
    }
    
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        if (auth()->id() == $video->owner_id || auth()->user()->isAdmin) {
            Comment::where('video_id', $id)->delete();
            $video->delete();
            return redirect('/users/'.auth()->id());
        } else {
            abort(404);
        }
    }
    
    
    public function search(Request $request)
    {
        $rules = [
            'search' => 'required|string|max:1200'
        ];
        
        $this->validate($request, $rules);

        $query = Video::join('users', 'users.id', '=', 'videos.owner_id')
                ->where('users.name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('videos.title', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('videos.description', 'LIKE', '%'.$request->get('search').'%');
        
        if (auth()->check() && auth()->user()->isAdmin) {
            $videos = $query->orderBy('uploadDate', 'desc')->get(['videos.*']);
        } else {
            $videos = $query->where('public', true)->orderBy('uploadDate', 'desc')->get(['videos.*']);
        }
        //dd($videos);
        return view('video.index', ['videos' => $videos]);
    }
}
