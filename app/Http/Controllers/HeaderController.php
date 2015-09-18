<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use Validator;

class HeaderController extends SingleFormController
{

    public function __construct()
    {
        $this->model = 'App\Models\Header';
        $this->fields_show = ['id', 'name'];

        $this->template_dict['form.create'] = 'header_create';

        parent::__construct();
    }

    public function postStore()
    {
        $validator = Validator::make(Input::all(),[
            'display_order'=>'numeric',
            ]);
        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $model = new $this->model;
        if($id = Input::get("id")){
            $model = $model->find($id);
        }
        $model->fill(Input::all());
        if ($image = v_gt_form_get_uploadpic("image"))
        {
            $model->image = $image;
        }
        $model->save();
        return Redirect::to(action($this->controller . '@getIndex'));
    }
}
