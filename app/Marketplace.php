<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{

    protected $table = 'affiliates';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection('mysql_marketplace');
    }





}
