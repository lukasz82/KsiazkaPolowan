<!-- <?php 
//namespace App\Library;
//echo ZmienneGlobalne::Zwroc();
//echo ZmienneGlobalne::zmiennaglobalna;

?>  -->
<?php
//use Sesion;
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">



        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">DODAJ UPOLOWANE ZWIERZĘ</div>

                <div class="panel-body">
                <?php
                 $currentPage = Session::get('page_number');
                           
                           
                            ?>
                            
                            <form method="GET" action="{{ url('/HuntedAnimalsAdd') }}">

                            <div class="row"> 
                                <div class="col-sm-8 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="">Upolowane zwierze</label>
                                            <select class="form-control" id="animal_name" name="animal_name">
                                                <?php
                                                $wielkosc = count($animals);
                                                    for ($i = 0; $i < $wielkosc; $i++)
                                                        {
                                                            echo '<option value="'.$animals[$i]->Id.'">'.$animals[$i]->kind.'</option>';
                                                        }
                                                ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-sm-8 col-sm-offset-1">
                            <div class="form-group">
                                <label for="sex" class="col-md-4 control-label">Płeć</label>
                                   
                                        <select class="form-control" id="sex" type="text" class="form-control" name="sex">
                                            <option value="f">Żeńska</option>
                                            <option value="m">Męska</option>
                                        </select>
                                    </div>
                            </div>
                            </div>

                            <div class="row"> 
                                <div class="col-sm-8 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="pwd">Ilość</label>
                                        <input type="number" min="1" max="9999" class="form-control" id="animals_count" name="animals_count" required placeholder="1"> <!-- name="animals_count" to jest przekazywane do 
                                        request -->                                       
                                    </div>
                                </div>
                            </div>

                           

                            <div class="row"> 
                                <div class="col-sm-8 col-sm-offset-1">
                                    <button type="submit" class="btn btn-default">Dodaj zwierzę do listy</button>
                                </div>
                            </div>
                            
                            </form>
                            <?php
                            //Session::put('page_number', $list->currentPage());
                            echo '</br>';
                            echo '<a href="http://localhost/HuntingBook/public/show_huntings_list?page='.$currentPage.'">Powróć do poprzedniej strony</a></br>';
                            ?>

                </div>
            </div>
        </div>



        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">TABELA UPOLOWANYCH ZWIERZĄT</div>

                <div class="panel-body">
                        <?php
                        
                            $id = Session::get('kind_id');
                            $co = Session::get('animals_count');
                            //$sh = Session::get('shots');
                            $sx = Session::get('sex');
                            $wi = count($id);
                            echo 'wi = ' .$wi;
                            echo '</br>';
                            //echo $id[0];
                            //echo $id[1];
                            //echo $id[2];
                            if ($wi > 0)
                            {
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text data-title="text">Nazwa upolowanej zwierzyny</th>
                                        <th class="text data-title="text">Ilość upolowanej zwierzyny</th>
                                        <!-- <th class="text data-title="text">Ilość strzałów</th> -->
                                        <th class="text data-title="text">Płeć upolowanej zwierzyny</th>
                                        <th class="text data-title="text">Opcje</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <div class="container">



                            <?php 

                            $variable = Session::get("kind_id");
                            print_r(array_keys($variable));
                            $indexes = array_keys($variable);
                            for ($i=0; $i < count($indexes); $i++) 
                            { 
                                if ($i==0) echo '</br>';
                                echo 'index $i='.$i.' : '.$indexes[$i].'</br>';
                            }
                            

                                for ($i = 0; $i < $wi; $i++)
                                {
                                    //if($i != $indexes[$i]) 
                                    //{
                                    //    $i++;
                                    //}

                                    //echo 'id '.$animals[$i]->kind.' ilosc '.$co[$i];
                                    ?>
                                    
                                          <tr class=''>
                                            <td td class="text data-title="text">{{$indexes[$i] }} {{$i}} {{ $animals[$id[$indexes[$i]]-1]->kind }}</td>
                                            <td td class="text data-title="text">{{ $co[$indexes[$i]] }}</td>
                                            <!--  <td td class="text data-title="text"> -->
                                            <?php  //$sh[$i] ?>
                                            <!-- </td> -->
                                            <td td class="text data-title="text">{{ $sx[$indexes[$i]] }}</td>
                                            <td td class="text data-title="text">
                                                <form method="GET" action="{{ url('/HuntedAnimalsDelete/'.$indexes[$i]) }}">
                                                    <button type="submit" class="btn btn-default">Usuń</button>
                                                </form>
                                            </td>
                                          </tr>

                                    <?php
                                }

                                ?>
                                    </tbody>
                            </table>
                                </div>
                                <?php
                            }
                            ?>
                            

                            <form method="GET" action="{{ url('/HuntedAnimalsAddToDB') }}">

                            <div class="row"> 
                                <div class="col-sm-8 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="pwd">Ilość Strzałów</label>
                                        <input type="number" min="1" max="9999" class="form-control" id="shots" name="shots" required placeholder="1">
                                    </div>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-sm-4 col-sm-offset-4">
                                    <button type="submit" class="btn btn-default">Zatwierdź (Koniec Polowania)</button>
                                    </br>
                                </div>
                            </div>
                            
                            </form>

                            <div class="row"> 
                                <div class="col-sm-4 col-sm-offset-4">
                                    </br></br>
                                </div>
                            </div>

                </div>
            </div>


</tbody></table></div>
    </div>
</div>
@endsection