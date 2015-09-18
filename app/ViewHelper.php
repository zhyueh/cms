<?php

function v_trans($name, $file='title')
{
    if($name)
    {
        return trans("$file.$name");
    }
    return "";
}

function v_trans_array($array, $name, $default=null, $file='title')
{
    $name = array_get_default($array, $name, $default);
    if($name)
    {
        return trans("$file.$name");
    }
    return "";
}

function v_init_js_copy()
{
    $html = "
<script type='text/javascript'>
    function copyToClipBoard(id){ 
        $('#'+id).text().clone();
        alert(\"复制成功！\");     
    }
</script>" ;

    return $html;
}

function v_nav_menu($nav_menu, $nav_active_menu='')
{
    $html = "";
    foreach($nav_menu as $menu)
    {
        $html = $html."<li role='presentation' ";

        if ($menu->name == $nav_active_menu){
            $html = $html."class='active'";
        }
        $html = $html."><a href='".action($menu->action)."'>$menu->name</a></li>";
    }
    return $html;
}

function v_nav_sub_menu($nav_sub_menu)
{
    $html = "";
    foreach($nav_sub_menu as $menu)
    {
        $html = $html."<div class='pms-sub-nav-item'>";
        $html = $html."<a href='".action($menu->action)."'>$menu->name</a>";
        $html = $html."</div>";
    }
    return $html;

}

function v_value($model, $f, $fields_enum)
{
    if (array_key_exists($f, $fields_enum))
    {
        $field_spec = $fields_enum[$f];
        $field_id = $field_spec["field"];

        if (array_key_exists($model->$field_id, $field_spec["enum"]))
        {
            return $field_spec["enum"][$model->$field_id];
        }else{
            return "-";
        }
    }else{
        return $model->$f;
    }
}

function form_group_field_id($f, $fields_enum){
    if (array_key_exists($f, $fields_enum))
    {
        $field_spec = $fields_enum[$f];
        return $field_spec["field"];
    }
    else
    {
        return $f;
    }
}

function form_group_v_value($model, $f, $fields_enum)
{
    if (array_key_exists($f, $fields_enum))
    {
        $field_spec = $fields_enum[$f];
        $field_id = $field_spec['field'];
        return array_get($field_spec["enum"], $model->$field_id, "-");
    }
    else
    {
        return $model->$f;
    }
}



function v_form_group($model, $f, $control_type='', $extra=[], $readonly=false)
{
    $html = "<div class='form-group'>";
    $html = $html."<label for='$f' >".trans("title.$f")."</label>";

    if ($control_type == '')
    {
        $html = $html.v_input_control($model, $f, $extra, $readonly);
    }
    else
    {
        $v_func = "v_${control_type}_control";
        $html = $html.$v_func($model, $f, $extra, $readonly);
    }
    $html = $html."</div>";

    return $html;
}

function v_uploadpic_control($model, $field, $extra=[], $readonly=false)
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_value = $model ? $model->$field : array_get_default($extra, 'value', '');
    $upload_accept = array_get_default($extra, 'accept', '*');

    $html = "<input class='fileupload_$input_name' type='file' name='${input_name}' accept='$upload_accept' ></input>";
    $html.= "</br><img id='image_$input_name' style='width:100px;margin-left:10%' src='$input_value'></img>";
    $html.="
<script type='text/javascript'>
$(function(){
$('.fileupload_$input_name').uploadPreview({ Img: 'image_$input_name', Width: 120, Height: 120 });

});
</script>

";

    return $html;
}

function v_datetime_control($model, $f, $readonly)
{
    $html = "<div>";
    $html.= "<input class='form-control form-datetime' name='$f' type='text' value='".$model->$f."' readonly>";
    $html.= "<span class=\"add-on\"><i class=\"icon-th\"></i></span>";
    $html.= "</div>";

    return $html;

}

function v_textarea_control($model, $f, $extra, $readonly)
{
    $value = $model ? $model->$f : "";
    $html = "<textarea name=\"$f\" class=\"form-control\" >$value";
    if ($readonly)
    {
        $html = $html." readonly ";
    }

    $html = $html."</textarea>";
    return $html;

}


