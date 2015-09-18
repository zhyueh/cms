<div class="cms-edit-table">
    <form method="POST" action="{{action("$controller@postStore")}}">
        {!! csrf_field() !!}
        @if ($action != 'getCreate' && $action != 'postCreate')
        <div class="form-group">
            <label for "id">{{trans("title.id")}}</label>
            <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
        </div>
        @endif

        @foreach ($fields_edit as $f)
        <div class="form-group">
            <label for="{{$f}}">{{ trans("title.$f") }}</label>
            {!! display_edit_control($model, $f, $fields_enum, $action=='getShow') !!}
        </div>
        @endforeach
        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
    </form>

</div>
