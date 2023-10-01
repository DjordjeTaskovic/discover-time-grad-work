<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    use HasFactory;
    public function lectures() {
        return $this->hasMany('App\Models\Lecture','subscription_ID',"ID");
    }
    public static function subLecturesByID($ID){
        $upit = DB::table('subscriptions as t1')
        ->join('lectures as t2','t2.subscription_ID','=','t1.ID')
        ->where('t1.ID', $ID)
        ->where('t2.is_removed', 0)
        ->select()->get();
        return $upit;
    }
    public static function UserSub($ID){
        $upit = DB::table('subscriptions as t1')
        ->join('user_subscriptions as t2','t2.subscription_ID','=','t1.ID')
        ->join('users as t3','t2.user_ID','=','t3.ID')
        ->where('t1.ID', $ID)
        ->select()
        ->addSelect("t2.created_at as sub_created_date",'t1.ID as sub_ID')
        ->first();
        return $upit;
    }
    public static function SubUser($ID){
        $upit = DB::table('subscriptions as t1')
        ->join('user_subscriptions as t2','t2.subscription_ID','=','t1.ID')
        ->join('users as t3','t2.user_ID','=','t3.ID')
        ->where('t3.ID', $ID)
        ->where('t2.is_removed', 0)
        ->select('t1.*')
        // ->addSelect('t1.ID as subID')
        ->orderBy('t1.price')
        ->get();
        return $upit;
    }
}
