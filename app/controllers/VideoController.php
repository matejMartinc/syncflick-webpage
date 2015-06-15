<?php

require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;


class VideoController extends BaseController {

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

	public function showVideo()
	{
		if(isset($_GET['name']))
            CloudStorageTools::serve('gs://syncflick.appspot.com/'.$_GET['name'].'.mp4', ['content_type' => 'video/mp4']);
	}

}