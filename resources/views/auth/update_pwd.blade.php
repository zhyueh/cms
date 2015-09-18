@extends('backend_master')

@section('workspace')
<div class="cms-edit-table">
    <form action="{{action_url('postUpdatePwd')}}" method="POST">
        {!! csrf_field()!!}
        <div class="form-group">
            <label for='password'>{{trans('title.password')}}</label>
            <input type="password" name="password" class="form-control"></input>
        </div>
        <div class="form-group">
            <label for='password_confirmation'>{{trans('title.password_confirm')}}</label>
            <input type="password" name="password_confirmation" class="form-control"></input>
        </div>
        <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
    </form>

</div>

@endsection
