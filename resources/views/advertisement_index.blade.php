@extends('backend_master')

@section("module-helper-right")
    <a class="btn btn-primary glyphicon glyphicon-plus" href="{{ action("$controller@getCreate")}}">{{ trans('title.create') }}</a>
@endsection

@section('workspace')

<div>
    {!! insert_destroy_script() !!}
    <table class="cms-table" id="cms-table">
        <thead>
            <tr>
                @foreach ($fields_show as $f)
                <th>
<?php 
    $sort_name = $f;
    if (array_key_exists($sort_name, $fields_enum))
    {
        $sort_field = $fields_enum[$sort_name]["field"];
    }else{
        $sort_field = $f;
    }
?>
                    @if ($sort == $sort_field && $sort_type == 'desc')
                        <a class="glyphicon glyphicon-sort-by-attributes-alt" href="{{ action_url("$controller@getIndex",["sort"=>$sort_field, "sort_type"=>'asc'])}}" >{{ trans("title.$f") }}</a>
                    @elseif ($sort == $sort_field && $sort_type == 'asc')
                        <a class="glyphicon glyphicon-sort-by-attributes" href="{{ action("$controller@getIndex")."?".http_build_query(["sort"=>$sort_field, "sort_type"=>'desc'])}}" >{{ trans("title.$f") }}</a>
                    @else
                        <a class="glyphicon glyphicon-sort" href="{{ action("$controller@getIndex")."?".http_build_query(["sort"=>$sort_field, "sort_type"=>'desc'])}}" >{{ trans("title.$f") }}</a>
                    @endif
                </th>
                @endforeach
                <th>图片预览</th>
                <th>{{ trans("title.operation") }}</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($models as $m)
                <tr>
                    <td>{!! $m->id !!}</td>
                    <td>{!! $m->name !!}</td>
                    <td>
<?php
    if ($m->ad_place_id == 0)
    {
        echo "中部";
    }else if ($m->ad_place_id == 1)
    {
        echo "左侧";
    }else{
        echo "右侧";
    }
?>
                    </td>
                    <td><img 
<?php
    if ($m->ad_place_id == 1 || $m->ad_place_id== 2)
    {
        echo " width='50px' ";
    }else
    {
        echo " width='320px' ";
    }
?>

 src="{!! $m->img_url !!}"></td>
                    <td>
                        <a class='btn btn-primary glyphicon glyphicon-edit' href='{!! action_url("getEdit", ['id'=>$m->id]) !!}'>编辑</a>
                        <a class="btn btn-danger glyphicon glyphicon-trash" onclick="destroy('{{ $m->id}}');">删除</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <div class="cms-paginate">
        @if (count($models) != 0)
        <span class="cms-paginate-total" >总记录数:{{ $models->total() }} </span>
        <span class="cms-paginate-current" >当前页记录数:{{ $models->count() }} </span>
        <span class="cms-paginate-pages" >总页数:{{ $models->lastPage() }} </span>
        {!! $models->appends(['sort'=>$sort, 'sort_type'=>$sort_type, 'filter'=>isset($select_filter)?$select_filter:""])->render() !!}
        <div class="clear"></div>
        @endif
    </div>
</div>

@endsection
