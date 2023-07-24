@extends('layouts.app')

@section('style')
    <style>
        .comment{
            margin-top: 10px;
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 1px dotted;
        }

        main {
            width: 80%;
            margin: auto;
        }
        p {
            margin-top: 0.7em;
            margin-bottom: 0.7em;
        }
    </style>
@endsection

@section('breadcrumbs')
    @include('breadcrumbs')
@endsection

@section('content')

    @include('session_flash')
    <h1>{{ $topic->title }}</h1>

    <div><a href="{{ route('user.show',$topic->user->id) }}">{{$topic->user->name}}</a> - {{$topic->user->created_at->diffForHumans()}}</div>

    <div class="markdown">
        {!! $topic->content !!}
    </div>

    @if (Auth::check())
        <p>
            <form action="{{ route('add_comment',$topic->id) }}" method="post">
                @csrf
                <textarea name="content" ></textarea>
                <br>
                <button type="submit">提交</button>
            </form>
        </p>
        <div class="comment">
        </div>

        <div>所有的评论</div>
        <hr>

        @foreach ($comments as $comment)
        <div class="comment"
                    style="margin-left: {{ $comment->depth * 20 }}px">
                    <div>
                        <a href="{{ route('user.show',$comment->user->id) }}">{{$comment->user->name}}</a> - {{$comment->created_at->diffForHumans()}}
                        <br>

                            {!! $comment->content !!}
                        <br>
                        <a href="{{ route('add_comment',['topic_id'=>$topic->id,'comment_id'=>$comment->id]) }}">
                            <small>回复</small>
                        </a>

                    </div>
                </div>
        @endforeach
    @else
        <p>
            <small>发表评论，请先 <a href="{{ route('register') }}">登陆</a> ！</small>
        </p>
    @endif



@endsection
