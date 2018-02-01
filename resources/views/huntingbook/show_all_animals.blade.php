@extends('layouts.app')

@section('content')



<title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
      

<div class="container">
    <div class="row">

        <div class="col-md-3"> <!-- odstęp po lewej -->
            
</div> 

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">PanelTekstowy</div>
                    <div class="panel-body">
                    <?php
                    /*    $wielkosc = count($animals);
                        for ($i = 0; $i < $wielkosc; $i++)
                        {
                            echo $animals[$i]->kind . ": ";
                            echo $animals[$i]->latin_name;
                            
                        ?>
                        <?php
                        echo '</br>';
                        }
                        */
                    ?>


                    <div id = 'title'>This message will be replaced using Ajax. 
                     Click the button to replace the message.</div>
                     <input type="text" class="form-control" id="search" name="search"> </input>
                    
                    <?php
                    //echo Form::button('Replace Message',['onClick'=>'getMessage()']);
                    ?>

                    </div>

                    <script type="text/javascript">
                        $('#search').on('keyup',function()
                        {
                            $value = $(this).val();
                            $.ajax
                            (
                                {
                                    type : 'get',
                                    url  : '{{URL::to('animal_list_ajax')}}',
                                    data : {'search':$value},
                                    success:function(data)
                                    {
                                        console.log(data);
                                        $('#wynik').html(data);
                                    }
                                }
                            );
                        })

                    </script>
                    
 <div id = 'wynik'></div>

     <div id="nowe_radio"></div>
<script type="text/javascript">

if (document.getElementById("male").checked)
{
    document.getElementById("nowe_radio").innerHTML = 
    '<input type="radio" name="gender" value="male"> Male<br><input type="radio" name="gender" value="female"> Female<br>
    ';
}
    ;
</script>
 <form action="">
  <input type="radio" name="gender" value="male"> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
</form>

            </div>
         </div>

    </div>
</div>
@endsection