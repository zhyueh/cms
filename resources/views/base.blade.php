<html>
<title>
@section('title')
{{title('website_name')}}
@show()
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="{{ base_url("bootstrap-3.3.4-dist/css/bootstrap.css") }}">
<link rel="stylesheet" href="{{ base_url("bootstrap-3.3.4-dist/css/bootstrap-theme.min.css") }}">
<link rel="stylesheet" href="{{ base_url("bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") }}">
<link rel="stylesheet" href="{{ base_url("asset/css/base.css") }}">

<script type="text/javascript" charset="utf-8" src="{{ base_url("ueditor/ueditor.config.js")}}" ></script>

<script type="text/javascript" charset="utf-8" src="{{ base_url("ueditor/ueditor.all.min.js")}}"></script>
<script type="text/javascript" charset="utf-8" src="{{ base_url("ueditor/lang/zh-cn/zh-cn.js")}}"></script>
<script src="{{ base_url("jquery/jquery.min.js") }}"></script>
<script src="{{ base_url("bootstrap-3.3.4-dist/js/bootstrap.min.js") }}"></script>
<script src="{{ base_url("bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") }}"></script>
<script src="{{ base_url("bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js") }}"></script>
<script src="{{ base_url("asset/js/imgpreview.js") }}"></script>

@yield('reference_before_body')
<body>
@section('body')
empty content
@show()


</body>
@yield('reference_after_body')
</html>
