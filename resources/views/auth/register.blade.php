@extends('base')

@section('reference_before_body')
<style type="text/css">
body{
    background-color:#036;
    text-align:center;
    width:100%;
    padding-top:100px;
}

.reg-form{
    background-color:#fff;
    margin:auto;
    width:400px;
    text-align:left;
    padding:20 20 20 20;
}
</style>

@endsection

@section('body')
<div class='reg-form'>
    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}
    
        <div class="form-group">
            <label for="name">{{title('username')}}</label>
            <input class="form-control" type="name" id="name" name="name" placeholder="username">
        </div>

        <div class="form-group">
            <label for="email">{{title('email')}}</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="user@email.com">
        </div>

        <div class="form-group">
            <label for="password">{{title('password')}}</label>
            <input class="form-control" type="password" name="password"></input>
        </div>

        <div class="form-group">
            <label for="password">{{title('confirm-password')}}</label>
            <input class="form-control" type="password" name="password_confirmation"></input>
        </div>
    
        <div>
            <button class="btn btn-default" type="submit">{{title('register')}}</button>
        </div>
    </form>
</div>
@endsection
