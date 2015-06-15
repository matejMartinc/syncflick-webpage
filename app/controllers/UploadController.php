<?php

require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;


class UploadController extends BaseController {

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

	public function showWelcome()
	{
		
		$options = [ 'gs_bucket_name' => 'syncflick.appspot.com' ];
		$upload_url = CloudStorageTools::createUploadUrl('/upload', $options);
		
		$metaData = array("uploadUrl" => $upload_url, "name" => "", "category" => "", "href" => "#", "showVideo" => false, "fileExists" => true);
		

		return View::make('upload', $metaData);
	}

	public function submit()
	{
		

        if(Auth::check()) {
	        
	        $data = Input::all();
	        
	        Validator::extend('mp4', function($field,$value,$parameters){
 				return $value->getClientOriginalExtension() == 'mp4';
			});
			Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
	        $messages = array('mp4'=>'Only mp4 files are allowed', 'alpha_spaces' => 'Only letters and spaces are allowed in name');

			$rules = array(
	            'name'     => 'required|min:3|max:100|alpha_spaces',
	            'file'     => 'required|mp4|between:0,12000'
	        );
			
			$options = [ 'gs_bucket_name' => 'syncflick.appspot.com' ];
		    $upload_url = CloudStorageTools::createUploadUrl('/upload', $options);
	        
	        $validator = Validator::make($data, $rules, $messages);

	        
	        if ($validator->passes()) {
	            $data['name'] = str_replace(" ", "_", $data['name']);
				$file = Input::file('file');
				
				$gs_name = $_FILES['file']['tmp_name'];
				$filetype = $file->getClientOriginalExtension();
				$filename = 'gs://syncflick.appspot.com/'.$data['name'].'.'.$filetype;
				
				if(!file_exists($filename)) {
		        	move_uploaded_file($gs_name, $filename);
		        	$metaData = array("uploadUrl" => $upload_url, "name" => $data['name'], "category" => $data['category'],  "href" => "/video?name=", "showVideo" => true, "fileExists" => true);
		    		return View::make('upload', $metaData);
		        }
		        else {
		        	$metaData = array("uploadUrl" => $upload_url, "name" => "", "category" => "", "href" => "#", "showVideo" => false, "fileExists" => false);
		        	return View::make('upload', $metaData);
		        }
		        
            } else {
			    $metaData = array("uploadUrl" => $upload_url, "name" => "", "category" => "", "href" => "#", "showVideo" => false, "fileExists" => false);
			    return Redirect::to('/upload')->withErrors($validator);
			}
		}
		else {
			return "You don't have permission to view this site.";
		}
    }
}