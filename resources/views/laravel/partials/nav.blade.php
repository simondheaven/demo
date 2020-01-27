<header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <a class="navbar-brand" href="#">
          <img src="https://laravel.com/img/logomark.min.svg" width="30" height="30" class="d-inline-block align-top" alt="">
          Laravel Social App
        </a>

        @if(\Auth::check())
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

          <ul class="navbar-nav mr-auto">

            <li id="nav-link-1" class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>

            <li id="nav-link-2" class="nav-item">
              <a class="nav-link" href="{{route('profile')}}">Profile</a>
            </li>

            <li id="nav-link-3" class="nav-item">
              <a class="nav-link" href="{{route('about')}}">About</a>
            </li>

          </ul>

          <form action="{{route('logout')}}" method="POST" class="form-inline mt-2 mt-md-0">
            {{ csrf_field() }}
            <button class="nav-link" type="submit" style="background:transparent; border: none; color: #fff;">Sign Out</button>
          </form>

        </div>

        @else

        <div style="right:0px; position:absolute;">
          <a style="color: #fff;" class="nav-link" href="{{config('app.url')}}">
            <svg class="bi bi-arrow-counterclockwise" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 4.5A5.5 5.5 0 114.5 10a.5.5 0 00-1 0 6.5 6.5 0 103.25-5.63l.5.865A5.472 5.472 0 0110 4.5z" clip-rule="evenodd"></path>
              <path fill-rule="evenodd" d="M9.354 1.646a.5.5 0 00-.708 0l-2.5 2.5a.5.5 0 000 .708l2.5 2.5a.5.5 0 10.708-.708L7.207 4.5l2.147-2.146a.5.5 0 000-.708z" clip-rule="evenodd"></path>
            </svg> Return To Welcome Page
          </a>
        </div>

        @endif
      </nav>
</header>
