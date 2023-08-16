<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesEmail extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $table = "sales_emails";

    protected $fillable = [
        "filename", "file", "emails", "last_sent", "user_id"
    ];

}
