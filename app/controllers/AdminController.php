<?php

class AdminController extends BaseController {

	
	public function showWelcome()
	{
		if ( ! Auth::user()->isAdmin()) {
			return App::abort(401, 'You are not authorized.');
		}
		else {
			
			$data = $this->returnUsers();
			return View::make ('admin', $data);
		}
	}
		
	public function remove()
	{
		if ( ! Auth::user()->isAdmin()) {
			return App::abort(401, 'You are not authorized.');
		}
		else {


			$user = Input::all()['user'];

			DB::table('users')->where('username', $user)->delete();

			$data = $this->returnUsers();
			return View::make ('admin', $data);
		}

	}

    private function returnUsers() {
    	$usernames = [];
		$emails = [];
		
	
		$users = DB::table('users')->get();
		foreach ($users as $user) {
			$username = $user->username;
			$email = $user->email;
			array_push($usernames, $username);
			array_push($emails, $email);
		}
        return array("usernames" => $usernames, "emails" => $emails);
    } 
}