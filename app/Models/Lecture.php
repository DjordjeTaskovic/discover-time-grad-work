<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Lecture extends Model
{
    use HasFactory;
   
    public function categories(){
        return $this->belongsTo(Category::class,'category_ID','ID');
    }

    public function his_Data(){
        return $this->belongsTo(HistoricalData::class,'his_data_ID','ID');
    }
    public function reviews() {
        return $this->hasMany('App\Models\Review','lecture_ID',"ID");
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment','lecture_ID',"ID");
    }
   

    public static function getitems(){
        $upit = DB::table('lectures as t1')
        ->join('historical_data','t1.his_data_ID','=','historical_data.ID')
        ->join('lecture_skills','t1.skill_ID','=','lecture_skills.ID')
        ->join('lecture_reviews as t3','t1.ID','=','t3.lecture_ID')
        ->join('subscriptions as t4','t1.subscription_ID','=','t4.ID')

        ->select(
            't1.*',
            'historical_data.ID as his_data_ID',
            't1.lecture_name as name',
            'historical_data.period_time as period_time',
            'historical_data.cover_image as cover_image',
            'historical_data.period_name as period_name',
            'lecture_skills.skill_name',
            't3.average_review',
            't4.price',
            't4.difficulty' )
            ->where("t1.is_removed",'=',0);
            
         return $upit;
    }
   
    public static function getLectureID($ID){
        $upit = DB::table('historical_data as t1')
        ->leftJoin('historical_figures as t2_1','t1.ID','=','t2_1.his_data_ID')
        ->leftJoin('historical_events as t2_2','t1.ID','=','t2_2.his_data_ID')
        ->leftJoin('historical_artifacts as t2_3','t1.ID','=','t2_3.his_data_ID')
        ->leftJoin('lectures as t2_4','t1.ID','=','t2_4.his_data_ID')
        ->leftJoin('historical_data_types as t2_5','t1.type_ID','=','t2_5.ID')
        ->leftJoin('lecture_skills as t9','t2_4.skill_ID','=','t9.ID')
        ->where('t2_4.ID','=', $ID)
        ->select('t1.*','t2_4.*','t2_1.*','t2_2.*','t2_3.*','t1.ID as his_data_ID','t2_4.ID as LectureID','t9.skill_name','t2_5.type_name')
        ->first();
        return $upit;
    }
    // a copy of the previous one, soon to make changes here
    public static function getmainLectureID($ID){
        $upit = DB::table('lectures as t1')
        ->leftJoin('historical_data as t3','t1.his_data_ID','=','t3.ID')
        ->leftJoin('historical_artifacts as t4','t3.ID','=','t4.his_data_ID')
        ->leftJoin('historical_events as t5','t3.ID','=','t5.his_data_ID')
        ->leftJoin('historical_figures as t6','t3.ID','=','t6.his_data_ID')
        ->leftJoin('historical_data_types as t10','t3.type_ID','=','t10.ID')
        ->leftJoin('categories as t2','t1.category_ID','=','t2.ID')
        ->leftJoin('subscriptions as t8','t1.subscription_ID','=','t8.ID')
        ->leftJoin('lecture_skills as t9','t1.skill_ID','=','t9.ID')

        ->where('t1.ID','=', $ID)
        ->select(
                't1.ID as LectureID',
                't1.lecture_name',
                't1.lecture_description',
                't1.duration',
                't1.language',
                't1.learning_outcomes',
                't1.created_at',
                't3.name as data_name',
                't3.period_time',
                't3.period_name',
                't3.description as data_description',
                't3.cover_image',
                't10.type_name',
                't6.most_fam_ach',
                't6.ach_desc',
                't4.material',
                't4.current_location',
                't4.collection_num',
                't4.finding_place',
                't2.name as category_name',
                't2.description as category_description',
                't8.difficulty',
                't8.price',
                't9.skill_name'
                )
        ->first();
        return $upit;
    }
    public static function LectureImages($ID){
        $data = DB::table("lectures as t1")
        ->leftJoin('historical_data as t2','t2.ID','=','t1.his_data_ID')
        ->join('images as t3','t2.ID','=','t3.his_data_ID')
        ->select('t3.url','t3.title','t3.text')
        ->where('t1.ID', $ID)
        ->get();

        return $data;
    }

    public static function avalableData(){
       
        $data = DB::table("historical_data as t1")
        ->leftJoin('lectures as t2','t1.ID','=','t2.his_data_ID')
        ->whereNull('t2.his_data_ID')
        ->select('t1.ID','t1.name')
        ->get();

        return $data;
    }

    public static function insertLecture(Request $req){
        $id = DB::table('lectures')->insertGetId([
            "lecture_name"=>$req->lecture_name,
            "duration"=>$req->duration,
            "language"=>$req->language[0],
            "learning_outcomes"=>$req->learning_outcomes,
            "lecture_description"=>$req->description,
             'his_data_ID' => $req->dataID[0],
             'category_ID' => $req->catID[0],
             'skill_ID' => $req->skillID[0],
             'subscription_ID' => $req->subID[0]
        ]);
        return $id;
    }
    public static function updateLecture(Request $req){

        //if the updated lecture has a new historical data attached to if or the same one
       if ($req->dataID[0] != 0) {
           DB::table('lectures')->where('lectures.ID','=', $req->ID)
           ->update([
             "lecture_name"=>$req->lecture_name,
             "duration"=>$req->duration,
             "language"=>$req->language[0],
             "learning_outcomes"=>$req->learning_outcomes,
             "lecture_description"=>$req->description,
              'his_data_ID' => $req->dataID[0],
              'category_ID' => $req->catID[0],
              'skill_ID' => $req->skillID[0],
              'subscription_ID' => $req->subID[0]
          ]);
       }
       elseif($req->dataID[0] == 0){
             $his_dataObj = DB::table('lectures')->where('lectures.ID','=',$req->ID)->select('lectures.his_data_ID')->get();
             $his_data_ID ='';
             foreach ($his_dataObj as $value) {
                $his_data_ID = $value->his_data_ID;
             };
            // dd( $his_data_ID);

             DB::table('lectures')->where('lectures.ID','=',$req->ID)
             ->update([
               "lecture_name"=>$req->lecture_name,
               "duration"=>$req->duration,
               "language"=>$req->language[0],
               "learning_outcomes"=>$req->learning_outcomes,
               "lecture_description"=>$req->description,
                'his_data_ID' =>$his_data_ID,
                'category_ID' => $req->catID[0],
                'skill_ID' => $req->skillID[0],
                'subscription_ID' => $req->subID[0]
            ]);
       }

    }

    public static function lang(){
      $lang = '[
              {
                  "name": "English"
              },
              {
                  "name": "French"
              },
              {
                  "name": "Spanish"
              },
              {
                  "name": "German"
              },
              {
                  "name": "Italian"
              }
          ]';
        return json_decode($lang);
    }

    public static function GetLectureWithRest($id){
        $upit = DB::table('lectures')
        ->join('historical_data','lectures.his_data_ID','=','historical_data.ID')
        ->join('subscriptions','lectures.subscription_ID','=','subscriptions.ID')
        ->join('categories','lectures.category_ID','=','categories.ID')
        ->join('lecture_skills','lectures.skill_ID','=','lecture_skills.ID')
        ->where('lectures.ID','=',$id)
        ->select('lectures.ID',
                'lectures.duration',
                'lectures.lecture_name',
                'lectures.lecture_description',
                'lectures.language',
                'lectures.learning_outcomes',
                'historical_data.ID as his_data_ID',
                'historical_data.name as his_data_name',
                'subscriptions.ID as subID',
                'subscriptions.difficulty',
                'subscriptions.price',
                'categories.ID as catID',
                'categories.name as catname',
                'lecture_skills.ID as skillID',
                'lecture_skills.skill_name as skill_name')
        //->select()
        ->first();
            
         return $upit;
    }
    public static function RemoveLecture($id){
      
            DB::table("lectures")
            ->where('ID','=',$id)
            ->update([
                "is_removed" => 1
            ]);
        
    }
    public static function DataByCat($string){
        $upit = DB::table('lectures as t1')
        ->leftJoin('historical_data as t3','t1.his_data_ID','=','t3.ID')
        ->leftJoin('categories as t2','t1.category_ID','=','t2.ID')
        ->leftJoin('historical_artifacts as t4','t3.ID','=','t4.his_data_ID')
        ->leftJoin('historical_events as t5','t3.ID','=','t5.his_data_ID')
        ->leftJoin('historical_figures as t6','t3.ID','=','t6.his_data_ID')
        ->leftJoin('subscriptions as t8','t1.subscription_ID','=','t8.ID')
        ->join('lecture_reviews as t9', 't1.ID', '=', 't9.lecture_ID')
        
        ->where('t2.name', $string)
        ->where('t1.is_removed', 0)
        ->select('t2.name',
        't1.ID as LectureID',
        't1.lecture_name as LectureName',
        't3.cover_image',
        't9.average_review',
        't8.difficulty',
        't8.price',
            
        );
        
        return $upit;
    }
    public static function LectureTags($ID){
        $upit = DB::table('lectures as t1')
        ->join('tag_lectures as t2','t1.ID','=','t2.lecture_ID')
        ->join('tags as t3','t2.tag_ID','=','t3.ID')
        ->select('t3.name')
        ->where('t2.lecture_ID', $ID);
        return $upit;
    }
    public static function LectureReviews($ID){
        $upit = DB::table('lectures as t1')
        ->join('reviews as t2','t1.ID','=','t2.lecture_ID')
        ->join('users as t3','t2.user_ID','=','t3.ID')
        ->select('t2.review_value','t2.text','t3.username','t3.photo')
        ->where('t1.ID', $ID);
        return $upit;
    }
    public static function LectureReview($lectureID, $userID){
        $upit = DB::table('lectures as t1')
        ->join('reviews as t2','t1.ID','=','t2.lecture_ID')
        ->join('users as t3','t2.user_ID','=','t3.ID')
        ->select('t2.ID as revID','t2.lecture_ID','t2.review_value','t2.text','t3.username','t3.photo')
        ->where('t1.ID', $lectureID)
        ->where('t3.ID', $userID)
        ->first();
        return $upit;
    }
    public static function LectureComments($ID){
        $upit = DB::table('lectures as t1')
        ->join('comments as t2','t1.ID','=','t2.lecture_ID')
        ->join('users as t3','t2.user_ID','=','t3.ID')
        ->select('t2.text','t3.username','t3.photo')
        ->where('t1.ID', $ID);
        return $upit;
    }

    public static function RatedLectures(){
        $upit = DB::table('lectures as t1')
        ->leftJoin('historical_data as t3', 't1.his_data_ID', '=', 't3.ID')
        ->leftJoin('categories as t2', 't1.category_ID', '=', 't2.ID')
        ->leftJoin('historical_artifacts as t4', 't3.ID', '=', 't4.his_data_ID')
        ->leftJoin('historical_events as t5', 't3.ID', '=', 't5.his_data_ID')
        ->leftJoin('historical_figures as t6', 't3.ID', '=', 't6.his_data_ID')
        ->leftJoin('subscriptions as t8', 't1.subscription_ID', '=', 't8.ID')
        ->join('lecture_reviews as t9', 't1.ID', '=', 't9.lecture_ID')
        ->where('t1.is_removed', '=', 0)
        ->where('t9.average_review', '>', 0)
        ->select(
        't1.ID as LectureID',
        't1.lecture_description',
        't1.lecture_name as LectureName',
        't3.cover_image',
        't8.difficulty',
        't8.price',
        't9.average_review'
        )
        
        ->get();
        
        return $upit;
    } 
    public static function CommCount($ID){
        $upit = DB::table('lectures as t1')
        ->join('comments as t2','t1.ID','=','t2.lecture_ID')
        ->where('t2.lecture_ID', $ID)
        ->select()->get();
        return $upit;
    }
    public static function LecturesBySort(Request $req){

        $upit = DB::table('lectures as t1')
        ->leftJoin('historical_data as t3','t1.his_data_ID','=','t3.ID')
        ->leftJoin('categories as t2','t1.category_ID','=','t2.ID')
        ->leftJoin('historical_artifacts as t4','t3.ID','=','t4.his_data_ID')
        ->leftJoin('historical_events as t5','t3.ID','=','t5.his_data_ID')
        ->leftJoin('historical_figures as t6','t3.ID','=','t6.his_data_ID')
        ->leftJoin('subscriptions as t8','t1.subscription_ID','=','t8.ID')
        ->leftJoin('lecture_skills as t9','t9.ID','=','t1.skill_ID')
        ->join('lecture_reviews as t10', 't1.ID', '=', 't10.lecture_ID');
    

        if ($req->has('search')) {
            $upit = $upit->where("t1.lecture_name","like","%".$req->search."%");
        }
        if($req->get('rating')){
            if($req->rating == 'rating4'){
                $upit = $upit->where("t10.average_review", 4);
            }
            if($req->rating == 'rating3'){
                $upit = $upit->where("t10.average_review", 3);
            }
            if($req->rating == 'rating2'){
                 $upit = $upit->where("t10.average_review", 2);
            }
        }
        if($req->get('checkedcats')){
            foreach ($req->get('checkedcats') as $key) {
                $upit = $upit->where("t1.category_ID", $key);
            }
        }
        if($req->get('checkedprices')){
            foreach ($req->get('checkedprices') as $key) {
                $upit = $upit->where("t1.subscription_ID", $key);
            }
        }
        if($req->get('pressedskills')){
            foreach ($req->get('pressedskills') as $key) {
                $upit = $upit->where("t1.skill_ID", $key);
            }
        }
        $upit = $upit->where('t1.is_removed', 0);
        $upit = $upit->select(
        't1.created_at',
        't1.ID as LectureID',
        't1.lecture_name',
        't1.lecture_description',
        't3.cover_image',
        't10.average_review',
        't8.difficulty',
        't8.price',
        't9.skill_name'
        );
        //
        // paginate -(true/false); perPage - num ; page - num; 
        if($req->has("paginate")) {
            //perPage - broj zapisa po strani
            //page - trenutna strana
            $perPage = $req->has("perPage") ? $req->get("perPage") : 6;
            $page = $req->has("page") ? $req->get("page") : 1;

            $totalCount = $upit->count();

            $upit = $upit->take($perPage);

            $offset = ((int)$page - 1) * $perPage;

            $upit = $upit->skip($offset);

            $pagedResponse = new \stdClass();

            $pagedResponse->items = $upit->get();

            $pagedResponse->pagesCount = ceil($totalCount / $perPage);
            $pagedResponse->page = (int)$page;
            return $pagedResponse;
        }
        return $upit->get();
    }
    public static function LecturesByReviewValue($value){
        $upit = DB::table('lectures as t1')
        ->join('reviews as t2','t2.lecture_ID','=','t1.ID')
        ->where('t1.is_removed', 0)
        ->where('t2.review_value', $value)
        ->select()->get();
        return $upit;
    }
    public static function SubByID($ID){
        $upit = DB::table('lectures as t1')
        ->join('subscriptions as t2','t1.subscription_ID','=','t2.ID')
        ->where('t1.ID', $ID)
        ->select('t1.ID as lectureID','t2.difficulty')
        ->first();
        return $upit;
    }
    public static function LectureAverage($ID){
        $upit = DB::table('lectures as t1')
        ->join('lecture_reviews as t2','t1.ID','=','t2.lecture_ID')
        ->where('t1.ID', $ID)
        ->select('t2.*')
        ->first();
        return $upit;
    }
    public static function LectureCommentsWithReplays($ID){
       // dd($ID);
        $comments = DB::table('lectures as t1') 
            ->join('comments AS base_comment','t1.ID','=','base_comment.lecture_ID')
            ->leftJoin('comments AS reply', 'base_comment.ID', '=', 'reply.parent_ID')
            ->leftJoin('users AS base_user', 'base_comment.user_ID', '=', 'base_user.ID')
            ->leftJoin('users AS reply_user', 'reply.user_ID', '=', 'reply_user.ID')
            ->select(
                'base_comment.ID AS base_comment_id',
                'base_comment.text AS base_comment_text',
                'base_user.photo AS base_user_photo',
                'base_user.username AS base_user_username',
                'reply.ID AS reply_comment_id',
                'reply.text AS reply_comment_text',
                'reply_user.photo AS reply_user_photo',
                'reply_user.username AS reply_user_username',
                    )
            ->where('base_comment.lecture_ID', $ID)
            ->orderBy('base_comment.ID')
            ->orderBy('reply.ID')
            ->get();
                // 
                $commentsArray = [];
                    foreach ($comments as $comment) {
                        if (!isset($commentsArray[$comment->base_comment_id])) {
                            $commentsArray[$comment->base_comment_id] = [
                                'base_comment_id' => $comment->base_comment_id,
                                'base_comment_text' => $comment->base_comment_text,
                                'base_user_photo' => $comment->base_user_photo,
                                'base_user_username' => $comment->base_user_username,
                                'replies' => []
                            ];
                        }

                        if ($comment->reply_comment_id) {
                            $commentsArray[$comment->base_comment_id]['replies'][] = [
                                'reply_comment_id' => $comment->reply_comment_id,
                                'reply_comment_text' => $comment->reply_comment_text,
                                'reply_user_photo' => $comment->reply_user_photo,
                                'reply_user_username' => $comment->reply_user_username,

                            ];
                        }
                    }
        return $commentsArray;
    }
    public static function LecturesWithQuestions(){
        $lectures = DB::table('lectures as l')
        ->select('l.ID as lecture_ID', 'l.lecture_name', 'h.cover_image', 'c.name as category', 'q.num_of_questions')
        ->leftJoin('historical_data as h', 'l.his_data_ID', '=', 'h.ID')
        ->leftJoin('categories as c', 'c.ID', '=', 'l.category_ID')
        ->leftJoin(DB::raw('(SELECT lecture_ID, COUNT(ID) as num_of_questions FROM questions GROUP BY lecture_ID) as q'), 'l.ID', '=', 'q.lecture_ID')
        ->whereNotNull('q.num_of_questions');
        return $lectures;
    }
  
    
}
