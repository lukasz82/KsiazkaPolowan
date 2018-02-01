<?php 

/* Wykorzystanie mojej własnej klasy, pamiętać żeby w composer.json zarejestrować klase
namespace App\Library;
echo $list->currentPage();
ZmienneGlobalne::Przypisz($list->currentPage());
echo ZmienneGlobalne::Zwroc();
//echo ZmienneGlobalne::zmiennaglobalna;
*/

Session::put('page_number', $list->currentPage());
//Session::put('singanture_end_user_id', $)
?>  
@extends('layouts.app')

@section('content')
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>


<script>
  $(document).ready(function() { // czeka aż dokument zostanie wczytany
      $("button").click( function() // odczytuje jakiekolwiek kliknięcie jakiegokolwiek przycisku
        {
            var id = $(this).attr('id'); // tworzę nową zmienną, do której przypisuję wartość id z klikniętego przycisku, this jest to po prostu $("button"), żeby nie pisac ileś razy tego samego odwołuje się do "tego" wywołanego obiektu do tablicy :), czyli this ;-]
            var number = $(this).attr('value');
            //var number_only = number.replace("res",'');
            if (id[0] == "e") // jeśli pierwsza literka stringa == e to nie robię nic w ajaxie, bo jest to przycisk końca polowania
            {
                alert('end');
            } else if (id[0] == "b") // jeśi jest to literka "b" to zaczynam zczytywac z bazy dane dotyczące tego konkretnego polowania
            {
                var n = id.replace("butt",''); // zamieniam butt na pustą wartość żeby odczytac i przekazać id polowania
                //$("#blah"+n).hide();
                $.ajax
                ({
                    type : 'get',
                    url  : '{{URL::to('HuntedAnimalsShow')}}' + '/' + n,
                    //data : {'search':$value},
                    success:function(data)
                    {
                        //var len = data.lista.length;
                        //for (i=0; i<len; i++)
                        //{
                        //
                        //}
                        console.log(data.lista.length);
                       // $("#res"+number).toggleClass('active').toggle("slow" ); // ta metoda powoduje, że pierwsze jest ukrywane a później odkrywane
                        $("#res"+number).html(data.tabela).slideToggle( "slow" );
                        //alert(n);
                    }
                });

                // alert(n);
            }

        }
      ).first().click();
});
</script>

<div class='container-fluid'>
    <div class="col-md-1">
    </div>
    <div class="col-md-9" >
        <p style="float:left; font-size:20px"> Książka polowań </p>
    </div>
</div>

<div class='container-fluid'>
    <div class="col-md-1">
    </div>
   
    <div class="col-md-9" >
        <form method="GET" action="{{ url('/huntingbook/') }}"><button type="submit" class="btn btn-default btn-bg" style="width:150px;line-height: 1.6; float:left; background-color: #ffffff; color: #000; margin-top: 22px">Nowe Polowanie</button></form>
        <div class="text-center">{{ $list->links() }}</div><!-- Element ten odpowiada za wyświetlanie stronicowania, takie wbudowane cudo w laravela:) -->
    </div>
</div>

