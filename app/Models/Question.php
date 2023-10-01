<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Question extends Model
{
    use HasFactory;

    public static function GetQuestionsByLecture($lecture_ID){
       $upit = DB::table('questions')
        ->select('text')
        ->where('lecture_ID', $lecture_ID)
        ->get();
        return $upit;
    }
}
