<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lecture;
use App\Models\LectureSkill;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use LanguageDetection\Language;

class LectureController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $this->data['items'] = Lecture::getitems()->paginate(6);
         return view('dashboard.admin_pages.lectureCRUD.lectures', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['avalableData'] = Lecture::avalableData();
        $this->data['subs'] = Subscription::all();
        $this->data['cats'] = Category::all();
        $this->data['skills'] = LectureSkill::all();
        $this->data['lang'] = Lecture::lang();
       return view('dashboard.admin_pages.lectureCRUD.add_lecture', $this->data);
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
            "lecture_name"=>"required",
            "duration"=>"required|numeric",
            "description"=>"required",
            'language.*' => 'required|not_in:0',
            "learning_outcomes" => [
                "required",
                function ($attribute, $value, $fail) {
                    $requiredConsecutiveDots = 2; // Change this to the desired number
    
                    $passages = explode("\n", $value); // Assuming passages are separated by new lines
    
                    foreach ($passages as $passage) {
                        if (strpos($passage, str_repeat(".", $requiredConsecutiveDots)) === false) {
                            $fail("Each passage in $attribute must have at least $requiredConsecutiveDots consecutive dots.");
                        }
                    }
                }
            ],
             'dataID.*' => 'required|numeric|min:0|not_in:0',
             'catID.*' => 'required|numeric|min:0|not_in:0',
             'skillID.*' => 'required|numeric|min:0|not_in:0',
             'subID.*' => 'required|numeric|min:0|not_in:0'
         ]);

         DB::beginTransaction();
         try
         {
                $id = Lecture::insertLecture($req);
                DB::table("lecture_reviews")->insert([
                    'lecture_ID'=> $id,
                ]);
                DB::commit();
             return redirect()->route('ad_lectures.create')->with('success', 'Data added successfully!');
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
        $this->data['his_data'] = Lecture::getLectureID($ID);
        //dd( $this->data['his_data']);
         return view('dashboard.admin_pages.lectureCRUD.lecture_single', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $this->data['ad_lecture'] = Lecture::GetLectureWithRest($id);
         $this->data['cats'] = Category::all();
         $this->data['subs'] = Subscription::all();
         $this->data['skills'] = LectureSkill::all();
        $this->data['avalableData'] = Lecture::avalableData();
        $this->data['lang'] = Lecture::lang();

        return view('dashboard.admin_pages.lectureCRUD.edit_lecture', $this->data);
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
            "lecture_name"=>"required",
            "duration"=>"required|numeric",
            'language.*' => 'required|not_in:0',
            "description"=>"required",
            "learning_outcomes" => [
                "required",
                function ($attribute, $value, $fail) {
                    $requiredConsecutiveDots = 2; // Change this to the desired number
    
                    $passages = explode("\n", $value); // Assuming passages are separated by new lines
    
                    foreach ($passages as $passage) {
                        if (strpos($passage, str_repeat(".", $requiredConsecutiveDots)) === false) {
                            $fail("Each passage in $attribute must have at least $requiredConsecutiveDots consecutive dots.");
                        }
                    }
                }
            ],
            'catID.*' => 'required|numeric|min:0|not_in:0',
            'skillID.*' => 'required|numeric|min:0|not_in:0',
            'subID.*' => 'required|numeric|min:0|not_in:0'
        ]);
     
         
         DB::beginTransaction();
         try
         {
              Lecture::updateLecture($req);
                DB::commit();
             return redirect()->route('ad_lectures.edit',['ad_lecture'=>$req->ID])->with('success', 'Data added successfully!');
         }
         catch(\Exception $e)
         {
             DB::rollBack();
            // dd($e->getMessage());
             return redirect()->route('error')->with('errorMessage', 'An error occurred!');
         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Lecture::RemoveLecture($id);
       return redirect()->route('ad_lectures.index');

    }
}