<div class='rg-container'>
    <div class="col-md-1">
    </div>
    <div class="col-md-10" >
           <table class='rg-table zebra' summary='Hed'>
             <thead>
                <tr>
                <th class='text '>Nr. Rejestr.</th>
                <th class='text '>Nazwa użytkownika </br> rejestrującego polowanie</th>           
                <th class='text '>Numer autoryzacji</th>
                <th class='text '>Miejsce polowania</th>
                <th class='text '>Data - poczatek polowania</th>
                <th class='text '>Data - koniec polowania</th>
                <th class='text '>Podpis użytkonika - początek polowania</th>                
                <th class='text '>Podpis użytkonika - koniec polowania</th>
                <th class='text '>Ilość strzałów</th>
                <th class='text '>Stan polowania</th>
                </tr>
            </thead>
            <tbody>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
              
                <?php
                $real_items = 0;
                $real_items = $list->lastItem()-count($list); // liczba (indkesy), która wskazuje ile elementów pozostało do wyświuetlenia
                   
                for ($i = 0; $i < count($list); $i++)
                {
                    ?>

                    <tr class=''>
                    <?php
                    echo '<td class="text data-title="text">'.$list[$i]->Id.'</td>';
                    echo '<td class="text data-title="text">';
                    echo $user[$i+$real_items]->name;
                    echo '</td>';
                    echo '<td class="text data-title="number">'.$list[$i]->hunting_authorization_id.'</td>';
                    echo '<td class="text data-title="text">';
                        echo $list[$i]->place_of_hunting_id;
                    echo '</td>';
                    echo '<td class="text data-title="text">';
                        // obrabiam format daty, żeby godzina nie była obok daty, tylko poniżej, i jeszcze żeby dni były pierwsze, jest to wtedy czytelniejsze
                        $date=date_create($list[$i]->start_date);
                        echo date_format($date,"d/m/Y");
                        echo '</br>';
                        echo date_format($date,"H:i:s");
                    echo '</td>';
                    echo '<td class="text data-title="text">';
                        $date=date_create($list[$i]->end_date);
                        echo date_format($date,"d/m/Y");
                        echo '</br>';
                        echo date_format($date,"H:i:s");
                    echo '</td>';
                    echo '<td class="text data-title="text">'.$usersignaturestart[$i+$real_items]->name.'</td>';
                    
                    if ($list[$i]->signature_end_user_id == null) 
                    {
                        echo '<td class="text data-title="text"> </br></td>';
                    } else {
                        $name_end_signature = DB::table('users')
                        ->select('name')
                        ->where('Id', '=', $list[$i]->signature_end_user_id)
                        ->get();
                        echo '<td class="text data-title="text">'.$name_end_signature[0]->name.'';
                        echo '</td>';
                    }
                    echo '<td class="text data-title="number">';
                    //echo '<div id="flip">Pokaż szczegóły</div>'; // PANEL DOWN
                    echo '<div id="panel">'.$i.'</div>';
                    echo $list[$i]->number_of_shots;
                    echo '</td>';
                    echo'<td class="text data-title="number">';

                    if ($list[$i]->signature_end_user_id == null) 
                    {
                    ?>

                        <!-- <form method="GET" action="{{ url('/Confirm_Ending_Hunt/'. $list[$i]->Id.'') }}"> --> 
                        <!-- powyżej jest stare przekierowanie do po prostu zakończenia polowania, poniżej nowe przekierowanie do wpisywania wyników polowania -->               
                        <form method="GET" action="{{ url('/add_hunted_animals/'. $list[$i]->Id.'') }}">
                        <div class="text-right">
                    <?php
                        
                        echo '<button id="end<?php echo $i?>" type="submit" class="btn btn-info btn-sm" style="width:100px;line-height: 2;background-color: #ffcdd2; color:black;">Zakończ</button></form>';
                    } 

                    if ($list[$i]->signature_end_user_id) 
                    {
                    ?>
                    <!--<form method="GET" action="{{ url('/HuntedAnimalsShow/'. $list[$i]->Id.'') }}">-->
                    <div class="text-right">
                    <?php
                        echo '<div class="text-right">';
                        //echo '<button type="submit" class="btn btn-Default btn-sm" style="width:100px;line-height: 2;"">Szczegóły</button></form>';
                         ?>
                        <button value="<?php echo $i?>" id="butt<?php echo $list[$i]->Id?>" type="submit" class="btn btn-info btn-sm" style="width:100px;line-height: 2;background-color: #dcedc8 ; color:black;"">Szczegóły</button>
                        
                        <?php
                    }
                        echo '</td>';
                        echo '</tr>';
                        // tutaj jest wysyłany wynik z ajaxa po id diva, display none powoduje że pierwsze robi się funkcja show w toogle
                        echo '<tr bgcolor="#E5F3EE"><td colspan="10"><div style="float:right; display:none;" id="res'.$i.'"></div></td></tr>';
                       
                       
                }
                ?>

                    </div>
             </tbody>
        </table>
    </div>
</div>
  

<div class='container-fluid'>
    <div class="col-md-2">
        </div>
           <div class="col-md-8" >
                <div class="text-center">{{ $list->links() }}</div><!-- Element ten odpowiada za wyświetlanie stronicowania, takie wbudowane cudo w laravela:) -->
                </div>
        </div>
@endsection