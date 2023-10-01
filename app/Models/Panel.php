<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Panel extends Model
{
    
    public static function getReportsWithRequest($request){
        //date_default_timezone_set('Europe/Belgrade');
        Carbon::setLocale('Europe/Belgrade'); // Set your locale

        // Get the current date and time
        $currentDate = Carbon::now();
        // Get the current month
        $currentMonth = $currentDate->format('F');

        // Calculate the start and end dates of the current week
        $currentWeekStart = $currentDate->startOfWeek();
        $currentWeekEnd = $currentDate->copy()->endOfWeek();

        // Format the dates for display
        $currentWeekStartFormatted = $currentWeekStart->format('Y-m-d');
        $currentWeekEndFormatted = $currentWeekEnd->format('Y-m-d');

       // dd('current month: '. $currentMonth,'current week: '. $currentWeekStartFormatted." to ".$currentWeekEndFormatted);
        

        $file = fopen(public_path("logs/log.txt"), "r");
        $data = file(public_path("logs/log.txt"));
        $niz = [];
       
        for ($i = 0; $i < count($data); $i++){
            $in = explode("\t", $data[$i]);
           // $adate = explode(" ", $in[4])[1];
          
                    $obj = new \stdClass();
                    $obj->username =$in[0];
                    $obj->role =$in[1];
                    $obj->route =$in[2];
                    $obj->ip =$in[3];
                    $obj->date =$in[4];
                    $obj->message =$in[5];
                    array_push($niz, $obj);
        };
        //report bassed on sugested current time (current month, current week)
        if($request->get("current_time") != 0){
            $ele = [];
            for ($i = 0; $i <count($niz) ; $i++) { 
                    $inputDate = Carbon::createFromFormat('Y-m-d', explode(" ",$niz[$i]->date)[1]);

                    if($request->get("current_time") == "month"){
                        if($inputDate->month === $currentDate->month){
                            array_push($ele, $niz[$i]);
                        }
                    }

                    if($request->get("current_time") == "week_span"){
                        if($inputDate->isoWeek === $currentDate->isoWeek){
                            array_push($ele, $niz[$i]);
                        }
                    }
                }
            $niz = $ele;
        }
       
        if($request->get("sortdate")!= null){
            $ele = [];
            for ($i = 0; $i <count($niz) ; $i++) { 
                    if(explode(" ",$niz[$i]->date)[1] === $request->get("sortdate")){
                        array_push($ele, $niz[$i]);
                    }
                }
                // dd($ele);
            $niz = $ele;
        }
        if($request->get("username")!= null && $request->get("username")!= 0){
        
            $ele = [];
            for ($i = 0; $i < count($niz) ; $i++) { 
                    if(explode(" ", $niz[$i]->username)[0] === explode(" ", $request->get("username"))[0]){
                        array_push($ele, $niz[$i]);
                    }
                }
            $niz = $ele;
        }
       return $niz;
    }
 
    public static function lognote($message, $error){
        if($error){
            $file = fopen(public_path('logs/error.txt'), "a+");
        } else {
            $file = fopen(public_path('logs/log.txt'), "a+");
        }
        $user='';
        $role='';
        if(session()->get("user")){
            $user = session("user")->username;
            $role =  session("user")->role_name;
        }
        else
        {
            $user="not-logged-in";
            $role="no-role";
        }
        $route = $_SERVER['PHP_SELF'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s');
        
        $w = "$user \t $role \t $route \t $ip \t $date \t $message \n";
        fwrite($file, $w);
        fclose($file);
        
    }
}
