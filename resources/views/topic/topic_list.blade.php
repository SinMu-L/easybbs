
@extends('layouts.app')


@section('style')
    <style>
        table {
            display: table;
            border-collapse: separate;
            box-sizing: border-box;
            text-indent: initial;
            border-spacing: 2px;
            border-color: gray;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
         tr:not(:last-child) {
            border-bottom: 1px solid;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
@endsection

@section('breadcrumbs')
    @include('breadcrumbs')
@endsection


@section('content')

    <h2>{{ $forum->forum_name }}</h2>

    @if (Auth::check())

    <p><a href="{{ route('topic.create',$forum->id) }}">创建话题</a></p>

    @else
    先登陆，后新建话题

    @endif

    <table >
    <tbody>
        <tr>
            <th>话题</th>
            <th>作者</th>
            <th>创建于</th>
            <th>最近更新</th>
            <th>评论</th>
        </tr>
        @foreach ($topics as $topic)

                <tr>
                    <th><a href="{{ route('topic.show',$topic->id) }}">{{ $topic->title }}</a></th>
                    <th><a href="{{ route('user.show',$topic->user->id) }}">{{ $topic->user->name }}</a></th>
                    <th>{{ $topic->created_at->diffForHumans() }}</th>
                    <th>{{ $topic->updated_at->diffForHumans() }}</th>
                    <th>{{ $topic->comments->count() }}</th>
                </tr>


        @endforeach
    </tbody>

    </table>


@endsection
