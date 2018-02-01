@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Jesteś zalogowany
                    </br></br>
                    <a href="http://localhost/HuntingBook/public/huntingbook">Zarejestruj nowe polowanie</a></br>
                    <a href="http://localhost/HuntingBook/public/show-all">Pokaż wszystkich użytkowników</a></br>
                    <a href="http://localhost/HuntingBook/public/animal_list">Lista zwierząt</a></br>
                    </br>
                    <a href="http://localhost/HuntingBook/public/show_huntings_list">Lista polowań</a></br>
                    </br>
                    <a href="http://localhost/HuntingBook/public">Public</a></br>
                    </br>
                    <a href="http://localhost/HuntingBook/public/home">Home</a></br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
