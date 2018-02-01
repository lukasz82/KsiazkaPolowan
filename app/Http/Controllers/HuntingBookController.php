<?php

namespace HuntingBook\Http\Controllers;

use Illuminate\Http\Request;
use HuntingBook\User;


use Illuminate\Support\Facades\DB;
use HuntingBook\Http\Controllers\Controller;

use Amamarul\Paginator\Paginator;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth; // klasa autoryzacji, potrzebna do sprawdzania czy użytkownik jest zalogowany

class HuntingBookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::id() == null)
        {
         return "Nie masz uprawnień do tej strony";
        } else 
        {
            $users = DB::select('select * from users ORDER BY users.name' );
            return view('huntingbook/show_huntingbook', compact('users'));
        }
    }

    public function Show_Users(Request $r)
    {
        $result = "";

        if ($r->ajax())
        {   
            if ($r->search) // dla optionsa pierwszego
            {            
                $users = DB::table('users')->where('name', 'LIKE', '%'.$r->search.'%')->get();
                $result ='<select class="form-control" id="uzytkownik" name="user_name">';
            }

            if ($r->search2) // dla optionsa drugiego
            {
                $users = DB::table('users')->where('name', 'LIKE', '%'.$r->search2.'%')->get();
                $result ='<select class="form-control" id="signature_start" name="signature_start">';
            }
            //$result ='<select class="form-control" id="uzytkownik" name="user_name">';
            $count = 0;
            $c = count($users);
            foreach ($users as $key => $user) 
            {
                if ($count == 0) // zaznaczam domyślnie wybraną opcję pierwszą z listy, w celu uniknięcia błędu nie wybrania z listy żadnej opcji
                {
                    $result.='<option selected value="'.$user->id.'">'.$user->name.'</option>';
                }


                if ($count > 0) // bez zaznaczania domyślnej opcji
                {
                    $result.='<option value="'.$user->id.'">'.$user->name.'</option>';
                }

                $count++;

                if ($count > 5) // ogranicza ilość wyników do 5
                {
                    $result.='</select>';
                    return response($result);
                    exit;
                }

            }
            
        $result.='</select>';
        return response($result);
        }

    }


    public function Check_Date(Request $r)
    {
        $result2 = "";


        if ($r->ajax())
        {               
            //$date = DB::select('SELECT start_date, end_date FROM hunting_book');
            $x = $r->data1.":00";
            $y = $r->data2.":00";
            $x[10] = " ";
            $y[10] = " ";
            $date = DB::select("SELECT start_date, end_date FROM hunting_book WHERE 
                (start_date <= '$x' AND end_date >= '$y') OR 
                (start_date >= '$x' AND end_date <= '$y') OR
                (start_date <= '$x' AND end_date <= '$y' AND end_date > '$x') OR
                (start_date >= '$x' AND end_date >= '$y' AND start_date < '$y')
                ORDER BY start_date
                "); // wybieram przedział dat od do i zwracam w celu sprawdzenia czy nie ma zajętego terminu
            $count = 0;

            $result2 ='W tym okresie zajęte sa następujące terminy: </br><table class="rg-table zebra">';
            foreach ($date as $key => $dat) 
            {
                //$result2.="<tr><td>".$dat->start_date."</td><td>".$dat->end_date."</td><td> data1: ".$x."y: ".$y."</td></tr>";
                $result2.="<tr><td>".$dat->start_date."</td><td>".$dat->end_date."</td></tr>";
               //$result2.='<tr><td>'.$dat->start_date.'</td><td>'.$dat->end_date.'</td></tr>';
                if ($count > 6)
                {
                    $result2.='</table>';
                    return response($result2);
                    exit;

                }
                $count++;
            }
            $result2.='</table>';
        
        }
        return response($result2);
    }


    public function create_event(Request $request) // request pobiera dane z formularzy, z wczesniejszej strony odpowiednio odwołując się do nazw poszczególnych pól
    {
        $date = DB::select("SELECT start_date, end_date FROM hunting_book WHERE 
            (start_date <= '$request->Start_date' AND end_date >= '$request->End_date') OR 
            (start_date >= '$request->Start_date' AND end_date <= '$request->End_date') OR
            (start_date <= '$request->Start_date' AND end_date <= '$request->End_date' AND end_date > '$request->Start_date') OR
            (start_date >= '$request->End_date' AND end_date >= '$request->End_date' AND start_date < '$request->Start_date')
            ");

        if (count($date) > 0)
        {
            return "W wybranym terminie są już zarezerwowane polowania";
        } else if (count($date) == 0)
        {
           $array = array
                (
                    'user_name' => $request->user_name,
                    'hunting_licensing_number' => $request->hunting_licensing_number,
                    'Start_date' => $request->Start_date, 
                    'hunting_place_id' => $request->hunting_place_id 
                );

            //DB::insert('insert into hunting_book (user_id, hunting_authorization,place_of_hunting_id,start_date,signature_start_user_id) values (?, ?)', array(user_name, 'Dayle'));
            $id = $request->user_name;
            DB::table('hunting_book')->insert(
            ['user_id' => $request->user_name, 'hunting_authorization_id' => $request->hunting_licensing_number, 'place_of_hunting_id' => $request->hunting_place_id, 'start_date' => $request->Start_date, 'end_date' => $request->End_date, 'signature_start_user_id' => $request->signature_start]
            );
            $userid = array
                (
                    'user_name' => $request->user_name,
                );
            return view('huntingbook/show_huntingbook_register', compact('array'), compact('userid')); // zwracam widok do którego jednocześnie przekazuję tablicę do której w tym widoku będę mógł się odwołać 
        }
    }


    public function Confirm_Ending_Hunt($hunt_id) // potwierdzenie polowania
    {

        // $user_end = DB::select('select signature_start_user_id from hunting_book where Id = '.$hunt_id.'');
        $user_end = DB::table('hunting_book')->where('Id', $hunt_id)->first();
        //echo $user_end->signature_start_user_id;
        //echo '</br>';
        //echo $hunt_id;
        DB::table('hunting_book')->where('Id', $hunt_id)->update(array('signature_end_user_id' => $user_end->signature_start_user_id));
        // return redirect()->action('HuntingBookController@show_huntings_list');
        return redirect()->back(); // Ahhh!!! zajebista funkcja, zamiast pamiętać numer strony, na której byłem, przekierowuje mnie z powrotem, nie muszę się męczyć w zapamiętywanie i kombinowanie z powrotem na stronę na której byłem

    }


    public function show_huntings_list() // wyswietla listę polowań
    {

       if (Auth::id() == null)
       {
         return "Nie masz uprawnień do tej strony";
       } else {
            $list = DB::table('hunting_book')->orderBy('Id', 'desc')->Paginate(8);
            $user = DB::select('select us.name from users us, hunting_book hunt where us.id = hunt.user_id ORDER BY hunt.id DESC' ); // wyszukuje nazwy uzytkownika w hunting_book po "id" i wyświetlam jego nazwę w tabeli
            $usersignaturestart = DB::select('select us.name from users us, hunting_book hunt where us.id = hunt.signature_start_user_id ORDER BY hunt.id DESC'); 
            $usersignatureend = DB::select('select us.name from users us, hunting_book hunt where us.id = hunt.signature_end_user_id ORDER BY hunt.id'); 
            return view('huntingbook/show_huntings_list', ['list' => $list, 'user' => $user, 'usersignaturestart' => $usersignaturestart, 'usersignatureend' => $usersignatureend]);
        }
    }

    // 
    public function add_hunted_animals($hunt_id)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
