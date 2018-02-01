@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3"> <!-- odstęp po lewej -->
            
</div> 

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Upolowana zwierzyna w polowaniu nr {{ $list[0]->hunting_id }}</h3></div>
                    <div class="panel-body">


                         <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th class="text data-title="text">Nazwa</th>
                                        <th class="text data-title="text">Ilość</th>
                                        <th class="text data-title="text">Płeć upolowanej zwierzyny</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                <div class="container">



                    <?php
                    $currentPage = Session::get('page_number');
                         $wielkosc = count($list);


                        for ($i = 0; $i < $wielkosc; $i++)
                        {
                        ?>
                        <tr class=''>
                            
                            <td td class="text data-title="text">{{ $list[$i]->kind }}</td>
                            <td td class="text data-title="text">{{ $list[$i]->quantity }}</td>
                            <td td class="text data-title="text">{{ $list[$i]->animal_sex }}</td>
                        </tr>

                        <?php
                        
                        }

                        ?>
                        </tbody>
                        </table>
                        <?php

                        echo '</br>';
                        echo '<a href="http://localhost/HuntingBook/public/show_huntings_list?page='.$currentPage.'">Powróć do poprzedniej strony</a></br>';
                    ?>
                    </div>
            </div>
         </div>

    </div>
</div>
@endsection