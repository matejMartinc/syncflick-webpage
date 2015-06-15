<?php

class AjaxThumbController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function loadThumb()
	{
		if(Auth::check()) {
			if (!preg_match('/data:([^;]*);base64,(.*)/', Input::all()['image'], $matches)) {
				return Response::json(array('fail' => Input::all()));
			}
			// Decode the data
			$data = $matches[2];
			$data = str_replace(' ','+',$data);
			$data = base64_decode($data); 
			$filename = 'gs://syncflick.appspot.com/'.Input::all()['name'].'.jpg';
			file_put_contents($filename, $data);
			return Response::json(array('fail' => Input::all()));
		}
	}

}