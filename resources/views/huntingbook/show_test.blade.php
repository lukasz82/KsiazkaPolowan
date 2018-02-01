@extends('layouts.app')

@section('content')

<div class="panel-heading panel-custom-kolor"><h4><p class="czarny-noformat">Książka polowań</p></h4></div>
<div class="col-md-1">
</div>
<div class="col-md-10" >
 <div class='rg-container'>
    <div class='rg-content'>


				{{ $wynik->links() }}
				</br>
                 @foreach ($wynik as $wynikos)
                 {{ $wynikos->Id }}
                 
                 </br>
                @endforeach
{{ $user[1]->name }}

<?php

for ($i = 0; $i < count($wynik); $i++)
{

	echo $wynik[$i]->Id;
	echo $user[$i]->name;
	echo '</br>';
}

?>

    </div>
</div>
</div>










@endsection