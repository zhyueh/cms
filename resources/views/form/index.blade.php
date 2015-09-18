@extends('backend_master')

@section("module-helper-right")
    <a class="btn btn-primary glyphicon glyphicon-plus" href="{{ action("$controller@getCreate")}}">{{ trans('title.create') }}</a>
@endsection

@section('workspace')

@include('base.table')

@endsection
