@extends('master')

@section('reference')
<style type="text/css">

.a-title{
    font-size:2em;
    color:#284259;
}

.a-desc{
    color:#666;

}

.a-htmlcontent{
    background-color:white;
}

</style>
@endsection

@section('main-content')
<div class="a-title">
    <span>{!! $article->title !!}</span>
</div>
<div class="a-desc">
    <span>{!! $article->created_at !!} | 浏览:{!! $article->read + 1 !!} </span>
</div>
<div class="a-htmlcontent">
    {!! $article->content!!}
</div>
@endsection