function v_dropdownlist_control($model, $f, $extra, $readonly=false)
{
    $value = $model? $model->$f: "";
    $field_dict = $extra["dict"];

    $readonly_str = $readonly ? " readonly " : "";
    $html = "<select name='$f' class='form-control' $readonly_str>";

    reset($field_dict);
    while (list($k, $v) = each($field_dict))
    {
        if ($readonly && $k != $value)
        {
            continue;
        }

        $html = $html."<option value='$k'";
        if ($k == $value){
            $html = $html." selected='selected' ";
        }
        $html = $html." >$v</option>";
    }
    $html = $html."</select>";
    return $html;

}

function v_checkbox_control($model, $f, $extra = [], $readonly=false)
{
    $value = $model? $model->$f: false;
    $html = "<input type='checkbox' name='$f' ";
    if ($value)
    {
        $html.= " checked ";
    }
    
    $html .=" >".trans('title.'.$f).'</input>';
    return $html;
}

function v_input_control($model, $f, $extra = [], $readonly=false)
{
    $value = $model ? $model->$f: "";
    $html = "<input id=\"$f\" name=\"$f\" class=\"form-control\" value=\"$value\" ";
    while(list($k, $v) = each($extra))
    {
        $html = $html." $k='$v' ";
    }
    if ($readonly)
    {
        $html = $html." readonly ";
    }

    if ($f == "password" || $f == "password_confirmation") 
    {
        $html = $html." type='password' ";
    }
    else
    {
        $html = $html." type='text' ";
    }

    $html = $html."></input>";
    return $html;
}

function v_html_control($model, $f, $readonly)
{
    $html = "";
    if ($readonly ==false)
    {
            $html = $html."<script id='${f}_ueditor' name='$f' type='text/plain' class='cms-html-editor'>";
            $html = $html.$model->$f;
            $html = $html."</script>";
            $html = $html."<script type='text/javascript'>";
            $html = $html."UE.getEditor('${f}_ueditor');";
            $html = $html."</script>";
    }
    return $html;
}

function v_custom_group_value($k, $v)
{
    $html = "<div class='pms-display-group'>";
    $html .= "<div class='pms-group-title'><span>".trans("title.$k").":</span></div>";
    $html .= "<div class='pms-group-value'><span>".$v."</span></div>";
    $html .= "<div class='clear'></div>";

    $html .= "</div>";

    return $html;
}

function v_group_value($model, $f, $fields_enum, $type = '')
{
    $html = "<div class='pms-display-group'>";

    if ($type == '')
    {
        $html = $html.v_input_group_value($model, $f, $fields_enum);
    }
    else
    {
        $v_func = "v_${type}_group_value";
        $html = $html.$v_func($model, $f, $fields_enum);
    }
    $html = $html."</div>";

    return $html;
}

function v_input_group_value($model, $f, $fields_enum)
{
    $html = "<div class='pms-group-title'><span>".trans("title.$f").":</span></div>";
    $html = $html."<div class='pms-group-value'><span>".form_group_v_value($model, $f, $fields_enum)."</span></div>";
    $html = $html."<div class='clear'></div>";

    return $html;
}

function insert_date_init_script()
{
    $script = '<script type="text/javascript">'
        .'$(".form-date").datetimepicker({'
        .'language:"zh-CN",'
        //.'bootcssVer:3,'
        .'format:"yyyy-mm-dd",'
        .'todayHighlight: 1,'
        //.'daysOfWeekDisabled:[0,6],'
        //.'hoursDisabled:[0,1,2,3,4,5,6,7,8,12,13,18,19,20,21,22,23],'
        .'autoclose:1,'
        .'todayBtn:1,'
        .'weekStart:1,'
        .'minView:2,'
        .'startView:2,'
        .'forceParse:1,'
        .'});'
        .'</script> ';
    return $script;

}

function insert_datetime_init_script()
{
    $script = '<script type="text/javascript">'
        .'$(".form-datetime").datetimepicker({'
        .'language:"zh-CN",'
        //.'bootcssVer:3,'
        .'format:"yyyy-mm-dd hh:00:00",'
        .'todayHighlight: 1,'
        .'daysOfWeekDisabled:[0,6],'
        .'hoursDisabled:[0,1,2,3,4,5,6,7,8,12,13,18,19,20,21,22,23],'
        .'autoclose:1,'
        .'todayBtn:1,'
        .'weekStart:1,'
        .'minView:1,'
        .'startView:2,'
        .'forceParse:1,'
        .'});'
        .'</script> ';
    return $script;

}

function v_custom_submit($controller, $action, $name='submit', $style_type="default",$id="")
{
    $html = "<button class=\"btn btn-$style_type\" type=\"submit\" id=\"{$id}\">".trans('title.'.$name)."</button>";
    return $html;
}

