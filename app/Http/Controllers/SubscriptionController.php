<?php

namespace App\Http\Controllers;

use App\Like;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function auth;
use function response;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('notBlockedUser');
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
            'subscriber_id' => 'required|exists:App\User,id',
            'author_id' => 'required|exists:App\User,id'
        ];

        $this->validate($request, $rules);
        
        if (! Subscription::where('subscriber_id', auth()->id())->where('author_id', $request->author_id)->exists() &&
                auth()->id() != $request->author_id) {
        
            $data['subscriber_id'] = intval($request->subscriber_id);
            $data['author_id'] = intval($request->author_id);

            $subscription = Subscription::create($data);
            $subscription->save();

            return response()->json(['success' => 1], 200);
        } else {
            return response()->json(['success' => 0], 200);
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
            'subscriber_id' => 'required|exists:App\User,id',
            'author_id' => 'required|exists:App\User,id'
        ];

        $this->validate($request, $rules);
        
        if (auth()->id() != $request->author_id) {
            Subscription::where('subscriber_id', auth()->id())->where('author_id', $request->author_id)->delete();
        }
        
        return response()->json(['success' => 1], 200);
    }
}
