<?php

namespace HuntingBook\Http\Controllers;

use Illuminate\Http\Request;
use HuntingBook\User;

use Illuminate\Support\Facades\DB;
use HuntingBook\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function User_Avatar($user_id, $img_size, $img_quality)
    {
		/*$img = (json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large); // świetna funkcja file_get_contents - pobiera zawartość tekstową strony 
		// json_decode robi z obiektu tablice
		// var_dump - odczytuje całą tablice

		return $img;
		*/
		if ($img_size < 1) {
    		$img_size = 100;
    	}

    	if ($img_quality < 1 || $img_quality > 100) {
    		$img_quality = 100;
    	}

		$user = User::FindOrFail($user_id);

		if (is_null($user->avatar)) {
			$empty_img = 'https://cdn0.iconfinder.com/data/icons/user-pictures/100/unknown2-128.png';
			$img = Image::make($empty_img)->fit($img_size)->response('jpg', $img_quality);
			return $img;
			exit;
		}

		if (strpos($user->avatar, 'http') !== false) {
			$img = Image::make($user->avatar)->fit($img_size)->response('jpg', $img_quality);
		} else {

    	//$img = Image::make('public/users/' . $user_id . '/avatars' . $user->avatar);
    	//$img = Image::make('storage/app/public/users/' . $user_id . '/avatars/' . $user->avatar);
    	//$avatar_path = 'storage/app/public/users/' . $user_id . '/avatars/' . $user->avatar;
    	$avatar_path = asset('storage/users/' . $user_id . '/avatars/'. $user->avatar);
    	$img = Image::make($avatar_path)->fit($img_size)->response('jpg', $img_quality);
    	//$img = Image::make('app/public/users/' . $user_id . '/avatars/' . $user->avatar);
		}
    	return $img;
    }

}
