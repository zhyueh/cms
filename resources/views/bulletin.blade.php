@extends('backend_master')

@section('workspace')
<div class="cms-edit-table">
    <form method="POST" enctype="multipart/form-data" action="{{action("$controller@postEdit")}}">
        {!! csrf_field() !!}

        {!! v_form_group($model, 'data', 'textarea') !!} 

        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
    </form>

</div>

@endsection
