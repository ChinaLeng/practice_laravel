@extends('index.layouts.default')
@section('title','注册')
@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">
            <div class="card-header">
                <h5>注册</h5>
            </div>
            <div class="card-body">
                @include('index.shared._errors')
                <form method="POST" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>
{{--                    <div>
                        <button type="submit" class="btn btn-primary">注册</button>
                        <span class="text-muted font-weight-light" style="font-size: 0.8rem;vertical-align: bottom;">已有账号?<a href="" class="text-muted" style="vertical-align: bottom;">直接登录</a></span>
                    </div>--}}
                    <button type="submit" class="btn btn-primary">注册</button>
                    <hr>
                    <p>已有账号？<a href="{{ route('login') }}">直接登录！</a></p>
                </form>
            </div>
        </div>
    </div>
@stop