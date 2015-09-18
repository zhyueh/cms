<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Models\Bulletin;
use Input;

class BulletinController extends SingleFormController
{

    public function getEdit()
    {
        return $this->viewMake('bulletin',
            ['model'=>Bulletin::first()]
        );
    }

    public function postEdit()
    {
        $m = Bulletin::first();
        if(!$m)
        {
            $m = new Bulletin;
        }
        $m->data = $this->input("data");
        $m->save();

        return $this->viewMake('bulletin',
            [
                'model'=>Bulletin::first(),
                'success'=>"OK",
                ]
        );

    }

}
