@extends('layouts.app')

@section('style')
    <style>
        .comment{
            margin-top: 10px;
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 1px dotted;
        }
        body {
            font-family: sans-serif;
            background-color: #f2f2e2;
            margin: 0 0 30px;
        }
        main {
            width: 80%;
            margin: auto;
        }
    </style>
@endsection


    @section('content')

    <h1>{{ $topic->topic }}</h1>

    @include('session_flash')


    <div><a href="{{ route('user.show',$topic->user->id) }}">{{$topic->user->name}}</a> - {{$topic->user->created_at}}</div>

    <div class="comment">
        <form action="{{ route('add_comment',$topic->id) }}" method="post">
            @csrf
            <textarea name="content" ></textarea>
            <br>
            <button type="submit">提交</button>
        </form>
    </div>

    <div>所有的评论</div>
    <hr>

    @foreach ($comments as $comment)
    <div class="comment"
                style="margin-left: {{ $comment->depth * 20 }}px">
                <div>
                    <a href="{{ route('user.show',$comment->user->id) }}">{{$comment->user->name}}</a> - {{$comment->created_at}}
                    <br>

                        {!! $comment->content !!}
                    <br>
                    <a href="{{ route('add_comment',['topic_id'=>$topic->id,'comment_id'=>$comment->id]) }}">
                        <small>回复</small>
                    </a>

                </div>
            </div>
    @endforeach

@endsection
