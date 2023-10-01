<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HistoricalData extends Model
{
    use HasFactory;
    protected $table = "historical_data";

    public function his_data() {
        return $this->belongsTo('App\Models\HistoricalDataType','type_ID',"ID");
    }

    public function his_data_artifact() {
        return $this->hasMany('App\Models\HistoricalArtifact','his_data_ID',"ID");
    }
    public function his_data_event() {
        return $this->hasMany('App\Models\HistoricalEvent','his_data_ID',"ID");
    }
    public function his_data_figure() {
        return $this->hasMany('App\Models\HistoricalFigure','his_data_ID',"ID");
    }
  
    public static function insertData(Request $req){
        //dd($req->file('cover_image') );
        $dataID = 0;
            if($req->file('cover_image') != null){
                $imgname = $req->cover_image->getClientOriginalName();
                $req->cover_image->move(public_path().'/assets/images/historical_data/', $imgname);

                    $dataID = DB::table('historical_data')->insertGetId([
                            "name"=>$req->name,
                            "period_name"=>$req->period_name,
                            "period_time"=>$req->period_time,
                            "cover_image"=>$imgname,
                            "description"=>$req->description,
                            "type_ID" =>$req->typeIDs[0],
                            
                        ]);
            }
            else{
                    $dataID = DB::table('historical_data')->insertGetId([
                            "name"=>$req->name,
                            "period_name"=>$req->period_name,
                            "period_time"=>$req->period_time,
                            "description"=>$req->description,
                            "type_ID" =>$req->typeIDs[0]
                        ]);
                }
        
        if($req->material != null){
                DB::table('historical_artifacts')->insert(
                    [
                        "his_data_ID"=>$dataID,
                        "material"=>$req->material,
                        "collection_num"=>$req->collection_num,
                        "current_location"=>$req->current_location,
                        "finding_place"=>$req->finding_place
                    ]);
             }
            
            else if($req->most_fam_ach != null){
              
                DB::table('historical_figures')->insert(
                    [
                        "his_data_ID"=>$dataID,
                        "most_fam_ach"=>$req->most_fam_ach,
                        "ach_desc"=>$req->ach_desc,
                    ]);
            }
            else if($req->typeIDs[0] == 2){
                DB::table('historical_events')->insert(
                    [
                        "his_data_ID"=>$dataID,
                    ]);
            }
            if($req->file('filename') != null){
                foreach($req->file('filename') as $img){
                    $imgname = $img->getClientOriginalName();
                   
                    $img->move(public_path().'/assets/images/historical_data/inner_images/', $imgname);  
                    DB::table('images')->insert(
                        [
                        "url" => $imgname,
                        "his_data_ID" => $dataID
                        ]);
                }
            }

    }
    // 
    // 
    // 
    public static function updateData(Request $req){

       // dd($req->all());
        $tID = DB::table("historical_data as t1")
        ->join('historical_data_types as t2','t1.type_ID','=','t2.ID')
        ->select("t1.type_ID")
        ->where('t1.ID','=',$req->ID)
        ->first();

       // dd($tID->type_ID);
        if($req->file('cover_image') != null){

            $imgname = $req->cover_image->getClientOriginalName();
            $req->cover_image->move(public_path().'/assets/images/historical_data/', $imgname);

                DB::table('historical_data')->where('ID','=',$req->ID)
                ->update([
                    'name'=>$req->name,
                    'period_time'=>$req->period_time,
                    'period_name'=>$req->period_name,
                    "cover_image"=>$imgname,
                    'description'=>$req->description,
                        'type_ID'=>$tID->type_ID
                ]);
        }
        else{
            DB::table('historical_data')->where('ID','=',$req->ID)
                ->update([
                    'name'=>$req->name,
                    'period_time'=>$req->period_time,
                    'period_name'=>$req->period_name,
                    'description'=>$req->description,
                        'type_ID'=>$tID->type_ID
                ]);
        }

        if($req->material != null){
            DB::table('historical_artifacts')->where('his_data_ID','=',$req->ID)->update(
                [
                    "material"=>$req->material,
                    "collection_num"=>$req->collection_num,
                    "current_location"=>$req->current_location,
                    "finding_place"=>$req->finding_place
                ]);
         }
        
        else if($req->most_fam_ach != null){
          
            DB::table('historical_figures')->where('his_data_ID','=',$req->ID)->update(
                [
                    "most_fam_ach"=>$req->most_fam_ach,
                    "ach_desc"=>$req->ach_desc,
                ]);
        }

        // if($req->file('filename') != null){
        //     foreach($req->file('filename') as $img){
        //         $imgname = $img->getClientOriginalName();
        //         $img->move(public_path().'/assets/images/historical_data/', $imgname);  

        //         DB::table('images')->where('his_data_ID','=',$req->ID)->update(
        //             [
        //                 "url" => $imgname,
        //             ]);
        //     }
        // }
    }

    public static function GetData(){
        $upit = DB::table('historical_data as t1')
        ->leftJoin('historical_figures as t2_1','t1.ID','=','t2_1.his_data_ID')
        ->leftJoin('historical_events as t2_2','t1.ID','=','t2_2.his_data_ID')
        ->leftJoin('historical_artifacts as t2_3','t1.ID','=','t2_3.his_data_ID')

        ->select("t1.*","t2_1.*","t2_2.*","t2_3.*")
        ->addSelect("t1.ID as HisID")
        ->where("t1.is_removed",'=',0);
        return $upit;
    }
    public static function GetDataWithRest($ID){
        $upit = DB::table('historical_data as t1')
        ->leftJoin('historical_figures as t2_1','t1.ID','=','t2_1.his_data_ID')
        ->leftJoin('historical_events as t2_2','t1.ID','=','t2_2.his_data_ID')
        ->leftJoin('historical_artifacts as t2_3','t1.ID','=','t2_3.his_data_ID')
        ->leftJoin('historical_data_types as t2_4','t1.type_ID','=','t2_4.ID')

        ->where('t1.ID','=', $ID)
        ->select("t1.*","t2_1.*","t2_2.*","t2_3.*","t2_4.*")
        ->addSelect("t1.ID as HisID")
        ->first();
       //dd($upit);
        return $upit;
    }

    public static function removeData($ID){
        DB::table("historical_data")
        ->where('ID','=',$ID)
        ->update([
            "is_removed" => 1
        ]);
    }
    public static function getDataID($ID){
        $upit = DB::table('historical_data as t1')
        ->leftJoin('historical_figures as t2_1','t1.ID','=','t2_1.his_data_ID')
        ->leftJoin('historical_events as t2_2','t1.ID','=','t2_2.his_data_ID')
        ->leftJoin('historical_artifacts as t2_3','t1.ID','=','t2_3.his_data_ID')
        ->leftJoin('historical_data_types as t2_5','t1.type_ID','=','t2_5.ID')
        ->where('t1.ID','=', $ID)
        ->select('t1.*', 't2_1.*', 't2_2.*', 't2_3.*','t2_5.*')
        ->addSelect('t1.ID as his_data_ID')
        ->first();
        return $upit;
    }
    public static function getDataImages($ID){
        $upit = DB::table('historical_data as t1')
        ->leftJoin('images as t2','t1.ID','=','t2.his_data_ID')
        ->where('t1.ID','=', $ID);
        return $upit;
    }
}
