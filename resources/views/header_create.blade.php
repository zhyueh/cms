@extends('backend_master')

@section('workspace')
<div class="cms-edit-table">
    <form method="POST" enctype="multipart/form-data" action="{{action("$controller@postStore")}}">
        {!! csrf_field() !!}
        @if ($action != 'getCreate' && $action != 'postCreate')
        <div class="form-group">
            <label for "id">{{title("id")}}</label>
            <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
        </div>
        @endif

        {!! v_form_group($model, 'name') !!} 
        {!! v_form_group($model, 'header_type_id', 'dropdownlist',
 ['dict'=>[
        "0"=>'文字',
        "1"=>'图片'
    ]]) !!} 
        {!! v_form_group($model, 'title') !!} 
        {!! v_form_group($model, 'image', 'uploadpic') !!} 
        {!! v_form_group($model, 'target_url') !!} 
        {!! v_form_group($model, 'display_order') !!} 

        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
    </form>

</div>

@endsection
