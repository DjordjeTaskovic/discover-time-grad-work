<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class LectureUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function GetCalendarEvents($userID) {
        $upit = DB::table("lecture_users as t1")
        ->join('calendar_events as t2','t1.ID','=','t2.lecture_user_ID')
        ->join('lectures as t3','t1.lecture_ID','=','t3.ID')
        ->where('t1.ID',$userID)
        ->select('t2.*')
        ->get();

        return $upit;
    }
    public static function GetLecuresByUser($userID){
        $upit = DB::table("lecture_users as t1")
        ->join('lectures as t3','t1.lecture_ID','=','t3.ID')
        ->where('t1.user_ID',$userID)
        ->select('t3.ID','t3.lecture_name')
        ->get();

        return $upit;
    }
}
