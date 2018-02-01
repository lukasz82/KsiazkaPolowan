@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-2">

        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">PanelTekstowy</div>
                    <div class="panel-body">
                    
                    Za mało strzałów w stosunku do zwierzyny!

                         <form method="GET" action="{{ url('/HuntedAnimalsAdd/') }}">
                            <input type="hidden" class="form-control" id="back" name="back" value="back">
                            <button> Powróć</button>
                        </form>

                    </div>
            </div>
         </div>

    </div>
</div>
@endsection