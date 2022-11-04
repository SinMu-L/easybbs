<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 返回一个话题列表
        $topics = Topic::with('user')->paginate(5);

        return view('topic.topic_list',['topics'=>$topics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$forum_id)
    {
        // dd($forum_id);
        $validator =  Validator::make(['forum_id'=>$forum_id],[
            'forum_id' => ['required','numeric','exists:forums,id']
        ]);
        if($validator->fails()){
            return redirect(404);
        }
        $forum = Forum::where('id','=',$forum_id)->first();
        return view('topic.topic_create',[
            'forum' => $forum
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Topic $topic)
    {

        $validator = Validator::make($request->all(),[
            'title' => ['required','string','between:2,300'],
            'content' => ['required','string'],
            'forum_id' => ['required','numeric','exists:forums,id']
        ],[],[
            'title' => '标题',
            'content' => '内容',
            'forum_id' => '话题',
        ]);

        if($validator->fails()){
            session()->flash('errors',$validator->errors());
            return back();
        }

        $user = Auth::user();
        $title = htmlspecialchars($request->title);
        $content = htmlspecialchars($request->content);
        $topic->title = $title;
        $topic->content = $content;
        $topic->user_id = $user->id;
        $topic->forum_id = (int)$request->forum_id;

        $topic->save();

        session()->flash('success','话题创建成功');
        return Redirect::route('topic.show',$topic->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topic.topic_show',[
            'topic'=>$topic,
            'comments' => $topic->commentsFlatTree(),
        ]);
    }


}