function v_url($url, $name, $style_type="default")
{
    $html = "<a class=\"btn btn-$style_type\" href=". base_url($url)." role=\"button\">".trans('title.register')."</a>";
    return $html;
}

function check_operation($operation, $privileges)
{
    list($controller, $action) = explode("@", $operation->route);

    if (Auth::User()->id == 1)
    {
        App\Http\Models\Setting\Route::addRoute($operation->route);
    }
    return true;
}

function create_submit($operation, $privileges)
{
    if (!check_operation($operation, $privileges))
    {
        return;
    }
    $btn_name = empty($operation->name)? "" : trans("title.".$operation->name);
    $btn_type = $operation->style_type;
    $btn_icon = $operation->style_icon;
    $name = $operation->name;

    $html = "<button type='submit' class='btn btn-$btn_type glyphicon glyphicon-$btn_icon pms-button-tool-tips' title='".$btn_name."' name='$name' ></button>";
    
    return $html;

}

function create_button($operation, $privileges, $parms, $short=false)
{
    /* spec for admin manager button list :) */
    if (!check_operation($operation, $privileges))
    {
        return;
    }

    if ($operation->name == "destroy")
    {
        return create_destroy_button($operation, $privileges, $parms);

    }

    $action_url = action_url($operation->route, $parms);
    
    $btn_name = empty($operation->name)? "" : trans("title.".$operation->name);
    $btn_type = $operation->style_type;
    $btn_icon = $operation->style_icon;

    $html = "<a class='btn btn-$btn_type glyphicon glyphicon-$btn_icon pms-button-tool-tips' title='".$btn_name."' href='$action_url'>";
    
    $html.="</a>";
    return $html;
}  

function insert_destroy_script()
{
    $script = '<script type="text/javascript">'
        .'function destroy(id){'
        .'if(confirm("确认删除 => " + id)){'
        .'window.location = "'.action_url(gen_action("getDestroy")).'?id="+ id;'
        .'}'
        .'}'
        .'</script>';

    return $script;
}

function create_destroy_button($operation, $privileges=[], $parms=[], $short=true)
{
    $btn_name = ($short || empty($operation->name)) ?  "" : trans("title.".$operation->name);
    $id = $parms['id'];

    return '<a class="btn btn-danger glyphicon glyphicon-trash" onclick="destroy('.$id.");\">$btn_name</a>";
}

function v_gt_form_field($model, $field, $input_type = 'input', $extra=[] ) {
    $input_name = array_get_default($extra, 'name', $field);
    $input_display_name = v_trans_array($extra, 'display', $field);
    $input_necessary = array_get_default($extra, 'necessary', false)?v_gt_form_necessary():"";
    $input_func = "v_gt_form_$input_type";

    $html = '<div class="gt_form_group">';
    $html.= v_gt_form_label($input_name, $input_display_name, $input_necessary);

    $html.= $input_func($model, $field, $extra);
    $html.='</div>';
    if (array_get_default($extra, "no_split", false) == false)
    {
        $html.='<div class="split_line"></div>';
    }
    return $html;
}

function v_gt_form_necessary()
{
    return "<span style='color:red;'>*</span>";
}

function v_gt_form_label($control_name, $display_name, $necessary)
{
    $input_necessary = $necessary ? v_gt_form_necessary() : "";
    return "<label for='$control_name'>$display_name:$input_necessary</label>";
}

function v_gt_form_show($model, $field, $extra=[])
{
    $html = array_get_default($extra, 'html', "");
    return $html;
}

function v_gt_form_password($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");
    $html = "<input type='password' class='gt_form_control' name='$input_name' value='$input_value'>";
    $html.= "</input>";
    $html.= "<span class='gt_form_control_desc' >$input_desc</span>";

    return $html;
}

function v_gt_form_input($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);


    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");
    $html = "<input type='text' class='gt_form_control' name='$input_name' value='$input_value'>";
    $html.= "</input>";
    $html.= "<span class='gt_form_control_desc' >$input_desc</span>";

    return $html;
}

