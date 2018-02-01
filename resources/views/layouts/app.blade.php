<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hunting Book') }}</title>

    <!-- Styles -->
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('css/moje_style.css')}}" rel="stylesheet">
    <link href="{{url('css/menu.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script type="text/javascript">
    // Funkcja wyświetlania bieżącego czasu
// pobiera datę z serwera

    function printTime() {
        var d = new Date();
        var hours = d.getHours();
        var mins = d.getMinutes();
        var sec = d.getSeconds();
        $("#time").text(hours + ":" + mins + ":" + sec);
       // $("#time").text(DateTime);

    }
    setInterval(printTime, 1000);

    </script>


     <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
</head>
<body>
    <div id="app">
          <div style="height: 54px;background-image:url('{{ asset('baner.png') }}');border-radius: 0px;position:relative"> </div>
       <!-- <div class="gora">

            <div class='container-fluid'>
                <div class="col-md-1">
                    </div>
                    <div class="col-md-9" >

                        <p style="float:left; font-size:20px"> Baner</p>
                    </div>
            </div> 
        </div>-->
        
<div class="odstep" ></div>

        <nav class="navbar navbar-default navbar-static-top" >
            <div class="container">

                
                    <div class="navbar-header">

                        
                        <div class="menu">
                            <div id="item">Menu</div>
                            <div id="submenu">
                            <a href="http://localhost/HuntingBook/public/huntingbook">Zarejestruj nowe polowanie</a>
                            <a href="http://localhost/HuntingBook/public/show-all">Pokaż wszystkich użytkowników</a>
                            <a href="http://localhost/HuntingBook/public/animal_list">Lista zwierząt</a>
                            <a href="http://localhost/HuntingBook/public/show_huntings_list">Lista polowań</a>
                            <a href="http://localhost/HuntingBook/public">Public</a>
                            <a href="http://localhost/HuntingBook/public/home">Home</a>
                            </div>
                        </div>
                    
                        <div class="menu1"><div id="item1"><a href="{{ url('/') }}">
                            Strona Główna
                        </a></div></div>

                        <div class="menu1"><div id="item1"><a href="{{ url('/show_huntings_list/') }}">
                            Książka Polowań
                        </a></div></div>

                        <div class="menu1"><div id="item1"><a href="{{ url('/show_huntings_list/') }}">
                            Informacje
                        </a></div></div>


                        <div id="time">Czas</div>
                    </div>


                

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <ul class="nav navbar-nav">
                        &nbsp;

                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </nav>
        <div class="odstep" ></div>
        <div class="odstep2" ></div>

        @yield('content')
        <div class="dol" >
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                    Serwis Dzik.pl wszystkie prawa zastrzeżone
                </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ url('js/app.js') }}"></script>

<script>

    $(function()
    {

        $(".menu").mouseenter(function() 
        {
            $("#submenu").show(500);
        });

        $(".menu").mouseleave(function() 
        {
            $("#submenu").hide(500);
        });

    });


</script>
</body>

</html>
