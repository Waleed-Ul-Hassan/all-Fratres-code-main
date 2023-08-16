<?php

namespace App;

use App\Events\JobAlertCreating;
use App\Events\JobAlertDeleting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class JobAlert extends Model
{
//    use SoftDeletes;
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        'name',
        'job_title',
        'email',
        'city_id',
        'industry_id',
        'random_id',
        'confirmed_at',
        'is_seeker',
        'deleted_at',
        'last_sent'
    ];


    protected $dispatchesEvents = [
        'created' => JobAlertCreating::class,
        'deleted' => JobAlertDeleting::class,
    ];

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function industry(){
        return $this->belongsTo(Industry::class);
    }

}
