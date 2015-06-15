@extends('layouts.body')
@section('header')
    @parent
@stop

@section('content')

    <div class="row">
        <div class="small-12">

            <h2 class="title">Users</h2>
            @for ($i = 0; $i < count($usernames); $i++)
                <div class="row">
                    <div class="small-4 columns">
                        <p class="user"> {{ $usernames[$i] }} </p>
                    </div>  
                    <div class="small-4 columns">
                        <p class="emails"> {{ $emails[$i] }} </p>
                    </div>
                    
                    <div class="small-4 columns">
                        <button type="button" id="{{$usernames[$i]}}" onclick="del(this.id)">Delete user</button> 
                    </div>
                </div>
                <hr/>
            @endfor
                 
        </div>
        <script>
            function del(user) {
                var posting = $.post( "/admin", { "user": user } );
                posting.done(function( data ) {
                    console.log(data.fail);
                });

            }
        </script>
    </div>
@stop


   