function v_gt_form_input_copy($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");
    $html = "<input class='gt_form_control' name='$input_name' value='$input_value'>";
    $html.= "</input>";
    //$html.= "<btn class='btn btn-primary' onclick='window.clipboardData.setData(\"Text\", \"$input_value\");alert(\"".trans('title.copy_success')."\");' >".trans('title.copy')."</button>";
    $html.= "<button class='btn btn-primary' onclick='copyToClipBoard(\"$input_name\");' >".trans('title.copy')."</button>";
    $html.= "<span class='gt_form_control_desc' >$input_desc</span>";

    return $html;
}

function v_gt_form_radio($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");

    $html = '';

    foreach(array_get_default($extra, "radio_data", []) as $k => $v)
    {
        $selected = $k==$input_value ? "checked": "";
        $html .= "<input type='radio' class='gt_form_control gt_form_control_radio' name='$input_name' $selected value='$k'>$v</input>";
        $html .="<span style='margin-right:40px'></span>";
    }

    $html.= "<span class='gt_form_control_desc' >$input_desc</span>";

    return $html;

}
function v_gt_form_uploadmpic($model,$field,$extra=[])
{
    $div_name = array_get_default($extra, 'name', $field);
    $div_desc = v_trans(array_get_default($extra, 'desc', ''));
    $div_value = $model ? $model->$field : array_get_default($extra, 'value', '');
    $div_accept = array_get_default($extra, 'accept', '*');
    $html = "<div id='$div_name' class='unstyled' style='margin-left:10%'></div>";
    //$html .= "<button type='button' id='${div_name}_Upload' class='btn btn-primary'>Upload Queued Files</button>";
    $html .= "<input type='hidden' name='{$div_name}_url' id='${div_name}_url'>";
    return $html;
}

function v_gt_form_uploadpic($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = $model ? $model->$field : array_get_default($extra, 'value', '');
    $upload_accept = array_get_default($extra, 'accept', '*');

    $html = "<input class='fileupload_$input_name' type='file' name='${input_name}' accept='$upload_accept' ></input>";
    $html.= "</br><img id='image_$input_name' style='width:100px;margin-left:10%' src='$input_value'></img>";
    $html.="
<script type='text/javascript'>
$(function(){
$('.fileupload_$input_name').uploadPreview({ Img: 'image_$input_name', Width: 120, Height: 120 });

});
</script>

";

    return $html;
}

function v_gt_form_upload($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $upload_accept = array_get_default($extra, 'accept', '*');
    $upload_0 = array_get_default($extra, 'upload_0', 'upload_0_desc');
    $upload_1 = array_get_default($extra, 'upload_1', 'upload_1_desc');

    $html = "<input type='radio' class='gt_form_control gt_form_control_radio ${input_name}_select' name='${input_name}_select' value='0'>".trans("title.$upload_0")."</input></br>";
    $html.= '<label></label>';
    $html .= "<input type='radio' class='gt_form_control gt_form_control_radio ${input_name}_select' name='${input_name}_select' value='1'>".trans("title.$upload_1")."</input></br>";

    $html.='<div class="gt_form_control_upload">';
    $html .= "<input style='margin-left:5%' class='${input_name}_0' type='text' name='${input_name}_0' placeholder='http://www.gtplay.cn/gtplay.zip' ></input>";
    $html .= "<input style='margin-left:5%' class='${input_name}_1' type='file' name='${input_name}_1' accept='$upload_accept' ></input>";

    $html.="</div>";
    $html.="<script type='text/javascript'>
            $('.${input_name}_0').hide();
            $('.${input_name}_1').hide();
            $('.${input_name}_select').change(function(){
                $('.${input_name}_0').hide();
                $('.${input_name}_1').hide();
                $('.${input_name}_'+ $(this).val()).show();
            });
        </script> ";
    return $html;
}

function v_gt_form_select_val($model, $field, $data=[])
{
    foreach($data as $k => $v)
    {
        if($model->$field == $k)
        {
            return $v;
        }
    }
    return "";
}


function v_gt_form_select($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");
    $readonly = array_get_default($extra, 'readonly', false);
    $html = "<select class='gt_form_control' name='$input_name'>";
    if ($readonly)
    {
        foreach(array_get_default($extra, "select_data", []) as $k => $v)
        {
            if($input_value== $k)
            {
                $html.="<option value=$k selected>$v</option>";
            }
        }
    }
    else
    {
        $html.='<option value>'.trans('title.select_tips').'</option>';
        foreach(array_get_default($extra, "select_data", []) as $k => $v)
        {
            $selected = $input_value== $k ? "selected" : "";
            $html.="<option value=$k $selected>$v</option>";
        }
    }

    $html.= "</select>";
    $html.= "<span class='gt_form_control_desc' >$input_desc</span>";

    return $html;
}

