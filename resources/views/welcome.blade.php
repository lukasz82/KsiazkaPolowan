
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Witamy w serwisie Dzik.pl</div>
                     <div class="panel-body">
        

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <p>Jesteś zalogowany, możesz zobaczyć moduły</p>
                    @else
                        Nie możesz zobaczyć modułów ponieważ nie jesteś zalogowany, proszę się zalogować!
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Tutaj będziemy wyświtlać moduły systemu.</br></br>
                </div>

               
                    <div class="container">
                         <div class="i-am-centered">
                    <div class="row">
                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-0" style="background-color: #880e4f ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Książka Polowań
                        </div>
                    </a>


                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-1" style="background-color: #4a148c ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Mapa
                        </div>
                    </a>

                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-1" style="background-color: #827717 ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Pogoda
                        </div>
                    </a>

                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-1" style="background-color: #e65100 ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Magazyn
                        </div>
                    </a>

                    </div>
                    <div class="row">
               
                
                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-0" style="background-color: #8080ff ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Książka Polowań
                        </div>
                    </a>

                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-1" style="background-color: #00802b ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Mapa
                        </div>
                    </a>

                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-1" style="background-color: #b366ff ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Pogoda
                        </div>
                    </a>

                    <a href="{{ url('/show_huntings_list/') }}">
                        <div class="col-md-2 col-md-offset-1" style="background-color: #b30000 ; height: 100px; width: 150px; color:white; text-align: center; vertical-align: middle;  display: table; display: table-cell;padding: 20px; margin: 20px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-size: 20px;border-radius: 10px">Magazyn
                        </div>
                    </a>
                    </div>

                </div>
            </div>
        </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
