<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactMails extends Model
{
    use HasFactory;

    public static function make_message(Request $req){
        DB::table('contact_mails')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'subject'=>$req->subject,
            'message'=>$req->message
        ]);
    }
    public static function Mails(){
        $req = DB::table('contact_mails')
        ->where('is_archived', 0)
        ->where('is_removed', 0)
        ->get();
        return $req;
    }
    public static function Arch_Mails(){
        $req = DB::table('contact_mails')
        ->where('is_archived', 1)
        ->where('is_removed', 0)
        ->get();
        return $req;
    }
}
