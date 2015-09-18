@extends('base')

@section('reference_before_body')

<style type="text/css">
body{
    background-color:#036;
    text-align:center;
    width:100%;
    padding-top:200px;
}

.login-form{
    background-color:#fff;
    margin:auto;
    width:400px;
    text-align:left;
    padding:20 20 20 20;
}
</style>

@endsection

@section('body')
<div class="login-form">
    <form action="/auth/login" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email">{{title('email')}}</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="user@email.com">
        </div>
    
        <div class="form-group">
            <label for="password">{{title('password')}}</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
    
        <div class="checkbox">
            <label>
            <input type="checkbox" name="remember">{{title('remember')}}
            </label>
        </div>
    
        <div>
            <button class="btn btn-default" type="submit">{{title('login')}}</button>
            <a class="btn btn-default" href="{{ base_url('auth/register') }}" role="button">{{title('register')}}</a>
        </div>
    </form>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection
