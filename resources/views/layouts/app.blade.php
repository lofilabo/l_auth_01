<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chordata') }}</title>

    <!-- Styles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    --->
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
 
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/style4.css">

    <script src="https://use.fontawesome.com/590b1878e3.js"></script>

    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">

<style>
.fixed-height-001{
	height:40px;
}

.content-heightfixer{
	margin: 0px 10px 10px -10px !important;
}

@media (max-width: 600px) {
    .btn-leftpadding-fixer{
            margin-left:0px !important;
    }

    .pullup{
        margin: -10px 0px 0px 0px !important;
    }

    .sb-h-adjust{
        height:20px;
        background-color:#aaaaaa !important;
    }

    .topmenu-hider{
        display: none !important;
    }
}

@media (min-width: 601px) {
    .btn-leftpadding-fixer{
            margin-left:-80px !important;
            margin-top: -20px !important;
    }

    .pullup{
        margin: -10px 0px 0px 0px !important;
    }

    .sb-h-adjust{
        height:60px;
        background-color:#aaaaaa  !important;
    }

    .topmenu-hider{

    }

}


.topbar{
	background-color:#aaaaaa;
    padding: 10px 10px 10px 20px !important;
}


</style>

</head>
<body>
 
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-default topbar">
				<h1/>MAIN HEADER</h1>
	            </div>
	        </div>
	    </div>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav class='pullup' id="sidebar">
            
            <div class="sidebar-header sb-h-adjust">
                <!--
                <h3>Sidebar</h3>
                <strong>SB</strong>
                -->
               
            </div>
            
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-home"></i>
                        Web Site Contact
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="/resp_contact">Contact Form</a></li>
                         <li><a href="/resp_alliance">Alliance</a></li>
                         <li><a href="/resp_recruitment">Recruiters</a></li>
                         <li><a href="/resp_sesrecruitment">SES Recruiters</a></li>
                         <li><a href="/resp_jobseeker">Candidates</a></li>
                         <li><a href="/resp_sesjobseeker">SES Candidates</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#facebookConsole" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        Facebook Console
                    </a>
                    <ul class="collapse list-unstyled" id="facebookConsole">
                        <li><a href="/console/fb/leads/read">View Leads</a></li>
                        <li><a href="/console/fb">Log In</a></li>
                        <li><a href="/console/fb/logout">Log Out</a></li>

                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-camera-retro"></i></i>Item</a></li>
                <li><a href="#"><i class="fa fa-question"></i>Item</a></li>
                <li><a href="#"><i class="fa fa-paper-plane"></i> Item</a> </li>



		 @if (Auth::guest())
                  <li ><a class="article" href="{{ route('login') }}"><i class="fa fa-sign-in"></i>Login</a></li>
                  <li><a class="article" href="{{ route('register') }}"><i class="fa fa-registered"></i>Register</a></li>
		@else
                  <li>  <a class="article"  href="{{ route('logout') }}"   onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fa fa-user"></i>Logout</a></li>
		@endif

            </ul>

            <ul class="list-unstyled CTAs">
               <li>
                    <a href="#">Button</a>
                </li>
                <li>
                    <a href="" class="article">Button</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="content-heightfixer">

            <nav class="fixed-height-001 navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn-leftpadding-fixer btn btn-info">
                        <i class="fa fa-arrow-circle-left"></i>
                        <!--<span>Toggle Sidebar</span>-->
                    </button>
                    <button class="topmenu-hider btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-align-justify"></i>
                    </button>
			
                    <div class="topmenu-hider collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

	                          <li class="nav-item active">
	                                <a class="nav-link" href="#">Top Menu Item</a>
                            	  </li>

                            @if (Auth::guest())
	                          <li class="nav-item active">
	                                <a class="nav-link"  href="{{ route('login') }}">Login</a>
                            	  </li>
	                          <li class="nav-item active">
	                                <a class="nav-link"  href="{{ route('register') }}">Register</a>
                            	  </li>
                            @else
	                          <li class="nav-item active">
	                                <a class="nav-link" href="{{ route('logout') }}"   onclick="event.preventDefault();  document.getElementById('logout-form').submit();">Logout</a>
                            	  </li>
                            @endif




                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>


                        </ul>
                    </div>
                </div>
            </nav>
 	    <!--
            <h2>Title</h2>
            <p>Paragraph</p>
	    -->
	  @yield('content')
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>








    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
