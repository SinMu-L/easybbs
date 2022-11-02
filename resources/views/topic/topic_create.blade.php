

@extends('layouts.app')

@section('style')
    <style>
        .error{
            color: red;
        }
    </style>
@endsection

@section('breadcrumbs')
    @include('breadcrumbs')
@endsection

@section('content')

@if (isset($errors))
    <span class="error">{{$errors->first()}}</span>
@endif
<form action="{{route('topic.store')}}" method="post">
    @csrf
    <table class="form">
        <tbody>
        <tr>
            <td><label for="title">标题</label></td>
            <td>
                <input type="text" id="title" name="title" value="">
            </td>
        </tr>
        <tr>
            <td><label for="content">内容</label></td>
            <td>
                <textarea id="content" name="content"></textarea>
            </td>
        </tr>
        <input type="text" hidden name="forum_id" value="{{ $forum->id }}">
        </tbody>
    </table>
    <p><input type="submit" value="创建话题"></p>
</form>
@endsection
