<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;

class ArticleController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Models\Article';
        $this->fields_show = ['id', 'title', 'read', 'updated_at'];
        $this->fields_edit = ['title', 'priority', 'content'];

        $this->template_dict['form.create'] = 'article_create';

        parent::__construct();
    }

}
