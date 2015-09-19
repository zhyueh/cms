<html>
<title>
@section('title')
{{title('website_name')}}
@show()
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="{{ base_url("asset/css/index.css") }}">
<link rel="stylesheet" href="{{ base_url("bootstrap-3.3.4-dist/css/bootstrap.css") }}">
<link rel="stylesheet" href="{{ base_url("bootstrap-3.3.4-dist/css/bootstrap-theme.min.css") }}">
<script src="{{ base_url("jquery/jquery.min.js") }}"></script>
<script src="{{ base_url("bootstrap-3.3.4-dist/js/bootstrap.min.js") }}"></script>
@yield('reference')
<body>
    <div class="cms-body">
        <div class="cms-header">
            <ul>
                @foreach ($headers as $header)
                <li><a href="{{$header->target_url}}">{{ $header->title }}</a></li>
                @endforeach
                <div class="clear"></div>
            </ul>
        </div>
        <div class="cms-banner">
            @foreach ($banners as $banner)
                <a href="{{ $banner->target_url }}" alt="banner"><img width="980px" src="{!! $banner->img_url !!}"></img></a>
            @endforeach
        </div>
        <div class="main">
            <div class="left-content">
                <div class="bulletin">
                    <div class="title"><span>公告栏</span></div>
                    <div><span>{{ $bulletin->data }}</span></div>
                </div>
                <div class="entrance">
                    <div class="title"><span>快速通道</span></div>
                    <ul>
                    @foreach ($entrances as $entrance)
                        <li><a href="{!! $entrance->target_url !!}">{{ $entrance->title }}</a></li>
                    @endforeach
                    </ul>
                </div>
                <div class="service">
                    <div class="title">
                        <span>在线客服</span>
                    </div>
                    <div class="service_content">
                        <ul>
                            <li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=47863540&site=qq&menu=yes"><img border="0" src="{{ base_url("asset/img/kfqq.png") }}" alt="有事点这里" /></a></li>
                            <li><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=d4865364b236455053dddfd63b8cf29d146cd52ded760cfb77662d721da785e2" ><img border="0" src="{{ base_url("asset/img/group.png")}}" /img></a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="main-content">
                @yield('main-content')
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div>
        <a href="{{ action_url("Auth\AuthController@getLogin") }}">后台入口</a>
    </div>
</body>
