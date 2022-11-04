<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$topic_id,$pid=0)
    {
        $pid = $request->pid ?: 0;
        $user = Auth::user();
        // dd($topic_id,$pid,$user->id,$request->content);
        Comment::create([
            'content' => htmlspecialchars($request->content),
            'topic_id' => $topic_id,
            'user_id' => $user->id,
            'pid' => $pid,
        ]);

        // 添加闪存，并重定向到 topic 页面
        session()->flash('success','评论成功');
        return Redirect::route('topic.show',$topic_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($topic_id,$comment_id)
    {

        $comment = Comment::find($comment_id);
        return view('comment.comment_show',['comment'=>$comment,'topic_id'=>$topic_id,'topic'=>$comment->topic]);
    }

}
