<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function auth;
use function ddd;
use function view;

class VideoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $videos = Video::where('public', true)->orderBy('uploadDate', 'desc')->get();
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
            'title' => 'required|min:3|max:200',
            'video' => 'required|mimes:mp4',
            'description' => 'max:1200',
            'public' => 'required',
        ];
        
        $this->validate($request, $rules);
                 
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['public'] = boolval($request['public']);
        $data['blocked'] = false;
        $data['uploadDate'] = date('Y-m-d H:i:s');
        $data['owner'] = auth()->id();
        $data['path'] = '';
       
        $video = Video::create($data);
        $video->save();
        
        $id = $video->id;
        $video = Video::find($id);
        
        $file = $request->file('video');
        $file->move('uploads', $id.'.mp4');
        $video->path = 'uploads/'.$id.'.mp4';
        $video->save();
        return view('video.show', ['video'=>$video]);
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
        //dd($video);
        return view('video.show', ['video'=>$video]);
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
    public function destroy($id)
    {
        //
    }
}
