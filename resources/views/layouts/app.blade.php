<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>igtapps</title>

    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--Custom CSS-->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body><nav class="navbar navbar-expand-lg border-bottom shadow bg-light">
    <div class="container">

       <a href="#" class="navbar-brand me-auto">IGTAPPS</a>

       @guest
            @if (Route::has('login'))
                <a href="/login" class="btn login-btn order-sm-last" style="margin-left: 10px;">
                    LOGIN
                </a>
            @endif
        @else
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->firstname }}
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>
            </ul>
          </div>
       @endguest
       
       
       <a class="btn d-sm-none fill-primary mb-1" data-bs-toggle="offcanvas" href="#navbarExample1" role="button" aria-controls="offcanvasExample">
           <svg viewBox="0 0 448 512" width="20px" height="20px"><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"></svg>
       </a>
    </div>
</nav>


<div class="offcanvas offcanvas-start navbarExampleSidebar1" id="navbarExample1" aria-labelledby="navbarExample1Label">
   <div class="offcanvas-header">
     <h5 class="offcanvas-title" id="offcanvasExampleLabel">Navbar</h5>
     <button type="button" class="btn-close text-reset text-primary2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>

   <div class="offcanvas-body">
       <nav class="nav flex-column">
           <li class="nav-link"><a href="">Item1</a></li>
       </nav>
   </div>
</div>
    @yield('content')
</body>
</html>