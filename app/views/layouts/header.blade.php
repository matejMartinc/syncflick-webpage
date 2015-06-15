<header class="header">
    <div class="row">
        <div class="small-12 medium-3 large-4 columns text-center">
            <a href="{{ URL::to('/') }}"><img class="logo" src="{{ asset('/img/logo-syncflick.png') }}"></a>
        </div>
        
        <div class="small-12 medium-9 large-8 columns text-center">
            <nav class="top-bar" data-topbar> 
                <ul class="title-area">
               
                    <li class="toggle-topbar">
                        <a href="#">
                            <img src="{{ asset('/img/menu-icon.png') }}">
                        </a>
                    </li>
                </ul>
                <section class="top-bar-section"> 
                    <ul class="right"> 
                        <li>
                            <a href="{{ URL::to('https://play.google.com/store/apps/details?id=mmdevelopment.synchronizer') }}">DOWNLOAD APP</a>
                        </li> 
                        <li>
                            <a href="{{ URL::to('upload') }}">UPLOAD VIDEOS</a>
                        </li> 

                        @if (!Auth::check())
                            <li>
                                <a href="{{ URL::to('auth/login') }}">LOGIN</a>
                            </li> 
                            <li>
                                <a href="{{ URL::to('auth/register') }}">REGISTER</a>
                            </li>
                         @else
                            <li>
                                <a href="{{ URL::to('auth/logout') }}">LOGOUT</a>
                            </li>
                        @endif   
                    </ul> 
                     
                </section> 
            </nav>

            
        </div>
    </div>
</header>

