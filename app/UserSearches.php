<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSearches extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }
    
    protected $fillable = [
        'search_keyword',
        'location_keyword',
        'hits',
    ];


    public static function save_search(){

        $query = UserSearches::query();
        $q = null;
        $l = null;

        if (isset($_GET['q'])){
            $query->whereRaw(" search_keyword LIKE '%".$_GET['q']."%' ");
            $q = $_GET['q'];
        }

//        if (isset($_GET['location'])){
//            $query->whereRaw(" location_keyword LIKE '%".$_GET['location']."%'  ");
//            $l = $_GET['location'];
//        }

        $record = $query->first();
        if($record != ''){
            $record->hits = $record->hits + 1;
            $record->save();
        }else{

            $record = new UserSearches();
            $record->search_keyword = $q;
            $record->location_keyword = $l;
            $record->hits = 1;
            $record->save();


        }


    }
}
