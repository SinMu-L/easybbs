@extends('layouts.app')

@section('content')

<table>
    <tbody>

            <tr>
                <th>姓名</th>
                <th>{{ $user->name }}</th>
            </tr>
            <tr>
                <th>邮箱</th>
                <th>{{ $user->email }}</th>
            </tr>
            <tr>
                <th>注册时间</th>
                <th>{{ $user->created_at }}</th>
            </tr>


    </tbody>
</table>

@endsection
