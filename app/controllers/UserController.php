<?php

class UserController extends BaseController {
 
    public function index()
    {
        if(Auth::check()) {
            return Redirect::to('/dashboard');
        }
        return View::make('login');
    }
 
    public function doLogin()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $remember = Input::get('remember_me');

        if (Auth::attempt(['email' => $username, 'password' => $password],$remember))
        {
            return Redirect::intended('/inventory');
        }
 
        return Redirect::back()
            ->withInput()
            ->withErrors('That username/password combo does not exist.');
    }
 
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
 
}