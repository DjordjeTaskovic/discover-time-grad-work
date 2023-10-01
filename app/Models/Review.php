<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;
     
    public function lectures() {
        return $this->belongsTo('App\Models\Lecture','lecture_ID',"ID");
    }
    public function user() {
        return $this->belongsTo('App\Models\User','user_ID',"ID");
    }
    
    
    public static function RevFilter($req){
       // dd($req->all());
        $upit = DB::table("reviews as t1")
        ->join("users as t2",'t1.user_ID','=','t2.ID')
        ->join("lectures as t3",'t1.lecture_ID','=','t3.ID')
        ->join("historical_data as t4",'t3.his_data_ID','=','t4.ID');

        //dd($req->starValue != 0);
        if($req->userID != 0){
            $upit= $upit->where('t1.user_ID','=',$req->userID);
        }
        if($req->lectureID != 0){
            $upit= $upit->where('t1.lecture_ID','=',$req->lectureID);
        }
        if($req->starValue != 0){
            $req->starValue == "asc" ? $upit = $upit->orderBy("t1.review_value") : $upit = $upit->orderByDESC("t1.review_value");
        }

        if($req->search){
            $upit = $upit->where("t1.text","like","%".$req->search."%");
        }

        $upit = $upit->select('t1.*','t2.username','t4.name as lecture_name')->get();

        return $upit;

    }

    public static function RevUser(){
        $upit = DB::table('users')
        ->join('reviews', 'users.ID', '=', 'reviews.user_ID')
        ->select('users.ID','users.username')
        ->distinct()
        ->get();

        return $upit;
    }
    public static function LectureRevs(){
        $upit = DB::table('lectures')
        ->join('reviews', 'lectures.ID', '=', 'reviews.lecture_ID')
        ->join('historical_data', 'lectures.his_data_ID', '=', 'historical_data.ID')
        ->select('lectures.ID','historical_data.name')
        ->distinct()
        ->get();

        return $upit;
    }
    public static function RevLecture($ID){
        $upit = DB::table('reviews')
        ->join('lectures', 'lectures.ID', '=', 'reviews.lecture_ID')
        ->join('historical_data', 'lectures.his_data_ID', '=', 'historical_data.ID')
        ->select(
            'reviews.ID as RevID',
            'reviews.review_value',
            'reviews.created_at',
            'reviews.text as rev_text',
            'lectures.ID as lecture_ID',
            'historical_data.name'
        )
        ->where('reviews.user_ID',$ID)
        ->distinct()
        ->get();

        return $upit;
    }
   
}
