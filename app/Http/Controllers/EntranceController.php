<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;

class EntranceController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Models\Entrance';
        $this->fields_show = ['id', 'title'];
        $this->fields_edit = ['title', 'target_url'];


        parent::__construct();
    }


}
