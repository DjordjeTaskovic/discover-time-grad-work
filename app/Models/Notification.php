<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    use HasFactory;
   
    public static function message($user_ID, $title, $message){
        DB::table('notifications')->insert([
            'user_ID'=>$user_ID,
            'title'=>$title,
            'message'=>$message,
        ]);
    }
    public static function getAll(){
        $data = DB::table('notifications as n')
        ->select('n.ID','n.title','n.message','n.is_read','n.created_at','n.user_ID')
        ->where('n.is_read','=', 0)
        ->get();
        return $data;
    }
    public static function notiByUserID($userID){
        $data = DB::table('notifications as n')
        ->join('users as u','u.ID','=','n.user_ID')
        ->where('n.user_ID',$userID)
        ->where('n.is_read','=', 0)
        ->select('n.*')
        ->get();
        return $data;
    }
}
