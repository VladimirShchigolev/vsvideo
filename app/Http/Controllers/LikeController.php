<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function response;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
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
        $rules = [
            'owner_id' => 'required|exists:User,id',
            'video_id' => 'required|exists:Video,id'
        ];

        $this->validate($request, $rules);
        
        if (! Like::where('owner_id', intval($request->owner_id))->where('video_id', intval($request->video_id))->exists()
                && auth()->id() == $request->owner_id) {
        
            $data['video_id'] = intval($request->video_id);
            $data['owner_id'] = intval($request->owner_id);

            $like = Like::create($data);
            $like->save();

            return response()->json(['success' => 1], 200);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $rules = [
            'owner_id' => 'required|exists:User,id',
            'video_id' => 'required|exists:Video,id'
        ];

        $this->validate($request, $rules);
        
        if (auth()->id() == $request->owner_id) {
            Like::where('owner_id', intval($request->owner_id))->where('video_id', intval($request->video_id))->delete();

            return response()->json(['success' => 1], 200);
        }
        
    }
}
