@extends('layouts.app')

@section('content')
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-3"> <!-- odstęp po lewej -->
        </div> 
        <div class="col-md-6">
            <div class="panel panel-default">
            <!-- <div class="panel-heading"></div> -->
                <div class='panel-footer style="font-size: 300%"'>Zarejestruj nowe polowanie
                    </br></br>

  <div id="actual_time">czas</div> 
 <script type="text/javascript">document.getElementById("actual_time").innerHTML = Date();</script>

                      <form method="GET" action="{{url('/new_hunting_event')}}"> 
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-1">
                                <label for="uzytkownik">Wyszukaj użytkownika</label>
                                <input type="text" class="form-control" id="search" name="search"> </input>

                                <script>
                                   $('#search').on('keyup',function()
                                    {
                                        $value = $(this).val();
                                        $.ajax
                                        ({
                                            type : 'get',
                                            url  : '{{URL::to('Show_Users')}}',
                                            data : {'search':$value},
                                            success:function(data)
                                            {
                                                //console.log(data);
                                                $('#wynik').html(data);
                                            }
                                         });
                                    })
                                </script>

                                </br>
                            </div>
                            <div class="col-sm-6 col-sm-offset-0">
                                <label for="uzytkownik">Użytkownik rejestrujący polowanieb</label>
                                </br>                                           
                                <div id="wynik">
                                    <select class="form-control" id="uzytkownik" name="user_name">
                                        <?php

                                        $wielkosc = count($users);
                                            for ($i = 0; $i < $wielkosc; $i++)
                                                {
                                                     echo '<option value="'.$users[$i]->id.'">'.$users[$i]->name.'</option>';
                                                                          
                                                } 
                                            ?>
                                    </select> 
                                </div>
                            </div>
                        </div>

                        </br>
                        <div class="row"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                    <label for="">Numer upoważnienia do wykonywania polowania</label>
                                    <!--  -->
                                    <input type="text" name="hunting_licensing_number" class="form-control" pattern="[0-9]{3}/[0-9]{2}/[0-9]{2}" placeholder="000/00/00" required>
                                </div>
                            </div>
                        </div>

                        </br>
                        <div class="row"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                    <label for="">Mijesce polowania</label>
                                    <!-- [0-9] można wpisać tylko cyfry od 0 do 9, {1,2,3} można wpisać tylko 1, 2 lub 3 cyfry nie mniej nie więcej -->
                                    <input type="text" name="hunting_place_id" class="form-control" pattern="[0-9]{3}" placeholder="000" required>
                                    <!-- na komórce jest problem (pewnie przez przeglądarke, że nie da się ustalić wyboru różnego zakresu wpisywanych liczb, na ten moment ustawiłem że muszą być 3 cyfry)
                                    <!--<input type="text" name="hunting_place_id" class="form-control" pattern="[0-9]{1,2,3}" placeholder="000" required>-->
                                </div>
                            </div>
                        </div>

                        </br>
                        <div class="row"> 
                            <div class="col-sm-5 col-sm-offset-1">
                                <div class="form-group">
                                    <label for="">Data rozpoczęcia polowania</label>
                                    <input id="dat" type="datetime-local" name="Start_date" min="2017-01-01" max="2100-01-01" class="form-control" >

                                    
                                </div>
                            </div>

                            <div class="col-sm-5 col-sm-offset-0">
                                <div class="form-group">
                                    <label for="">Data zakończenia polowania </label>
                                    <input id="dat2" type="datetime-local" name="End_date" min="2017-01-01" max="2100-01-01" class="form-control">
                                </div>
                            </div>
                        </div>


                        </br>
                        <div class="row"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <div id="message_date"></div>
                                <div id="data_message"></div>
                                <div id="d1"></div>
                                <div id="d2"></div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $('#dat').on('keyup',function()
                            //$(function()
                            {
                                var data = $("#dat").val();
                                var data_1 = data.replace(/[^0-9\.]+/g, ""); // usuwa wszystkie znaki prócz cyfr
                            });

                            $('#dat2').on('keyup',function()
                            //$(function()
                            {
                                var data = $("#dat").val();
                                var data_1 = data.replace(/[^0-9\.]+/g, "");
                                var data2 = $("#dat2").val();
                                var data_2 = data2.replace(/[^0-9\.]+/g, ""); 

                                $('#d1').html(data_1);
                                $('#d2').html(data_2);
                                
                                if ( data_1 >= data_2 )
                                {
                                    $('#message_date').html("Data rozpoczęcia jest później niż zakończenia, Popraw date!!!");
                                } else if ( data_1 < data_2 )
                                {
                                    $('#message_date').html("Data jest poprawna");

                                    $.ajax
                                    ({
                                        type : 'get',
                                        url  : '{{URL::to('Check_Date')}}',
                                        data : {'data1':data, 'data2':data2},
                                        success:function(data22)
                                        {
                                            console.log(data22);
                                            $('#data_message').html(data22);
                                        }
                                     });
                                }
                            });
                         </script>

                        </br>
                        <div class="row"> 
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="form-group">
                                    <label for="uzytkownik">Wyszukaj</label>
                                    <input type="text" class="form-control" id="search2" name="search2"> </input>
                                    <script>
                                       $('#search2').on('keyup',function()
                                        {
                                            $value = $(this).val();
                                            $.ajax
                                            ({
                                                type : 'get',
                                                url  : '{{URL::to('Show_Users')}}',
                                                data : {'search2':$value},
                                                success:function(data)
                                                {
                                                    //console.log(data);
                                                    $('#wynik2').html(data);
                                                }
                                             });
                                        })
                                    </script>
                                </div>
                            </div>
                            <div class="col-sm-6 col-sm-offset-0">
                                <div class="form-group">
                                    <label for="">Podpis przed polowaniem</label>
                                    <div id="wynik2">
                                        <select class="form-control" id="signature_start" name="signature_start">
                                            <?php
                                            $wielkosc = count($users);
                                                for ($i = 0; $i < $wielkosc; $i++)
                                                    {
                                                        echo '<option value="'.$users[$i]->id.'">'.$users[$i]->name.'</option>';
                                                    }
                                            ?>
                                                
                                        </select> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <button type="submit" class="btn btn-primary btn-sm pull-right" >Zarejestruj nowe polowanie</button>
                            </div>
                        </div>
                        </form>
                    </div>
            </div>
         </div>

    </div>
</div>
@endsection