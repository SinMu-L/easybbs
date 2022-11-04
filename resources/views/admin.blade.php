
@extends('layouts.app')


@section('style')
    <style>
        table{

        }
        h2{
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
@endsection



@section('content')

    <h1>管理面板</h1>
    <div class="nav my-4">
        <label for="">
            <a href="">管理面板</a> | <a href="{{ route('/') }}">首页</a>
        </label>
    </div>

    <h2>SQL查询</h2>
    <div class="sql-search">
        <div class="waring"> !!! 请确保您已经知道执行 SQL 查询的后果 !!!</div>
        <div class="sql-input">
            <form action="" method="post">
                @csrf
                SQL: <input type="text" name="sql">
                <button type="submit">提交</button>
            </form>
        </div>

    </div>

    <h2>网站配置</h2>
    <div class="setting">
        <form action="" method="post">
            @csrf
            <table border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <th>网站名称</th>
                    <th>
                        <input type="text" name="app_name">
                    </th>
                </tr>
                <tr>
                    <th>网站描述</th>
                    <th>
                        <input type="text" name="app_desc">
                    </th>
                </tr>
                <tr>
                    <th>是否允许注册</th>
                    <th>
                        2个单选
                    </th>
                </tr>
            </table>
            <button type="submit">更新</button>
        </form>
    </div>


    <h2>论坛管理</h2>
    <h3>添加论坛</h3>
    <h2>用户</h2>
    <h3>添加用户</h3>
@endsection
