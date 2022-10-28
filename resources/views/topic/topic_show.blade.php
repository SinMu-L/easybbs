@extends('layouts.app')

@section('style')
    <style>
        .comment{
            margin-top: 10px;
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 1px dotted;
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

{{dd($comments)}}

{{-- {{$comments}} --}}
{{-- {{$i=1}} --}}
{{-- @foreach ($topic->comments as $comment)

    <div class="comment" style="margin-left:{{ 10*$i++ }}px">
        <span><a href="{{ route('user.show',$comment->user->id) }}">{{$comment->user->name}}</a> - {{$comment->created_at}}</span>
        <br>
        <span> {{$comment->content }}</span>
        <br>
        <span><a href="{{ route('add_comment',['topic_id'=>$topic->id,'comment_id'=>$comment->id]) }}">回复</a></span>
    </div>
 @endforeach --}}

@endsection
