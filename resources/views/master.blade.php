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
    </div>
    <div class="clear"></div>
    </div>
</div>
<div class="cms-body">
</div>
<div class="cms-power">
</div>
@endsection
