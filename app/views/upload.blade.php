@extends('layouts.body')
@section('header')
    @parent
@stop

@section('content')

    <div class="row">
        <div class="small-12 large-6 large-offset-3 medium-8 medium-offset-2 columns end">

            <h2 class="title">Upload</h2>
            @if (Auth::check())
                <div id="upload-form">
                    {{ Form::open(array(
                            'url'  => $uploadUrl,
                            'files'   => true,
                            'enctype' => 'multipart/form-data',
                            'onsubmit'=> 'setFormSubmitting()'
                            
                    )) }}
                        <div class="@if($errors->has('name'))has-error @endif">
                        {{ Form::label('name', 'name', array(
                            'class' => 'uploadLabel'
                        )) }}

                        {{ Form::text('name',"",array(
                            'id'=> 'name'
                        )) }}
                        {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                        @if (!$fileExists) 
                            <p class="help-block">
                                File with that name already exists. Please pick another name.
                            </p>    
                        @endif
                        </div>
                        <div class="row">
                           <div class="small-12 columns">

                            {{ Form::label('category', 'category', array(
                                'class' => 'uploadLabel'
                            )) }}

                            {{ Form::select('category', array('movies' => 'movies', 'music' => 'music', 'cartoons' => 'cartoons', 'funny' => 'funny', 'drama' => 'drama', 'scary' => 'scary', 'WTF' => 'WTF' ), null, array(
                              'class' => 'reform-selectbox',
                              'data-shift' => '5'
                            )) }}
                            
                            </div>
                        </div>
                        
                        <div class="@if($errors->has('file'))has-error @endif">
                        {{ Form::file('file', array(
                                'id'   => "file"
                        )) }} 

                        {{ $errors->first('file', '<p class="help-block">:message</p>') }}
                        </div>
                        
                        <div>

                        {{ Form::button('Insert', array(
                            'type'  => 'submit',
                            'id' => 'insert',
                            'onclick' => 'displayLoader()'
                        )) }}
                        </div>
                    {{ Form::close() }}

                    
                </div>
            @else
                <p class="notLogged">You need to be logged in to upload a video</p>
            @endif



            @if ($showVideo)
                <video id="video" src="{{$href}}{{$name}}" poster="{{ asset('/img/video.png') }}" autoplay type="video/mp4"></video>
                <p id="thumbnailWarning">Generating thumbnail. Please wait until video stops playing...</p>
                <div class="loader2"></div>
                <div id="canvasDiv">
                    <canvas id="canvas" width="1" height="1" style="border:1px solid #000000;"></canvas>
                </div> 
                
            @else 
                <div class="loader"></div>
            @endif
        </div>
    </div>
@stop

@section('google')
    
    <script>


        var warning = false;
        
        window.onload = function() {
            window.addEventListener("beforeunload", function (e) {
                var confirmationMessage = 'If you leave the page before your video stops playing ';
                confirmationMessage += 'it will not be properly loaded.';

                if (!warning) {
                    return undefined;
                }

                (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
            });
        };
        document.addEventListener('DOMContentLoaded', function(){


            //generate thumbs by getting a canvas image from video still
            var vidDOM = $('video');
            if (vidDOM.get(0)){
                warning = true;
                var vid = vidDOM.get(0);
                
                //generate thumbs on video ended events. Other video events are not triggered in android browsers
                vid.addEventListener('ended', function() {
                    console.log("je event");
                    var canvas = document.getElementById('canvas');
                    var w = vid.videoWidth * 0.2;
                    var h = vid.videoHeight * 0.2;
                    canvas.width = w;
                    canvas.height = h; 
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(vid, 0, 0, w, h);
                    canvasData = canvas.toDataURL("image/jpeg");
                    //ajax request to controller 
                    var posting = $.post( "/ajax", { "image": canvasData, "name": "{{$name}}" } );
                    posting.done(function( data ) {
                        console.log(data.fail);
                    });
                    //upload category and name after thumb is generated and uploaded
                    loadScript();
                    warning = false;
                    $(".loader2").css("display", "none");
                    $("#thumbnail-warning").css("display", "none");

                });
                vid.addEventListener('click',function(){
                    vid.play();
                }, false);

            }    
        });
        //load google api client.js - used to load name and category in datastore
        function loadScript() {
            var script = document.createElement('script'); 
            script.type = 'text/javascript'
            script.src = 'https://apis.google.com/js/client.js?onload=init';
            document.body.appendChild(script);
        }



        function init() {
    
            //Parameters are APIName,APIVersion,CallBack function,API Root
            gapi.client.load('taskApi', 'v1', function() {insert()}, 'https://red-delight-860.appspot.com/_ah/api');
        }

        //upload username, name and category
        function insert() {
            
            var _name = '{{$name}}';
            var _category = '{{$category}}';
            var _user = '@if (Auth::check()) {{Auth::user()->username }} @endif';
            
            if(_name != "" && _category != "") {
            
                //Build the Request Object
                var requestData = {};
                requestData.category = _category;
                requestData.name = _name;
                requestData.user = _user;

                
                gapi.client.taskApi.storeTask(requestData).execute(function(resp) {
                    
                    if (!resp.code) {
                        
                        //Just logging to console now, you can do your check here/display message
                        console.log("Loading successful");
                    }
                    else {
                        console.log(resp.code + " : " + resp.message);
                        
                    }
                });
            }
            
        }


           
    </script>    
@stop
