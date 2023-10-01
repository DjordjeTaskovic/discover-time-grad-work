<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function reviews() {
        return $this->hasMany('App\Models\Review','user_ID',"ID");
    }
    
    public function user_role() {
        return $this->belongsTo('App\Models\UserRole','role_ID',"ID");
    }
   

    public static function getUser_email_pass($e, $p){
        $user = DB::table("users")
               ->join('user_roles','users.role_ID','=','user_roles.ID')
               ->where("email", "=", $e)
               ->where("password", "=", $p)
               ->select('users.*', 'user_roles.name as role_name','user_roles.ID as role_ID')
               ->first();
         return $user;
   }
    public static function insertUser($username,$email,$pass){
        $userID = DB::table('users')->insertGetId([
                "username" => $username,
                "email" => $email,
                "password" => $pass,
                "role_ID" => 1,
                "photo" => "default_user.png"
            ]);
            return $userID;
    }
    public static function getUser_id($userid){
        $user = DB::table("users")
        ->join('user_roles','users.role_ID','=','user_roles.ID')
        ->where("users.id", "=", $userid)
        ->select('users.*', 'user_roles.name as role_name','user_roles.ID as role_ID')
        ->first();
        return $user;
    }
    public static function getUserSubs($userid){
        $subs = DB::table("subscriptions as t1")
        ->join('user_subscriptions as t2','t1.ID','=','t2.subscription_ID')
        ->join('users as t3','t2.user_ID','=','t3.ID')
        ->where("t3.ID", "=", $userid)
        ->select('t1.*')
        ->get();
        return $subs;
    }

    public static function getUserLectureData(){
        $data = DB::table("users")
        ->join("lecture_users",'users.ID','=','lecture_users.user_ID')
        ->join("lectures",'lecture_users.lecture_ID','=','lectures.ID')
        ->join("subscriptions",'lectures.subscription_ID','=','subscriptions.ID')
        ->join("historical_data",'lectures.his_data_ID','=','historical_data.ID')
        ->join("lecture_skills",'lectures.skill_ID','=','lecture_skills.ID')

        ->select('users.username','users.photo','historical_data.name','historical_data.description','subscriptions.price','lecture_skills.skill_name')
        
        ->get();
        return $data;

    }

    public static function userLectures($userID, $condition){
        $upit = DB::table('lectures')
        ->join('historical_data','lectures.his_data_ID','=','historical_data.ID')
        ->join('lecture_skills','lectures.skill_ID','=','lecture_skills.ID')
        ->join('lecture_users','lectures.ID','=','lecture_users.lecture_ID')
        ->join('users','users.ID','=','lecture_users.user_ID')
        ->join('lecture_reviews as t9', 'lectures.ID', '=', 't9.lecture_ID')


        ->select(
            'lectures.*',
            'historical_data.ID as his_data_ID',
            'lectures.lecture_name as name',
            'historical_data.period_time as period_time',
            'historical_data.cover_image as cover_image',
            'historical_data.period_name as period_name',
            'lecture_skills.skill_name',
            'lecture_users.is_finished',
            't9.average_review'
            )
        ->where("users.ID",'=',$userID);

        if($condition == "non_archived"){
            $upit = $upit->where("lecture_users.is_archived",'=', 0);
        }
        if($condition == "favorites"){
            $upit = $upit->where("lecture_users.is_favourite",'=', 1);
        }
        if($condition == "archived"){
            $upit = $upit->where("lecture_users.is_archived",'=', 1);
        }
      
         return $upit;
    }
    public static function UserTest(){
        $data = DB::table("users as t1")
        ->join("comments as t2","t1.ID",'=','t2.user_ID')
        ->join("lectures as t3","t2.lecture_ID",'=','t3.ID')
        ->join("historical_data as t4","t3.his_data_ID",'=','t4.ID')
        ->select('t2.text','t1.username','t3.ID as LectureID','t4.name')
        ->get();

        return $data;
    }
    public static function getCountries(){
        $data = '[
            {
                "name": "United States",
                "short": "USA"
            },
            {
                "name": "Canada",
                "short": "CAN"
            },
            {
                "name": "Brazil",
                "short": "BRA"
            },
            {
                "name": "Russia",
                "short": "RUS"
            },
            {
                "name": "China",
                "short": "CHN"
            },
            {
                "name": "Australia",
                "short": "AUS"
            },
            {
                "name": "India",
                "short": "IND"
            },
            {
                "name": "Japan",
                "short": "JPN"
            },
            {
                "name": "Germany",
                "short": "GER"
            },
            {
                "name": "France",
                "short": "FRA"
            },
            {
                "name": "Spain",
                "short": "ESP"
            },
            {
                "name": "Italy",
                "short": "ITA"
            },
            {
                "name": "Mexico",
                "short": "MEX"
            },
            {
                "name": "South Africa",
                "short": "RSA"
            },
            {
                "name": "Saudi Arabia",
                "short": "SAU"
            }
            
        ]';
      return json_decode($data);
    }

    public static function UsersWithScores(){
        $usersWithScores = DB::table('users as u')
        ->join('scores as s', 'u.ID', '=', 's.user_ID')
        ->select('u.ID as userID','u.username','u.photo')
        ->distinct()
        ->get();

        return $usersWithScores;
    }
   
}