function v_gt_form_hidden($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_value = $model ? $model->$field: array_get_default($extra, 'value', '');
    return "<input type='hidden' name='$input_name' value='$input_value'></input>";

}

function v_gt_form_date($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_value = $model ? $model->$field : array_get_default($extra, 'value', '');

    $html= "<input class='form-date' name='$input_name' type='text' value='".$input_value."' readonly>";
    $html .= insert_date_init_script();
    return $html;

}

function v_gt_form_textarea($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");
    $html = "<textarea rows='5' class='gt_form_control' name='$input_name'>";
    $html.= $input_value;
    $html.= "</textarea></br>";
    $html.="<label></label>";
    $html.= "<span class='gt_form_control_desc' >$input_desc</span>";

    return $html;
}

function v_gt_form_html($model, $field, $extra=[])
{
    $input_name = array_get_default($extra, 'name', $field);
    $input_desc = v_trans(array_get_default($extra, 'desc', ''));
    $input_value = exists(old($input_name), $model ? $model->$field: "");
    $html = "<div rows='5' class='gt_form_control' style='margin-left:10%'>";
    $html .= "<script id='${field}_ueditor' name='$field' type='text/plain' style='height:300px'>";
    $html .= $input_value;
    $html .= "</script>";
    $html .= "<script type='text/javascript'>";
    $html .= "UE.getEditor('${field}_ueditor');";
    $html .= "</script>";
    $html .= "</div>";
    return $html;
}

function v_gt_form_app_dropdown($default_app, $apps, $action='', $params=[])
{
    $html = '<div class="appdropdown dropdown">';
    $default_app_name = $default_app?$default_app->app_name: "";
    $html.= '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'.$default_app_name.'<span class="caret"></span> </button>';
    $html.= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
    foreach($apps as $a)
    {
        $params['app_id'] =$a->id;
        $url = action_url($action, $params);
        $html.='<li><a href="'. $url .'">'.$a->app_name.'</a></li>';
    }
    $html.=' </ul> </div>';
    return $html;
}

function v_gt_form_get_upload_file($name)
{
    $upload_type = Input::get($name."_select");
    if ($upload_type == "")
    {
        return "";
    }
    else if($upload_type == "0")
    {
        return Input::get($name."_0");
    }
    else
    {
        $file = Input::file($name."_1");
        if($file && $file->isValid())
        {
            $ext = explode('\/', $file->getClientOriginalExtension());
            $ext = $ext[0];

            $save_name = str_replace('-','', guid()).".".$ext;

            $save_path ='uploads/'.date("Y/m/d/");
            if (!is_dir($save_path))
            {
                mkdir($save_path, 0777, true);
            }

            $path = $file->move($save_path, $save_name);
            return base_url($path);
        }
        return "";

    }
}

function v_gt_form_get_upload_file_apk($name)
{
    $upload_type = Input::get($name."_select");
    if ($upload_type == "")
    {
        return "";
    }
    else if($upload_type == "0")
    {
        return Input::get($name."_0");
    }
    else
    {
        $result = array();
        $file = Input::file($name."_1");
        if($file && $file->isValid())
        {
            $package_data = checkApk($file->getpathName());
            $result['schema'] = $package_data['app_package'];
            $result['package_size'] = round($file->getSize()/(1024*1024),2).'MB';
            $ext = explode('\/', $file->getClientOriginalExtension());
            $ext = $ext[0];

            $save_name = str_replace('-','', guid()).".".$ext;

            $save_path ='uploads/'.date("Y/m/d/");
            if (!is_dir($save_path))
            {
                mkdir($save_path, 0777, true);
            }

            $path = $file->move($save_path, $save_name);
            $result['download_url'] = base_url($path);
            return $result;
        }
        return $result;

    }
}

function v_gt_form_get_uploadpic($name)
{
    $file = Input::file($name);
    if($file && $file->isValid())
    {
        $ext = explode('\/', $file->getClientOriginalExtension());
        $ext = $ext[0];

        $save_name = str_replace('-','', guid()).".".$ext;

        $save_path ='uploads/'.date("Y/m/d/");
        if (!is_dir($save_path))
        {
            mkdir($save_path, 0777, true);
        }

        $path = $file->move($save_path, $save_name);
        return base_url($path);
    }
    return "";

}


