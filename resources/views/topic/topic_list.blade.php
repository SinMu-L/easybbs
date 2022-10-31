@extends('layouts.app')

@section('content')

    @if (Auth::check())

        <p><a href="{{ route('topic.create') }}">创建话题</a></p>

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
                <div class="topic-item">
                    <tr>
                        <th><a href="{{ route('topic.show',$topic->id) }}">{{ $topic->title }}</a></th>
                        <th><a href="{{ route('user.show',$topic->user->id) }}">{{ $topic->user->name }}</a></th>
                        <th>{{ $topic->created_at }}</th>
                        <th>{{ $topic->updated_at }}</th>
                        <th>{{ $topic->comments->count() }}</th>
                    </tr>
                </div>

            @endforeach
        </tbody>

    </table>
    <div class="mt-3">
        {{-- {!! $topics->render() !!} --}}
      </div>

@endsection
