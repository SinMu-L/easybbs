

@extends('layouts.app')

@section('breadcrumbs')
    @include('breadcrumbs')
@endsection

@section('content')


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
        </tbody>
    </table>
    <p><input type="submit" value="创建话题"></p>
</form>
@endsection
