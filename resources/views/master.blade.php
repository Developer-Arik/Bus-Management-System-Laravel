<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" token="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('style')
</head>
<body>
<header class="position-fixed w-100 bg-white">
 @auth
 <div class="bg-danger">
   <div style="max-width: 1150px;" class="container-fluid py-2">
     <div class="row">
       <div class="col-12 d-flex justify-content-between">
        <h6 class="py-0 my-0 text-light">Logged as {{ auth()->user()->name }}</h6>
        <div class="d-flex text-white">
          <a class="text-white p-0 m-0 text-decoration-none" href="{{ route('profile') }}">
            <h6 class="p-0 m-0">Profile</h6>
          </a>
        </div>
       </div>
     </div>
   </div>
 </div>
 @endauth
  <div style="max-width: 1150px;" class="container-fluid d-flex justify-content-between justify-content-lg-around py-2">
      <div class="logo py-1 m-0 px-2">
        <a href="/" class="text-decoration-none">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2YZve7wasvauH47F_tbNSFfO_zLkbTI75yhUij1D-VF6oa5Yd8VUWcy6dVpy9EXxXqQ&usqp=CAU" height="50px" alt="">
        </a>
      </div>
      <div class="m-0 p-0 d-flex align-items-center justify-content-center d-none d-lg-flex">
        <ul id="top-menu" class="m-0 p-0 list-unstyled">
          <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
          <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}">About</a></li>
          <li><a>Counters</a></li>
          <li class="{{ request()->is('faq') ? 'active' : '' }}"><a href="{{ url('/faq') }}">FAQ</a></li>
        </ul>
      </div>
      <div class="d-flex align-items-center d-none d-lg-flex butts">
            @guest
            <a class="btn rounded-0 btn-outline-primary border-2 shadow-none mx-1" href="{{ route('login') }}" >Login</a>
            <a class="btn rounded-0 btn-success border-2 shadow-none mx-1" href="{{ route('register') }}" >Register</a>
            @endguest
            @auth
              <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn rounded-0 btn-danger border-2 shadow-none">Logout</button>
              </form>
            @endauth
      </div>
      <div class="d-flex align-items-center d-block d-lg-none">
        <button id="toggle-offcanvas" class="btn rounded-0 btn-primary border-2 shadow-none collapsed py-1 px-2" type="button" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="bi" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
        </svg></button>
      </div>
  </div>
</header>
<section id="offcanvas">
  <div class="container-fluid vh-100">
    <div class="row">
      <div class="top py-3">
        <div class="d-flex justify-content-end px-2">
          <div class="p-2" id="offcanvas-close-button" style="cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" height="30px" fill="#000" class="bi bi-x-lg" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"></path>
              <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"></path>
            </svg>
          </div>
        </div>
      </div>
      <div class="bott d-flex align-items-center justify-content-center flex-column">
      <ul id="mob-menu" class="m-0 p-0 list-unstyled">
            <li class="active"><a href="/">Home</a></li>
            <li class=""><a>Show Time</a></li>
            <li class=""><a>Beverages</a></li>
            <li  class=""><a>My Account</a></li>
            <li class=""><a>About Cineplex</a></li>

      </ul>
      </div>
      <div class="d-flex justify-content-center">
       @guest
       <a class="btn rounded-0 btn-outline-primary border-2 shadow-none mx-1" href="{{ route('login') }}" >Login</a>
       <a class="btn rounded-0 btn-success border-2 shadow-none mx-1" href="{{ route('register') }}" >Register</a>
       @endguest
       @auth
       <form action="{{ route('logout') }}" method="post">
        @csrf
          <button type="submit" class="btn rounded-0 btn-danger border-2 shadow-none">Logout</button>
       </form>
       @endauth
      </div>
    </div>
  </div>
</section>
<div class="spacer-header"></div>
</div>
@yield('body')
<footer class="bg-danger">
 <div style="max-width: 1150px;" class="container-fluid">
  <div class="row py-3">
   <div class="container d-flex justify-content-between align-items-center flex-column flex-lg-row">
    <h6 class="text-light m-0 py-1 text-center">
     Unique Service © All Rights Reserved.
    </h6>
    <h6 class="m-0 py-1 text-light text-center">Developed By <a href="#" class="text-decoration-underline m-0 p-0 text-light">Developer-Arik</a></h6>
   </div>
  </div>
 </div>
</footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('script.js') }}"></script>
@yield('script')
</html>
