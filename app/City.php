<?php

namespace App;

use App\Traits\DatabaseSwitch;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use DatabaseSwitch;

    protected $fillable = [
        "name", "city_slug", "total_jobs", "country", "lat", "lon", "sort_order"
    ];

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
            parent::__construct($attributes);
            $this->setConnection('mysql');
//        }

    }


    public static function save_lat_long(){

        $cities = City::whereRaw('lat IS NULL')->get();

//        dd($cities->name);

        foreach ($cities as $city){


            $queryString = http_build_query([
                'access_key' => 'dad83aaa9b24370cc0fcbb151111e9f7',
                'query' => $city->name,
                'output' => 'json',
                'limit' => 1,
            ]);

            $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $queryString));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($ch);
            curl_close($ch);

            $apiResult = json_decode($json, true);
//            dd($apiResult['data'][0]);
            if(!empty($apiResult['data'][0])){
//                dd($apiResult);

                $city->lat = $apiResult['data'][0]['latitude'];
                $city->lon = $apiResult['data'][0]['longitude'];
            }
            $city->city_slug = str_replace(" ","-", strtolower($city->name));
            $city->save();
//            echo str_replace(" ","-", strtolower($city->name)) .' - ';

        }


//QUERY TO GET NEARBY LOCATIONS BASED ON LAT LON
//        52 is LAT --- -1 is long

//        SELECT
//id,
//(
//    3959 *
//    acos(cos(radians(52)) *
//        cos(radians(lat)) *
//        cos(radians(lon) -
//            radians(-1)) +
//        sin(radians(52)) *
//        sin(radians(lat )))
//) AS distance
//FROM cities
//HAVING distance <= 10
//ORDER BY distance LIMIT 0, 20;



    }
}
