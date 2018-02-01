<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; // sam dopisałem używam sobie fakera do losowych danych

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // moje wpisy, uzupełnianie bazy fakera

        $numb_of_usrs = 100; // 20 użytkowników oprócz admina, admin ma i[0]
        $faker = Faker::create('pl_PL');
        $password = '123456';
        //$file_animals = fopen("storage/app/public/animallist/zwierzynalowna.ods", "r");
        $numb_of_hunts = 100;

		for ($i=0; $i <= $numb_of_usrs; $i++) { 

			if ($i == 0) {
				
        		DB::table('users')->insert([
        		'name' => 'admin',
        		'email' => 'admin@admin.pl',
        		'sex' => 'm',
        		'password' => bcrypt('123456'),
        		]);
        		continue;
			} 
			
			$sex = $faker->randomElement($array = array ('m','f')); // sex(płeć) -> m albo k
			
			if ($sex == 'm') {
				$name = $faker->firstNameMale. ' ' . $faker->lastNameMale;
                $avatar = (json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large);
        		DB::table('users')->insert([
        		'name' => $name,
        		'email' => str_replace('-','',str_slug($name)).'@'.$faker->safeEmailDomain,
        		'sex' => $sex,
                'avatar' => $avatar,
        		'password' => bcrypt($password),
        		]);
        	}

			if ($sex == 'f') {
				$name = $faker->firstNameFemale. ' ' . $faker->lastNameFemale;
                $avatar = (json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large); // tworze avatar link do bazy losowy
        		DB::table('users')->insert([
        		'name' => $name,
        		'email' => str_replace('-','',str_slug($name)).'@'.$faker->safeEmailDomain,
        		'sex' => $sex,
                'avatar' => $avatar,
        		'password' => bcrypt($password),
          		]);
        	}
		}

        // Wczytywanie z pliku tekstowego listy zwierząt 
        $file_animals = fopen("storage/app/public/animallist/zwierzynalowna.txt", "r");
        $word1 = null;
        $word2 = null;

        $tabulator = false;
        $enter = false;
        //echo $dlugosc;
        while(!feof($file_animals))
        {
            $sign = fgetc($file_animals);
            if ($sign == "|") $tabulator = true;
            if ($sign == "\n") $enter = true;
            if ($sign != "|" && $tabulator == false && $enter == false) $word1 = $word1.$sign;
            if ($sign != "|" && $tabulator == true && $enter == false) $word2 = $word2.$sign;
            if ($sign != "|" && $tabulator == true && $enter == true) 
            {
                // Wstawiam słowa
                DB::table('list_of_animals')->insert([
                'kind' => $word1,
                'latin_name' => $word2,
                ]);
                $word1 = null;
                $word2 = null;
                $tabulator = false;
                $enter = false;
            }
        }

        // Fejker dla wpisów o polowaniach
        for ($i=0; $i <= $numb_of_hunts; $i++) { 
 
            DB::table('hunting_book')->insert
            ([
            'user_id' => $faker->numberBetween($min = 1, $max = $numb_of_usrs),
            'hunting_authorization_id' => $faker->numberBetween($min = 0, $max = 999).'/'.$faker->numberBetween($min = 0, $max = 99).'/'.$faker->numberBetween($min = 0, $max = 99),
            'place_of_hunting_id' => $faker->numberBetween($min = 0, $max = 999),
            'start_date' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
            'end_date' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
            'signature_start_user_id' => $faker->numberBetween($min = 1, $max = $numb_of_usrs),
            ]);
            
        }


        // Fejker dla nadleśnictw
        for ($i=0; $i <= 30; $i++) 
        { 
            $nazwa = "Nadleśnictwo ";
            $company = $faker->city;
            DB::table('forestry_name')->insert
            ([
            'forestry_name' => $nazwa.$company,
            'city' => $company,
            'postal_code' => $faker->postcode,
            'street_name' => $faker->streetName,
            'street_number' => $faker->numberBetween($min = 1, $max = 999),
            'email' => $company."@gmail.pl",
            'website' => $company.".pl",
            ]);
            
        }



        // Fejker dlaobwodów łowieckich
        for ($i=1; $i <= 30; $i++) 
        { 
            for ($j=1; $j < 100; $j++)
            {
                DB::table('hunting_circut')->insert
                ([
                'hunting_circut_number' => $j,
                'forestry_name_id' => $i,
                ]);
            }   
            
        }




	}
}
