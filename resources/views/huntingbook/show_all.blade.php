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
                    <?php
                   $wielkosc = count($users);
                        for ($i = 0; $i < $wielkosc; $i++)
                        {
                            echo $users[$i]->name;
                            
                        ?>
                            <a href=" {{url('/users/' . $users[$i]->id .'/edit')}}"><small>Edytuj</small></a>
                        <?php
                        echo '</br>';
                        }

                        echo $id_zalogowanego;
                        
                    ?>
                    </div>
            </div>
         </div>

    </div>
</div>
@endsection