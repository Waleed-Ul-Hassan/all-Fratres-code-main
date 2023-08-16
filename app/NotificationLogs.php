<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationLogs extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        "notifier_id", "notifier_type", "message", "url", "read_at"
    ];


    public function seeker_logs(){
        return $this->where("notifier_type", 'seeker')->where("notifier_id", seeker_logged('id'));
    }

    public function recruiter_logs(){
        return $this->where("notifier_type", 'recruiter')->where("notifier_id", recruiter_logged('id'));
    }

    public function latest(){
        return $this->orderBy('id',' DESC');
    }



    public function readAt(){
        if($this->read_at == null){
            return $this->update(["read_at" => date("Y-m-d H:i:s")]);
        }
    }

    public static function countUnreadSeeker(){
        return NotificationLogs::where("notifier_type", "seeker")
                ->where("notifier_id", seeker_logged('id'))
                ->whereRaw("read_at IS NULL")->count();
    }

    public static function countUnreadRecruiter(){
        return NotificationLogs::where("notifier_type", "recruiter")
                ->where("notifier_id", recruiter_logged('id'))
                ->whereRaw("read_at IS NULL")->count();
    }




}
