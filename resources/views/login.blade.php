
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
        .danger{
            color: red;
        }
    </style>
@endsection

@section('breadcrumbs')

@endsection


@section('content')


    <h2>登录</h2>
    @include('session_flash')

    <form action="{{route('login.store')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>


            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password"  >
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
