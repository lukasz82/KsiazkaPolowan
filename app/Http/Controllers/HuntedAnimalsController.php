<?php

namespace HuntingBook\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // klasa autoryzacji, potrzebna do sprawdzania czy użytkownik jest zalogowany
class HuntedAnimalsController extends Controller
{
    public function Add(Request $request) 
    {

        // Będę sprawdzał czy użytkownik nie dodał czasami 
        $id = Session::get('kind_id');
        $wi = count($id);
        
        if ($wi > 0)
        {
            $key = array_search($request->animal_name,$id); // $klucz = 2;
            if ($key == $request->animal_name)
            {
                return 'key: '.$key.'req '.$request->animal_name;
            }
        }

        if ($request->back != "back")
        {
        	Session::push('kind_id', $request->animal_name);
        	Session::push('animals_count', $request->animals_count);
        	//Session::push('shots', $request->shots);
        	Session::push('sex', $request->sex);
          
        }

        $animals = DB::select('select * from list_of_animals');
        return view('huntingbook/show_add_hunted_animals', compact('animals'));
    }


    public function Delete(Request $request, $id) 
    {
    	$index = $id;

    	Session::forget('kind_id.'.$index);
    	Session::forget('animals_count.'.$index);
    	Session::forget('sex.'.$index);

    	$animals = DB::select('select * from list_of_animals');

    	return view('huntingbook/show_add_hunted_animals', compact('animals'));
    }

    public function ReturnDB($hunt_id) // pobieram index polowania i zapisuje w sesji pod tą smą nazwą
    {

       if (Auth::id() == null)
       {
         return "Nie masz uprawnień do tej strony";
       } else {
        	Session::put('hunt_id', $hunt_id);
        	$animals = DB::select('select * from list_of_animals' );


    		if(Session::has('kind_id')) 
    		{
        		Session::forget('kind_id'); 
    		} else {
        		Session::set('kind_id', array());
    		}

    		if(Session::has('animals_count')) 
    		{
        		Session::forget('animals_count'); 
    		} else {
        		Session::set('animals_count', array());
    		}

    		/*
    		if(Session::has('shots')) 
    		{
        		Session::forget('shots'); 
    		} else {
        		Session::set('shots', array());
    		}
    		*/

    		if(Session::has('sex')) 
    		{
        		Session::forget('sex'); 
    		} else {
        		Session::set('sex', array());
    		}
        	
        	return view('huntingbook/show_add_hunted_animals', compact('animals'));
        }
    } 

    public function AddToDB(Request $request) 
    {
    	$hunt_id = Session::get('hunt_id');
                        
        $id = Session::get('kind_id');
        $wi = count($id);

        // Sprawdzam czy tablica w sesji nie jest pusta
        if ($wi == 0)
        {
            //return "tablica jest pusta";
            return redirect('/Tab_Alert');
            //return Redirect::back()->withErrors(['msg', 'Ilość sstrzałów jest mniejsza od ilości upolowanych zwierząt']);
        }

        $co = Session::get('animals_count');
        //$sh = Session::get('shots');
        $sh = $request->shots;
        $sx = Session::get('sex');
        
        $indexes = array_keys($id);
        $animals_c = 0;

        for ($i = 0; $i < count($co); $i++)
        {
            $animals_c = $animals_c + $co[$i];
        }

        if ($sh < $animals_c)
        {
            return redirect('/Shot_Alert');
            //return Redirect::back()->withErrors(['msg', 'Ilość sstrzałów jest mniejsza od ilości upolowanych zwierząt']);
        }

        if ($wi > 0)
        {
			for ($i = 0; $i < $wi; $i++)
            {
				$id[$indexes[$i]];
                $co[$indexes[$i]];
                //$sh[$i];
                $sx[$indexes[$i]];        
                DB::table('hunted_animals')->insert(
        			[
        			 'hunting_id' => $hunt_id, 
        			 'kind_id' => $id[$indexes[$i]], 
        			 'quantity' => $co[$indexes[$i]], 
        			 'animal_sex' => $sx[$indexes[$i]]
        			]
        		);

            }
            $user_end = DB::table('hunting_book')->where('Id', $hunt_id)->first();
            DB::table('hunting_book')->where('Id', $hunt_id)->update(array('signature_end_user_id' => $user_end->signature_start_user_id, 'number_of_shots' => $sh));
        }

		$currentPage = Session::get('page_number');
    	//return redirect('/show_huntings_list');
        return redirect('/show_huntings_list?page='.$currentPage.'');
    }


    public function Shot_Alert() 
    {

        return view('huntingbook/shots_alert');
    }

    public function Tab_Alert() 
    {

        return view('huntingbook/tab_alert');
    }


    public function Show($hunt_id) 
    {
    	$list = DB::table('hunted_animals')
            ->leftJoin('list_of_animals', 'hunted_animals.kind_id', '=', 'list_of_animals.Id')
            ->where('hunting_id', $hunt_id)
            ->get();

        //Wersja dla php
        //return view('huntingbook/show_hunted_animals', ['list' => $list]);

        // wersja dla ajaxa
        $result = ""; // ja pierdole!!! pół dnia straciłem bo nie zainicjowałem zmiennej, głupie php!!!, niech żyje c++! ;d
        $result.='<table width="300px" bgcolor="#E8FFF7">';
        $result.='<thead><tr">';
        $result.='<th class="text" width="150px">Nazwa</th><th class="text" width="75px">Ilość</th><th class="text" width="75px">Płeć</th></tr></thead>';
 
        foreach ($list as $key => $huntdata) 
        {           
            $result.='<tr bgcolor="#FFFFFF"><td >'.$huntdata->kind.'</td>';
            $result.='<td>'.$huntdata->quantity.'</td>';
            if ($huntdata->animal_sex == 'm') $result.='<td>Męska</td>';
            if ($huntdata->animal_sex == 'f') $result.='<td>Żeńska</td></tr>';
        }
        $result.='</table>';

        
        //return response($result);
        return response()->json
        ([
            'lista' => $list,
            'tabela' => $result
        ]);
        
    }

}
