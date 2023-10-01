<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LectureSkill extends Model
{
    use HasFactory;
    public function lectures() {
        return $this->hasMany('App\Models\Lecture','skill_ID',"ID");
    }
    public static function skillLecturesByID($ID){
        $upit = DB::table('lecture_skills as t1')
        ->join('lectures as t2','t2.skill_ID','=','t1.ID')
        ->where('t1.ID', $ID)
        ->where('t2.is_removed', 0)
        ->select()->get();
        return $upit;
    }
}
