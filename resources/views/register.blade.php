
@extends('layouts.app')


@section('style')
    <style>
        input{
            border-top: none;
            border-left: none;
            border-right: none;
            /* border-bottom: 1px red solid; */
        }
        table {
            display: table;
            border-collapse: separate;
            box-sizing: border-box;
            text-indent: initial;
            border-spacing: 2px;
            border-color: gray;
        }
        .error{
            color: red;
        }
    </style>
@endsection

@section('breadcrumbs')

@endsection


@section('content')

    <h2>注册</h2>
    @if (isset($errors))
        <span class="error">{{$errors->first()}}</span>
    @endif

    <form action="{{route('register.store')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="name" value="{{ old('title') }}">
                </td>
            </tr>


            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td>

                    <button type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
