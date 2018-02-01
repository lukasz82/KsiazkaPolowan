<?php

namespace HuntingBook\Http\Controllers;

use Illuminate\Http\Request;
use HuntingBook\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);
        return view('users.show', compact('user')); // mój dopisek : przekazuje dane z modelu do widoku poprzez kontroler
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* ---- TO JEST DOBRY BLOK 
        $userek = User::find($id); // tworze sobie obiekt ktory odwoluje sie do uzytkownika
        if (intval($id) !== Auth::id() && $userek->id != '1') 
        {
            echo Auth::id();
            abort(403, 'Brak dostępu');

        } 

        if (intval($id) === Auth::id() || $userek->id == '1')
        {
            //echo Auth::id();
            $user = Auth::user();
            return view('users.edit', compact('user'));
        }
        */

        $userek = User::find($id); // tworze sobie obiekt ktory odwoluje sie do uzytkownika
        if (intval($id) !== Auth::id() && Auth::id() != '1') 
        // jesli jest zalogowany prawidłowy użytkownik i nie ma mieć dostępu do innych użytkowników

        //ogólnie sprawdziłem i ta metoda działa, admin może edytować wszystkich, wszyscy tylko siebie

        {
            echo Auth::id();
            abort(403, 'Brak dostępu');

        } 

        if (intval($id) === Auth::id())
            // jeśli jest zalogowany prawidłowy użytkownik, który ma mieć dostep tylko do swojej edycji
        {
            //echo Auth::id();
            $user = Auth::user();
            return view('users.edit', compact('user'));
        }


        if (intval($id) != Auth::id() && Auth::id() == '1')
        {
            // jeśli jest zalogowany admin i ma mieć dostęp do wszystkich edycji
            //echo Auth::id();
            $user = User::find($id);
            return view('users.edit', compact('user'));
        }

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
        //$user = User::find($id);
        //return $user->name;

        $userek = User::find($id); // tworze sobie obiekt ktory odwoluje sie do uzytkownika
        if (intval($id) !== Auth::id() && $userek->id != '1') 
        {
            echo Auth::id().'jestem w update';
            abort(403, 'Brak dostępu');

        } 

        if (intval($id) === Auth::id() || $userek->id == '1') // coś nie działa do poprawy, tzn gdy jest zalogowany admin odmawia edycji innych użytkowników
        {
            $this->validate($request, 
                [
                    'name' => 'required|min:3',
                    'email' => 
                    [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($id), // odwołanie sie do bazy danych do tabeli users - sprawdza czy pola w tabeli istnieja a wykorzystuje to do sprawdzenia czy taki email istnieje
                    ]
                ]
                ,
                [
                    'required' => 'Pole jest wymagane',
                    'min' => 'Wymagane jest wpisanie conajmniej 3 znaków',
                    'email' => 'Dane muszą być w formacie email np. nazwa@domena.pl',
                    'unique' => 'Ten email już istnieje'
                ]
            );
 
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->sex = $request->sex;

            if ($request->file('avatar')) 
            {
                $user_avatar_path = 'public/users/' . $id . '/avatars';
                $upload_path = $request->file('avatar')->store($user_avatar_path);
                $avatar_filename =  str_replace($user_avatar_path. '/', '' , $upload_path);
                $user->avatar = $avatar_filename;
            }

            $user->save();
            //return back();          

            return view('users.edit', compact('user'));
        }

        
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
