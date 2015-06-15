@extends('layouts.body')

@section('header')
    @parent
    <div class="row">
        <section id="register-form" class="small-12 large-6 large-offset-3 medium-8 medium-offset-2 columns end">
            {{ Form::open(array(
                'url'   => 'auth/register',
                'class' => 'small-12 columns'
                
            )) }}

                <div class="small-12 columns form-group @if($errors->has('username'))has-error @elseif(!$errors->has('username') && $errors->all())has-success @endif">
                    {{ Form::text('username', '', array(
                        'class'       => 'form-control',
                        'placeholder' => 'username'
                    )) }}
                    {{ $errors->first('username', '<p class="help-block">:message</p>') }}
                </div>

                <div class="small-12 columns form-group @if($errors->has('email'))has-error @elseif(!$errors->has('email') && $errors->all())has-success @endif">
                    {{ Form::email('email', '', array(
                        'class'       => 'form-control',
                        'placeholder' => 'email'
                    )) }}
                    {{ $errors->first('email', '<p class="help-block">:message</p>') }}
                </div>

                <div class="small-12 columns form-group @if($errors->has('password'))has-error @endif">
                    {{ Form::password('password', array(
                        'class'       => 'form-control',
                        'placeholder' => 'password'
                    )) }}
                    {{ $errors->first('password', '<p class="help-block">:message</p>') }}
                </div>

                <div class="small-12 columns form-group @if($errors->has('password'))has-error @endif">
                    {{ Form::password('password_confirmation', array(
                        'class'       => 'form-control',
                        'placeholder' => 'confirm password'
                    )) }}
                </div>
                
                
                <div class="small-12 medium-6 large-6 columns">
                    {{ Form::button('register', array(
                        'type'  => 'submit',
                        'class' => 'controlButton'
                    )) }}
                
                </div>
                <div class="small-12 medium-6 large-6 columns">
                
                    {{ Form::button('clear', array(
                        'type'  => 'reset',
                        'class' => 'controlButton rightFloat'
                    )) }}
                </div>   

            {{ Form::close() }}
            <p id="registrationWarning">After registration you will receive an email. Please click on the link in email to confirm your registration.</p>
        </section>
    </div>
@stop