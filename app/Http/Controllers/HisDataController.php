<?php

namespace App\Http\Controllers;

use App\Models\HistoricalData;
use App\Models\HistoricalDataType;
use App\Models\Image;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HisDataController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['data'] = HistoricalData::GetData()->paginate(6);
        return view('dashboard.admin_pages.his_dataCRUD.his_data', $this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['types'] = HistoricalDataType::with('his_data')->get(); 
        return view('dashboard.admin_pages.his_dataCRUD.add_his_data', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
       $req->validate([
           "name"=>"required|max:100",
           "period_name"=>"required|max:40",
           "period_time"=>"required|max:40",
           "cover_image"=>"mimes:jpeg,jpg,png,gif",
           "description"=>"required",
            'typeIDs' => 'required',
            "filename.*"=>"mimes:jpeg,jpg,png,gif"
        ]);
      
         if($req->material == "/" || $req->current_location ==  "/" || $req->collection_num ==  "/" || $req->finding_place ==  "/"){
            $req->validate([
                "material"=>"required|max:400|min:20",
                "current_location"=>"required|max:400|min:20",
                "collection_num"=>"required|max:400|min:20",
                "finding_place"=>"required|max:400|min:20",
             ]);
        }
       else if($req->most_fam_ach ==  "/" || $req->ach_desc ==  "/"){
            $req->validate([
                "most_fam_ach"=>"required|max:400|min:20",
                "ach_desc"=>"required|max:400|min:20",
             ]);
        }
      
        DB::beginTransaction();
        try
        {
            HistoricalData::insertData($req);
            DB::commit();
            return redirect()->route('ad_his_data.create')->with('success', 'Data added successfully!');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
          //  dd($e->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID)
    {
        $this->data['his_data'] = HistoricalData::getDataID($ID);
        $this->data['his_data_images'] = HistoricalData::getDataImages($ID)->get();

      
        return view('dashboard.admin_pages.his_dataCRUD.his_data_single', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID)
    {
        $this->data['ad_his_datum'] = HistoricalData::GetDataWithRest($ID);
      
        $this->data['types'] = HistoricalDataType::with('his_data')->get(); 
        return view('dashboard.admin_pages.his_dataCRUD.edit_his_data', $this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
       
        $req->validate([
            "name"=>"required|max:100",
            "period_name"=>"required|max:30",
            "period_time"=>"required|max:30",
            "cover_image"=>"mimes:jpeg,jpg,png,gif",
            "description"=>"required",
            "filename.*"=>"mimes:jpeg,jpg,png,gif"
         ]);
       
          if($req->material == "/" || $req->current_location ==  "/" || $req->collection_num ==  "/" || $req->finding_place ==  "/"){
             $req->validate([
                 "material"=>"required|max:400|min:20",
                 "current_location"=>"required|max:400|min:20",
                 "collection_num"=>"required|max:400|min:20",
                 "finding_place"=>"required|max:400|min:20",
              ]);
         }
        else if($req->most_fam_ach ==  "/" || $req->ach_desc ==  "/"){
             $req->validate([
                 "most_fam_ach"=>"required|max:400|min:20",
                 "ach_desc"=>"required|max:400|min:20",
              ]);
         }
     

        DB::beginTransaction();
        try {
                HistoricalData::updateData($req);
                
                DB::commit();
            return redirect()->route('ad_his_data.edit', $id)->with('success', 'Item edited successfully!');
            }
            catch(\Exception $e)
            {
                DB::rollBack();
              //  dd($e->getMessage());
                return redirect()->route('error')->with('errorMessage', 'An error occurred!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID)
    {
        HistoricalData::removeData($ID);
        return redirect()->route('ad_his_data.index');
    }
}
