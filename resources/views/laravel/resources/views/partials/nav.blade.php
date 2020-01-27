<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <div id="brand-img"></div>
            </a>
        </div>
        @if(Auth::user())
        @include('partials.navlinks')
        @else
        <div id="nav-options">
          <a href="{{ route('home') }}" class="nav-option"><h4>{{config('app.name')}} System</h4></a>
        </div>
        @endif
        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                    <!--li><a href="{{ route('register') }}">Register</a></li-->
                @else
                @if ($exports > 0)
                <li class="dropdown">
                  <a style="float:left;" class="dropdown-toggle" href="{{ route('user.exports') }}">Locked Exports:<label class="label" style="color: red;">{{$exports}}</label></span></a>
                </li>
                @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                          @if(Auth::user()->is_admin)
                            <li><a href="{{ route('admin.import') }}">Admin</a></li>
                          @endif
                          @if(Auth::user())
                          <li><a href="{{ route('auth.changepassword') }}">Update Password</a></li>
                          @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>



    <div id="head-divider"></div>
</nav>
