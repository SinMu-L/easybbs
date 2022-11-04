<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::all();

        return view('forum.forum_list',['forums'=>$forums]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($forum_id)
    {

        $validaor = Validator::make(['forum_id'=>$forum_id],[
            'forum_id' => ['numeric','exists:forums,id']
        ]);

        if($validaor->fails()){
            return redirect(404);
        }

        $forum = Forum::find($forum_id)->first();
        return view('topic.topic_list',[
            'forum' => $forum,
            'topics' => $forum->topics,
        ]);
    }


}
