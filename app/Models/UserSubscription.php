<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSubscription extends Model
{
    use HasFactory;

    public static function RemoveSub($user_ID,$sub_ID){
        DB::table('user_subscriptions')
        ->where('user_ID',$user_ID)
        ->where('subscription_ID',$sub_ID)
        ->update([
            'is_removed' => 1
        ]);

    }
}
