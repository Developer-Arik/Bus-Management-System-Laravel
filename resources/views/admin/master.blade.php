<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" token="{{ csrf_token() }}">

    <title>Starlight Responsive Bootstrap 4 backend Template</title>

    <!-- vendor css -->
    <link href="{{ asset('backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/starlight.min.css') }}">
    @yield('style')
  </head>

  <body>
    <!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="sl-header">
    <div class="sl-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->
    <div class="sl-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name">{{ auth()->guard('admin')->user()->name }}</span></span>
            <img src="{{ asset('backend/img/img3.jpg') }}" class="wd-32 rounded-circle" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="{{ route('admin.profile') }}"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
              <li><a href="{{ route('admin.logout') }}"><i class="icon ion-power"></i> Sign Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
    </div><!-- sl-header-right -->
  </div><!-- sl-header -->
  <!-- ########## END: HEAD PANEL ########## -->
  <!-- ########## END: RIGHT PANEL ########## --->
  <div class="sl-logo">
        <a href="{{ route('admin.dashboard') }}">
            Unique
        </a>
    </div>
  <div class="sl-sideleft">
    <div style="padding: 6px"></div>
    <label class="sidebar-label"></label>
    <div class="sl-sideleft-menu">
      <a href="{{ route('admin.dashboard') }}" class="sl-menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">Dashboard</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <a href="JavaScript:Void(0);" class="sl-menu-link {{ request()->is('admin/bus') || request()->is('admin/bus/add') ? 'active show-sub' : '' }}">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
          <span class="menu-item-label">Bus</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.bus') }}" class="nav-link {{ request()->is('admin/bus') ? 'active' : '' }}">All Bus</a></li>
        <li class="nav-item"><a href="{{ route('admin.bus.add') }}" class="nav-link {{ request()->is('admin/bus/add') ? 'active' : '' }}">Add Bus</a></li>
        {{-- <li class="nav-item"><a href="form-layouts.html" class="nav-link">Form Layouts</a></li>
        <li class="nav-item"><a href="form-validation.html" class="nav-link">Form Validation</a></li>
        <li class="nav-item"><a href="form-wizards.html" class="nav-link">Form Wizards</a></li>
        <li class="nav-item"><a href="form-editor-text.html" class="nav-link">Text Editor</a></li> --}}
      </ul>
      <a href="JavaScript:Void(0);" class="sl-menu-link {{ request()->is('admin/point') || request()->is('admin/point/add') ? 'active show-sub' : '' }}">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
          <span class="menu-item-label">Point</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.point') }}" class="nav-link {{ request()->is('admin/point') ? 'active' : '' }}">All Point</a></li>
        <li class="nav-item"><a href="{{ route('admin.point.add') }}" class="nav-link {{ request()->is('admin/point/add') ? 'active' : '' }}">Add Point</a></li>
        {{-- <li class="nav-item"><a href="form-layouts.html" class="nav-link">Form Layouts</a></li>
        <li class="nav-item"><a href="form-validation.html" class="nav-link">Form Validation</a></li>
        <li class="nav-item"><a href="form-wizards.html" class="nav-link">Form Wizards</a></li>
        <li class="nav-item"><a href="form-editor-text.html" class="nav-link">Text Editor</a></li> --}}
      </ul>
      <a href="JavaScript:Void(0);" class="sl-menu-link {{ request()->is('admin/scedule') || request()->is('admin/scedule/add') ? 'active show-sub' : '' }}">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
          <span class="menu-item-label">Scedule</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.scedule') }}" class="nav-link {{ request()->is('admin/scedule') ? 'active' : '' }}">All Scedule</a></li>
        <li class="nav-item"><a href="{{ route('admin.scedule.add') }}" class="nav-link {{ request()->is('admin/scedule/add') ? 'active' : '' }}">Add Scedule</a></li>
        {{-- <li class="nav-item"><a href="form-layouts.html" class="nav-link">Form Layouts</a></li>
        <li class="nav-item"><a href="form-validation.html" class="nav-link">Form Validation</a></li>
        <li class="nav-item"><a href="form-wizards.html" class="nav-link">Form Wizards</a></li>
        <li class="nav-item"><a href="form-editor-text.html" class="nav-link">Text Editor</a></li> --}}
      </ul>
      <a href="JavaScript:Void(0);" class="sl-menu-link {{ request()->is('admin/booking') || request()->is('admin/booking/add') ? 'active show-sub' : '' }}">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
          <span class="menu-item-label">Booking</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.booking') }}" class="nav-link {{ request()->is('admin/booking') ? 'active' : '' }}">Search Bookings</a></li>
        <li class="nav-item"><a href="{{ route('admin.booking.add') }}" class="nav-link {{ request()->is('admin/booking/add') ? 'active' : '' }}">Book Seat</a></li>
      </ul>
      <a href="JavaScript:Void(0);" class="sl-menu-link {{ request()->is('admin/info') || request()->is('admin/info/about') || request()->is('admin/info/faq') ? 'active show-sub' : '' }}">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
          <span class="menu-item-label">Information</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('info.about') }}" class="nav-link {{ request()->is('admin/info/about') ? 'active' : '' }}">About Page</a></li>
        <li class="nav-item"><a href="{{ route('info.faq') }}" class="nav-link {{ request()->is('admin/info/faq') ? 'active' : '' }}">FAQ</a></li>
      </ul>
    </div><!-- sl-sideleft-menu -->

    <br>
  </div><!-- sl-sideleft -->
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    @yield('body')
    <footer class="sl-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2017. Starlight. All Rights Reserved.</div>
          <div>Developed by Arik</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/starlight"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Starlight,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/starlight"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="{{ asset('backend/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('backend/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('backend/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('backend/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('backend/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('backend/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('backend/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>

    <script src="{{ asset('backend/js/starlight.js') }}"></script>
    <script src="{{ asset('backend/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('backend/js/dashboard.js') }}"></script>
    <script src="{{ asset('backend/lib/rickshaw/rickshaw.min.js') }}"></script>
    @yield('script')
  </body>
</html>
