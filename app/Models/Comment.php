<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    public static function GetByLectureID($LectureID){
        $upit = DB::table('comments')
        ->join("lectures",'comments.lecture_ID','lectures.ID')
        ->where("comments.lecture_ID",$LectureID)
        ->get();
        return $upit;
    }
}
