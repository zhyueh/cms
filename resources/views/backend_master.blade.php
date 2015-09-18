@extends('base')

@section('reference_after_body')
<script type="text/javascript">
    function showAlert(id, type){
        var trimValue = $("#" + id).html().trim();
        if (trimValue != ''){
            $("#" + id).show(); 
            $("#" + id).addClass("alert").addClass("alert-" + type);
            console.log(trimValue);
        }
    }
    showAlert("cms-notification", "info");
    showAlert("cms-warning", "danger");
    $(".cms-table>tbody>tr:odd").css("background-color", "#f9f9f9"); 
    $(".cms-table>tbody>tr:even").css("background-color", "#fff"); 
    var options = {
        animation: true,
        trigger: 'hover'
    }
    $(".cms-button-tool-tips").tooltip(options);
</script>

@endsection


@section('body')
<div class="cms-header">
    <div class="cms-header-top">
        <div class="website-name">cms</div>
        <div class="person">
            <div class="dropdown">
                <a class="dropdown-toggle cms-user" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <div class="glyphicon glyphicon-user">
                    <span class="user_name">{{ $login_user->name}}<span>
</div>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{action_url('Auth\PasswordController@getUpdatePwd')}}">修改密码</a></li>
                    <li class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo action('Auth\AuthController@getLogout'); ?>">退出</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="cms-module-nav">
        <ul class="nav nav-tabs">
<?php
$navs = [
    '文章'=>'ArticleController@getIndex',
    '公告'=>'BulletinController@getEdit',
    '文件上传'=>'',
    '广告位'=>'AdvertisementController@getIndex',
    '快捷入口'=>'EntranceController@getIndex',
    '头部标签'=>'HeaderController@getIndex',
];
$ct = get_current_route();

foreach($navs as $k=>$v)
{
    $selected = "";
    if ($ct == $v)
    {
        $selected = " class='active' ";
    }
    $url = "";
    if($v)
    {
        $url = action_url($v);
    }
    
    echo "<li $selected><a href='$url'>$k</a></li>";
}

?>
        </ul>
    </div>
</div>
<div class="cms-body">
    <div class="cms-body-content">
        <div id="cms-notification" class="cms-notification" role="alert">
            @yield('notification')
        </div>
        <div id="cms-warning" class="cms-warning" role="alert">
            @yield('warning')
            @if (count($errors) > 0)
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            @endif
        </div>
        @if (isset($success) )
        <div class="alert alert-success">
            <ul>
            <li>{{ $success}}</li>
            </ul>
        </div>
        @endif
        <div class="cms-module-helper">
            <div class="cms-module-helper-left">
                @section('module-helper-left')
                @show()
            </div>
            <div class="cms-module-helper-right">
                @section('module-helper-right')
                @show()
            </div>
            <div class="clear"></div>
        </div>
        <div class="cms-workspace">
            @section('workspace')
            workspace
            @show()
        </div>
    </div>
</div>
<div class="cms-power">
</div>
@endsection
