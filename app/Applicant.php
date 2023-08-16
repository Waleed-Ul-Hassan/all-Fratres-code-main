<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        'seeker_id',
        'job_id',
        'viewed_at',
        'short_listed',
        'cover_letter',
        'additional_docs',
    ];

    protected $dates = [
        'viewed_at'
    ];


    public function seeker(){
        return $this->belongsTo(Seeker::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function scopeIsAwaiting(){
        if( $this->viewed_at == null ){
            return TRUE;
        }else{
            return FALSE;
        }

    }



    public function scopeIsReviewed(){
        if( $this->viewed_at != null ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function scopeIsShortlisted(){
        if( $this->short_listed == 1 ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function scopeRejected(){
        if( $this->short_listed == 2 ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function scopeReject(){
        return $this->update(["short_listed" => 2]);
    }







}
