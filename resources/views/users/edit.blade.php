@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edycja użytkownika {{ $user->name }}</div>
                    <div class="panel-body">

                       <img src="{{ asset('/images/user-avatar/'.$user->id.'/' . '200' . '/' . '100') }}" class="img-responsive">

                        <form method="POST" action="{{url('/users/'.$user->id)}}" enctype="multipart/form-data" > <!-- enctype="multipart/form-data" pozwala ładować pliki w formularzu -->
                        {{ csrf_field() }} <!-- pilnuje żeby nieuprawniony użytkownik nie mógł ingerować w stronę-->
                        {{ method_field('PATCH') }}

                        <div class="row"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="">Imię i Nazwisko</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Imię i Nazwisko">

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>

  
                        <div class="row"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" value=" {{ $user->email }}" placeholder="email">

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>b
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <label for="sex">Płeć</label>
                                    <select class="form-control" id="sex" type="text" class="form-control" name="sex">
                                        <option value="f" @if ($user->sex == 'f') selected @endif>Kobieta</option>
                                        <option value="m" @if ($user->sex == 'm') selected @endif>Mężczyzna</option>        
                                    </select>        
                                </div>
                        </div>

                        <!--  upload zdjęć -->
                        <div class="row"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                    <label for="">Zdjęcie</label>
                                    <input type="file" name="avatar" class="form-control"  placeholder="Wybierz plik">

                                    @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                            
                        <div class="row" style="margin-top:20px;"> 
                            <div class="col-sm-10 col-sm-offset-1">
                                <button type="submit" class="btn btn-primary btn-sm pull-right" >Zapisz zmiany</button>
                            </div>
                        </div>

                       

                        </form>


                    </div>
            </div>
         </div>

    </div>
</div>
@endsection