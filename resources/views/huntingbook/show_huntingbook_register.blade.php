@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<div class="col-md-3"> <!-- odstęp po lewej -->
            
</div> 

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Wiadomość</div>
                    <div class="panel-body">Polowanie zostało pomyślnie zarejestrowane
                        <?php
                           echo "</br>";
                           echo "Polowanie zarejestrował użytkownik ".$userid['user_name']."</br>";
                           echo "Numer upoważnienia ".$array['hunting_licensing_number']."</br>";
                           echo "Zarejestrowano dnia ".$array['Start_date']."</br>";
                           echo "Rejon polowania nr. ".$array['hunting_place_id'];
                        ?>
                    </div>
            </div>
         </div>

    </div>
</div>
@endsection