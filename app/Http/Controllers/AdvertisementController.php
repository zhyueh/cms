<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Input;
use Redirect;
use App\Http\Controllers\SingleFormController;

class AdvertisementController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Models\Advertisement';
        $this->fields_show = ['id','name', 'ad_place_id'];
        $this->fields_edit = ['name', 'ad_place_id', 'img_url', 'target_url',];

        $this->template_dict['form.create'] = 'advertisement_create';
        $this->template_dict['form.index'] = 'advertisement_index';
        parent::__construct();
    }

    public function postStore()
    {
        $validator = Validator::make(Input::all(),[
            'name'=>'required',
            'target_url'=>'required',
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
        if ($image = v_gt_form_get_uploadpic("img_url"))
        {
            $model->img_url = $image;
        }
        $model->save();
        return Redirect::to(action($this->controller . '@getIndex'));
    }


}
