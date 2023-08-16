<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class IncomingRequest extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }
    
    public $table = 'incoming_requests';

    public static function createTable(){

        $tableName = 'incoming_requests';
        if( !Schema::hasTable($tableName) ){
            DB::statement('CREATE TABLE `incoming_requests` (`id` int(11) NOT NULL,`ip` varchar(100) DEFAULT NULL,`country` varchar(100) DEFAULT NULL,`lat` varchar(100) DEFAULT NULL,`zip` varchar(100) DEFAULT NULL,`city` varchar(100) DEFAULT NULL,`lon` varchar(100) DEFAULT NULL,`region` varchar(100) DEFAULT NULL,`countryCode` varchar(20) DEFAULT NULL,`hits` bigint(20) DEFAULT NULL,`created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,`updated_at` datetime on update CURRENT_TIMESTAMP NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
            DB::statement('ALTER TABLE `incoming_requests` ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `incoming_requests` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT');
        }

        return $tableName;
    }

    public static function saveRequest()
    {
        $tableName = 'incoming_requests';
        $ip_address = ip();

        $data = get_web_page('http://ip-api.com/json/' . $ip_address);

        if ($data['content'] && $data['content'] != '') {
            $data = json_decode($data['content']);
            if ($data) {

                $cc = strtolower($data->countryCode);
                $lat = $data->lat;
                $lon = $data->lon;

               $record = DB::table($tableName)->updateOrInsert(
                    ["ip" => $ip_address],
                    ['country' => $data->country, 'countryCode' => $cc, 'region' => $data->region, 'lat' => $lat, 'lon' => $lon, 'city' => $data->city, 'zip' => $data->zip
                    ]
                );
                $hits = 0;
                $dbb = DB::table($tableName)->where("ip", $ip_address)->first();
                $hits = $dbb->hits + 1;
                DB::update('update '.$tableName.' set hits = '.$hits.' where id = ?', [$dbb->id]);
//                dd($dbb);
//                $dbb->hits = $dbb->hits + 1;
//                $dbb->save();

//               dd($record);
            }
        }
    }



}
