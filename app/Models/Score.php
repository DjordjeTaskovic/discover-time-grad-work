<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Score extends Model
{
    use HasFactory;
  
    public static function UserSum($userID){
        $latestAttempts = DB::table('scores')
        ->select('user_ID', 'lecture_ID', DB::raw('MAX(attempt_num) as max_attempt'))
        ->groupBy('user_ID', 'lecture_ID');

        $result = DB::table('scores as t1')
        ->joinSub($latestAttempts, 't2', function ($join) {
            $join->on('t1.user_ID', '=', 't2.user_ID')
                ->on('t1.lecture_ID', '=', 't2.lecture_ID')
                ->on('t1.attempt_num', '=', 't2.max_attempt');
        })
         ->leftJoin('lectures', 't1.lecture_ID', '=', 'lectures.ID')
        ->where('t1.user_ID', $userID)
        ->select('t1.*', 'lectures.lecture_name')
        ->get();
        return  $result;
    }
    public static function UserLectureSum($userID, $lectureID){
        $latestAttempts = DB::table('scores')
        ->select('user_ID', 'lecture_ID', DB::raw('MAX(attempt_num) as max_attempt'))
        ->groupBy('user_ID', 'lecture_ID');

        $result = DB::table('scores as t1')
        ->joinSub($latestAttempts, 't2', function ($join) {
            $join->on('t1.user_ID', '=', 't2.user_ID')
                ->on('t1.lecture_ID', '=', 't2.lecture_ID')
                ->on('t1.attempt_num', '=', 't2.max_attempt');
        })
         ->leftJoin('lectures', 't1.lecture_ID', '=', 'lectures.ID')
        ->where('t1.user_ID', $userID)
        ->where('t1.lecture_ID', $lectureID)
        ->select('t1.*', 'lectures.lecture_name')
        ->get();
        return  $result;
    }

    public static function ScoreSUMByUser($userId){
        $latestAttempts = DB::table('scores')
        ->select('user_ID', 'lecture_ID', DB::raw('MAX(attempt_num) as max_attempt'))
        ->groupBy('user_ID', 'lecture_ID');
    
        $subquery = DB::table('scores as t1')
            ->joinSub($latestAttempts, 't2', function ($join) {
                $join->on('t1.user_ID', '=', 't2.user_ID')
                    ->on('t1.lecture_ID', '=', 't2.lecture_ID')
                    ->on('t1.attempt_num', '=', 't2.max_attempt');
            })
            ->select('t1.*')
            ->where('t1.user_ID', $userId); // Filter by the specific user ID
        
        $result = DB::table(DB::raw("({$subquery->toSql()}) as t3"))
            ->mergeBindings($subquery)
            ->select('user_ID', DB::raw('SUM(score_value) as total_score'))
            ->groupBy('user_ID')
            ->get();
            
            return $result;
    }
}
