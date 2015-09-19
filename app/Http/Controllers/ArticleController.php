<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use Validator;
use Redirect;
use App\Http\Controllers\SingleFormController;

class ArticleController extends SingleFormController
{

    public function postStore()
    {
        $validator = Validator::make(Input::all(), [
            'priority'=>'numeric'
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
        if (!Input::get("priority"))
        {
            $model->priority = 0;
        }
        $model->save();
        return Redirect::to(action($this->controller . '@getIndex'));
    }

    public function __construct()
    {
        $this->model = 'App\Models\Article';
        $this->fields_show = ['id', 'title', 'read', 'updated_at'];
        $this->fields_edit = ['title', 'priority', 'content'];

        $this->template_dict['form.create'] = 'article_create';

        parent::__construct();
    }

}
