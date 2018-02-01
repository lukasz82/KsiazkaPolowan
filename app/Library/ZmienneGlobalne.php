<?php

//namespace HuntingBook\Http\Controllers;

//use Illuminate\Http\Request;

//namespace HuntingBook\Providers;

//use Carbon;
//namespace Library;
namespace HuntingBook\Library;
class ZmienneGlobalne// extends Controller
{

    public static $zmiennaglobalna = 0;
    public static function Przypisz($i)
    {
    	//$zmiennaglobalna = $i;
    	//ZmienneGlobalne::zmiennaglobalna = $i;
    	self::$zmiennaglobalna = $i;
    }

    public static function Zwroc()
    {
    	return self::$zmiennaglobalna;
    }
}
