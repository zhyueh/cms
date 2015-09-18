<?php

function base_url($path, $host=null)
{
    if (!$host)
    {
        $host = $_SERVER['SERVER_NAME'];
    }
    return "http://$host/$path";
}

function title($name)
{
    return trans('title.'.$name);
}

function get_current_route()
{
    $route = Route::currentRouteAction();
    return str_replace('App\\Http\\Controllers\\', '', $route);
}

function get_current_controller()
{
    return explode('@', get_current_route())[0];
}

function get_current_action()
{
    return explode('@', get_current_route())[1];
}

function gen_action($action)
{
    return get_current_controller()."@".$action;
}

function input_contain_empty($k)
{
    return Input::get($k, "1") == "";
}

function action_url($action, $params=[])
{
    if(!strstr($action, '@'))
    {
        $action = gen_action($action);
    }
    $url = action($action);
    if (count($params) > 0)
    {
        $url = $url."?".http_build_query($params);
    }
    return $url;
}
function array_get_default($array, $k, $default=null)
{
    if(array_key_exists($k, $array))
    {
        return $array[$k];
    }
    return $default;
}

function guid()
{
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12);
    return $uuid;
}
