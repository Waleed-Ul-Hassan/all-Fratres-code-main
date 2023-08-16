<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ValidateTokens extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    public $seeker = 'seeker';
    public $recruiter = 'recruiter';

    protected $fillable = [
            "user_id", "user_type" , "access_token"
    ];

    public function seeker($token)
    {
        $validate = ValidateTokens::where("access_token", $token)->where("user_type", $this->seeker)->first();
        if($validate){
            return Seeker::find($validate->user_id);
        }
        // return $this->belongsTo(Vendor::class)->where("access_token", $token)->first();
    }

    public function recruiter($token)
    {   
        $validate = ValidateTokens::where("access_token", $token)->where("user_type", $this->recruiter)->first();
        if($validate){
            return Recruiter::find($validate->user_id);
        }
    }


    public function accessToken($type, $id)
    {
        $tokenCreated = $this->Create(["user_id" => $id, "user_type" => $type]);
        $token = Str::random(189).$tokenCreated->id;
        $tokenCreated->update(["access_token" => $token]);

        return $token;
    }


    public function revokeAccessRecruiter($token)
    {
        $validate = ValidateTokens::where("access_token", $token)->where("user_type", $this->recruiter)->first();
        $validate->delete();

        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `validate_tokens` SET `validate_tokens`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `validate_tokens` AUTO_INCREMENT = 1;");

    }
    
    public function revokeAccessSeeker($token)
    {
        $validate = ValidateTokens::where("access_token", $token)->where("user_type", $this->seeker)->first();
        $validate->delete();

        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `validate_tokens` SET `validate_tokens`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `validate_tokens` AUTO_INCREMENT = 1;");

    }






}
