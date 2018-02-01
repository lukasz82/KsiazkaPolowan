<?php

namespace HuntingBook\Http\Controllers;

use Illuminate\Http\Request;
use HuntingBook\User;

use Illuminate\Support\Facades\DB;
use HuntingBook\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class TestyController extends Controller
{
    public function Show_All_Users()
    {
        $users = DB::select('select * from users');
        $id_zalogowanego = Auth::id();
		return view('huntingbook/show_all', compact('users'), compact('id_zalogowanego'));
    }

    public function Show_All_Animals()
    {
		//$animals = DB::select('select * from list_of_animals');
		//return view('huntingbook/show_all_animals', compact('animals'));
        return view('huntingbook/show_all_animals');
    }

    public function Show_All_AnimalsAjax(Request $r)
    {
        $wynik="";
        if ($r->ajax())
        {
               //$animals = DB::select('select * from list_of_animals');
            $animals = DB::table('list_of_animals')->where('kind', 'LIKE', '%'.$r->search.'%')->get();
            // search to jest odwołanie do javascriptowego serch w show all animals
            // 
        
            //$o = "to jest cos".$animals[0]->name;
            //return response()->json(array('animals'=> $animals), 200);
            if ($animals)
            {
                foreach ($animals as $key => $animal) 
                {
                $wynik.=$animal->kind.'</br>';
                }
            }
            return response($wynik);
        }
    }
}
