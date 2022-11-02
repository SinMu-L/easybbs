
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


@section('content')

    @include('session_flash')
    <table>
        <tr>
            <th>论坛</th>
            <th>最新话题</th>
        </tr>
        @foreach ($forums as $forum)
            @php
                $topic = $forum->topics()->latest()->first()
            @endphp
            <tr>
                <th>
                    <div class="forum_info">
                        <p><a href="{{ route('forum.show',$forum->id) }}">{{ $forum->forum_name }}</a></p>

                    </div>

                </th>
                <th>
                    <p><a href="{{ route('topic.show',$topic->id) }}">{{ $topic->title }}</a></p>
                    <p>{{ $topic->created_at->diffForHumans()}} </p>
                </th>
            </tr>
        @endforeach
    </table>

@endsection
