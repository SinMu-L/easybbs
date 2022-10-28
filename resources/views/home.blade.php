@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
                    {{-- {{$topic->user}} --}}
                    <tr>
                        <th><a href="{{route('topic.show',$topic->id)}}">{{ $topic->topic }}</a></th>
                        <th><a href="{{ route('user.show',$topic->user->id) }}">{{ $topic->user->name }}</a></th>
                        <th>{{ $topic->created_at }}</th>
                        <th>{{ $topic->updated_at }}</th>
                        <th>{{ $topic->comments->count() }}</th>
                    </tr>
                </div>
            @endforeach
        </tbody>

    </table>


@endsection
