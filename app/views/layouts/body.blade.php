@extends('layouts.base')

@section('body')

<div class="container">
    @section('header')
        @include('layouts.header')
    @show
    <div id="main-container">
        <section class="row background">
            <section id="main-content" class="small-12 medium-12 large-12 columns">
                @yield('content')
            </section>
        </section>
    </div>

    @section('footer')
        @include('layouts.footer')
    @show
</div>
@stop

@section('googleapi')
    @yield('google')
@stop