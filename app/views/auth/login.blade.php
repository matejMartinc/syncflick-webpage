@extends('layouts.body')

@section('header')
    @parent
    <div class="row">
        <section id="login-form" class="small-12 large-6 large-offset-3 medium-8 medium-offset-2 columns end">
            {{ Form::open(array(
                'url'   => 'auth/login',
                'class' => 'small-12 columns'
            )) }}

                <div class="small-12 columns form-group">
                    
                    {{ Form::text('username', '', array(
                        'class'       => 'form-control',
                        'placeholder' => 'username'
                    )) }}
                </div>

                <div class="small-12 columns form-group">
                    
                    {{ Form::password('password', array(
                        'class'       => 'form-control',
                        'placeholder' => 'password'
                    )) }}
                </div>

                <div class="small-12 columns checkbox">
                    
                    {{ Form::label('remember_me', 'remember me', array(
                        'class' => 'rememberLabel'
                    )) }}
                    <label class="reform-checkbox reform">
                        {{ Form::checkbox('remember_me', 'on', true) }}
                        <span></span>
                    </label>
                    
                </div>

                <div class="small-12 columns form-group @if(Session::has('error'))has-error @endif">
                    {{ Form::button('login', array(
                        'type'  => 'submit',
                        'class' => 'controlButton'
                    )) }}
                </div>
                @if(Session::has('error'))
                    <div class="small-12 columns">
                        <p class="help-block">{{ Session::get('error') }}</p>
                    </div>
                @endif

            {{ Form::close() }}
        </section>
    </div>
@stop