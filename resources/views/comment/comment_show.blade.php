{{-- 这里展示的是回复评论的表单 --}}


@extends('layouts.app')

@section('breadcrumbs')
    @include('breadcrumbs')
@endsection

@section('content')
    <h1>回复评论</h1>

    <p><a href="{{ route('user.show',$comment->user->id) }}">{{ $comment->user->name }}</a> - {{$comment->created_at->diffForHumans()}}</p>

    <div>{{$comment->content}}</div>

    <form action="{{ route('add_comment',['topic_id'=>$topic_id]) }}" method="post">

        @csrf
        <textarea name="content" ></textarea>
        <input name="pid" type="text" value="{{ $comment->id }}" hidden>
        <br>
        <button type="submit">提交</button>

    </form>
@endsection
