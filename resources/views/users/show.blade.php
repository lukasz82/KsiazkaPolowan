@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                Użytkownik
                @if ($user->id === Auth::id() || Auth::id() == '1')
                <a href=" {{url('/users/' . $user->id .'/edit')}}" class="pull-right"><small>Edytuj</small></a>
                @endif
                </div>
                    <div class="panel-body">
                        <?php 
                            echo '<h2><a href=';
                        ?>
                            {{ url('/users/' . $user->id) }}
                            <?php
                            echo '>'.$user->name.'</a></h2>';
                            ?>
                                <img src="{{ asset('/images/user-avatar/'.$user->id.'/' . '200' . '/' . '100') }}" class="img-responsive">
                            <?php
                            echo '<p>'.$user->email.'</p>';
                            echo '<p>';
                            if ($user->sex == 'm') {
                                echo 'Facet';
                            } else echo 'Kobieta';
                            echo '</p>';
                        ?>
                               
                    </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">PanelTekstowy</div>
                    <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.
                    </div>
            </div>
         </div>

    </div>
</div>
@endsection