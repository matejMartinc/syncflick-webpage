@extends('layouts.body')
@section('header')
    @parent
@stop

@section('content')

    <div class="row">
        <div class="small-12 large-6 large-offset-3 medium-8 medium-offset-2 columns end">

            <h2 class="title">Syncflick: start dubbing videos now!</h2>
            <video id="mainVideo" src="{{ asset('/img/video.mp4') }}" type="video/mp4" controls></video>
        </div>
    </div>
@stop
