<!DOCTYPE html>
<html lang="en">
<head>
<title>Badminton Portal | @yield('title')</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/maruti-style.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/maruti-media.css')}}" class="skin-color" />
@yield('css')
</head>
<body>

<div id="header">
  <h1>
    <a href="dashboard.html" style="color: white; margin-left: 5px; font-family: 'Comic Sans MS', cursive, sans-serif; font-size: 25px; text-decoration: none">
      Badminton Portal
    </a>
</h1>
</div>
@include('frontend.layouts.navigation')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    @yield('content')
  </div>
</div>
@include('frontend.layouts.footer')
<script src="{{asset('frontend/js/excanvas.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ui.custom.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.flot.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.peity.min.js')}}"></script>
<script src="{{asset('frontend/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('frontend/js/maruti.js')}}"></script>
<script src="{{asset('frontend/js/maruti.dashboard.js')}}"></script>
<script src="{{asset('frontend/js/maruti.chat.js')}}"></script>


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>

@yield('js')
</body>
</html>
