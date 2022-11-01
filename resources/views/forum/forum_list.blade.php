
@extends('layouts.app')


@section('style')
    <style>

    </style>
@endsection


@section('content')


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
                <th>{{ $forum->forum_name }} | {{ $forum->description }}</th>
                <th>{{ $topic->title }} | {{ $topic->created_at }}</th>
            </tr>
        @endforeach
    </table>

@endsection
