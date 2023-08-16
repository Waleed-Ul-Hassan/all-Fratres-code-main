<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        "billing_info",
        "recruiter_id",
        "job_id",
        "price_of_job",
        "tax_amount",
        "tax_percentage",
        "total_amount",
        "payment_status",
        "order_type",
        "currency",
        "stripe_response",
        "package_details",
        "job_details",
        "order_title"
    ];

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function scopeCompleted($query){
        return $query->where("payment_status", "completed");
    }






}
