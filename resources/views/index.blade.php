@extends('master')

@section('reference')
<style type="text/css">
.articles ul{
    list-style:none;
    padding:left:20px;
    text-align:left;
}

.articles li{
    margin-top:5px;
    /*background-color:#f8f8f8;*/
    border-bottom:solid 1px #c9cac9; 
}

.articles a{
    font-size:2em;
    color:#0273C6;
}

</style>

@endsection

@section('main-content')
<div class="articles">
    <ul>
    @foreach ($articles as $a)
        <li><a href="{{ action_url("IndexController@getArticle", ['id'=>$a->id]) }}" >{{$a->title}}</a></li>
    @endforeach
    </ul>
</div>
<div class="cms-paginate">
    {!! $articles->render() !!}
    <div class="clear"></div>
</div>

@endsection
