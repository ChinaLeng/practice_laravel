@extends('index.layouts.default')
@section('title','这是一切的开始')
@section('content')
    @if(Auth::user())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('index.shared._status_form')
                </section>
                <h4>微博列表</h4>
                <hr>
                @include('index.shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('index.users.user_info', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello Laravel</h1>
            <p class="lead">你现在看到的就是主页</p>
            <p>这是一切开始的地方</p>
            <p>
                <a href="{{ route('users.signup') }}" class="btn btn-lg btn-success">开始奇迹之旅</a>
            </p>
        </div>
    @endif
@stop