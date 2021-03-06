<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task App</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font.css" type="text/css" />
     <script src="js/ajax.js"></script> 

    <style>
        body {
            font-family: 'Lato';
            background-color: #fff;
            height: 80px;
        }

        .fa-btn {
            margin-right: 6px;
        }
        #alert {
            text-align: center;
            font-size: 13px;
            margin: 0 300px 0px 300px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .blog-footer {
          padding: 15px 0;
          color: #999;
          text-align: center;
          background-color: #2F0916;
          border-top: 1px solid #e5e5e5;
        }
    </style>

    <script type="text/javascript">
        function ConfirmDelete() {
            var x = confirm('Are you sure you want to delete this task?');
            if (x) {
                return true;
            }
            else
                return false;
        }
    </script>

</head>
<body id="app-layout">
    <nav class="navbar navbar-primary navbar-static-top" style="background-color: #2F0916;">
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
                @if (Auth::guest())
                    <a class="navbar-brand" href="{{ url('/') }}">
                        MyTask
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/home') }}">
                    MyTask
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user fa-fw"></i> 
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu form-control">
                                <li><a href="#"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
                                <li><a href="#"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp;Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="blog-footer navbar-fixed-bottom">
      <p>Copyright &copy; 2017 <a href="http://task.com">MyTa&sscr;k</a> | Designed by &Hscr;3'3n. All rights reserved.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
