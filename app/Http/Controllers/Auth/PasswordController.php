<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Input;
use Redirect;
use Validator;
use App\Http\Controllers\SingleFormController;
use App\User;

class PasswordController extends SingleFormController
{
    public function getUpdatePwd()
    {
        return $this->viewMake('auth.update_pwd',
            ['model'=> Auth::user()]);
    }

    public function postUpdatePwd()
    {
        $validator = Validator::make(Input::all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt(Input::get('password'));
        $user->save();

        return Redirect::to(action("HomeController@getIndex"));
    }
}
