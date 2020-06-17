<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function abort;
use function auth;
use function redirect;
use function view;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('BlockedUser');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $subscription_count = Subscription::where('author_id', $user->id)->count();
        $liked_videos = Video::join('likes', 'likes.video_id', '=', 'videos.id')->where('likes.owner_id', $id)->orderBy('likes.id', 'desc')->get(['videos.*']);
        $videos = Video::where('owner_id', $id)->orderBy('uploadDate', 'desc')->get();
        //dd($liked_videos);
        $subscriptions = User::join('subscriptions', 'subscriptions.author_id', '=', 'users.id')->where('subscriptions.subscriber_id', $id)->get(['users.*']);
        //dd($subscriptions);
        return view('user.show', ['user'=>$user, 'subscription_count'=>$subscription_count, 'videos'=>$videos, 'liked_videos'=>$liked_videos, 'subscriptions'=>$subscriptions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (auth()->id() == $id || auth()->user()->isAdmin) {
            $user = User::findOrFail($id);
            return view('user.edit', ['user'=>$user]);
        }
        else {
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
        if (auth()->id() == $id || auth()->user()->isAdmin) {
            $rules = [
                'name' => 'required|string|min:1|max:100',
                'avatar' => 'image|mimes:jpeg,png,jpg',
                'blocked' => 'integer|min:0|max:1'
            ];

            $this->validate($request, $rules);

            $user = User::find($id);

            $user->name = $request->name;
            if ($request->exists('avatar')) {
                $avatar = $request->file('avatar');
                $avatar->move('uploads/avatars/', $id.'.'.$avatar->getClientOriginalExtension());
                $user->avatarPath = '/uploads/avatars/'.$id.'.'.$avatar->getClientOriginalExtension();
            }
            
            if ($request->has('blocked')) {
                $user->isBlocked = boolval($request['blocked']);
            }


            $user->save();
            return redirect('/users/'.$user->id);
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
    public function destroy($id)
    {
        //
    }
}
