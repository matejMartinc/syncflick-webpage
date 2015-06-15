<?php

class AuthController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('guest', array('except' => 'getLogout'));
        $this->beforeFilter('auth', array('only' => 'getLogout'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        return Redirect::to('auth/login');
    }

    public function getLogin()
    {
        return View::make('auth.login');
    }

    public function postLogin()
    {
        $allowLogin = true;
        $userdata = array(
            'username'  => Input::get('username'),
            'password'  => Input::get('password'),
            'confirmed' => 1
        );

        $remember = (Input::get('remember_me') == 'on') ? true : false;

        if (Auth::attempt($userdata, $remember)) {
            return Redirect::intended('/');
        }

        return Redirect::to('auth/login')
            ->with('error', 'Your username and password combination was incorrect.')
            ->withInput();
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function getRegister()
    {
        return View::make('auth.register');
    }

    public function getConfirm()
    {
        $confirmation=substr(strrchr(Request::path(),"/"),1);
        DB::table('users')
            ->where('confirmation', $confirmation)
            ->update(array('confirmed' => 1));
        return Redirect::to('/');
    }

    public function postRegister()
    {
        $data = Input::all();

        $rules = array(
            'username' => 'required|alpha_num|min:3|max:32|unique:users,username',
            'email'    => 'required|email|max:320|unique:users,email',
            'password' => 'required|confirmed',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $userdata = array(
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password'])

            );

            $confirmation=str_random(32);

            Mail::send('emails.auth.confirmationEmail', array('username'=>Input::get('username'), 'confirmation'=>$confirmation), function($message){
                $message->to(Input::get('email'), Input::get('username'))->subject('Welcome to syncflick!');
            });

            /* add user */
            $user = new User($userdata);
            $user -> confirmed = 0;
            $user -> confirmation = $confirmation;
            $user->save();
            $userID = $user -> id;
            $userName = $user -> username;
            

            

            return Redirect::to('/');
        }

        return Redirect::to('auth/register')->withInput()->withErrors($validator);
    }

}
