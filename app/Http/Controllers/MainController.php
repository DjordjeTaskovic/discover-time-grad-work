<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Comment;
use App\Models\ContactMails;
use App\Models\Lecture;
use App\Models\LectureSkill;
use App\Models\Notification;
use App\Models\Panel;
use App\Models\Question;
use App\Models\Review;
use App\Models\Score;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Input\Input;

class MainController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(){
        $this->data['Wdata'] = Lecture::DataByCat('World History')->get();
            foreach ( $this->data["Wdata"] as $ele) {
                $ele->tags = Lecture::LectureTags($ele->LectureID)->get();
                $ele->revs_count = Lecture::LectureReviews($ele->LectureID)->get()->count();
            }
      
        $this->data['Wstdata'] = Lecture::DataByCat('Western History')->get();
            foreach ( $this->data["Wstdata"] as $ele) {
                $ele->tags = Lecture::LectureTags($ele->LectureID)->get();
                $ele->revs_count = Lecture::LectureReviews($ele->LectureID)->get()->count();
            }
        $this->data['Estdata'] = Lecture::DataByCat('Southeast Asian History')->get();
            foreach ( $this->data["Estdata"] as $ele) {
                $ele->tags = Lecture::LectureTags($ele->LectureID)->get();
                $ele->revs_count = Lecture::LectureReviews($ele->LectureID)->get()->count();
            }
        $this->data['test'] = User::UserTest();
        $this->data['categories'] = Category::all();
        $this->data['lecture_count'] = Lecture::count();
        
        $this->data['rated_data'] = Lecture::RatedLectures();
            foreach ( $this->data["rated_data"] as $ele) {
                $ele->revs_count = Lecture::LectureReviews($ele->LectureID)->get()->count();
            }
       
        return view('pages.main.home',$this->data);
    }

    public function lectures(){
        //upper part
        $this->data['lecture_count'] = Lecture::where('is_removed', 0)->count();
        
        $this->data['rated_data'] = Lecture::RatedLectures();
            foreach ( $this->data["rated_data"] as $ele) {
                $ele->comment_count = Lecture::CommCount($ele->LectureID)->count();
                $ele->revs_count = Lecture::LectureReviews($ele->LectureID)->get()->count();
            }
        $this->data['count_4_ratings'] = Lecture::LecturesByReviewValue(4)->count();
        $this->data['count_3_ratings'] = Lecture::LecturesByReviewValue(3)->count();
        $this->data['count_2_ratings'] = Lecture::LecturesByReviewValue(2)->count();

        $this->data['categories'] = Category::all();
            foreach ( $this->data["categories"] as $ele) {
                $ele->lectures_count = Category::catLecturesByID($ele->ID)->count();
            }          
        $this->data['skills'] = LectureSkill::all();
            foreach ( $this->data["skills"] as $ele) {
                $ele->lectures_count = LectureSkill::skillLecturesByID($ele->ID)->count();
            }
        $this->data['prices'] = Subscription::all();
            foreach ( $this->data["prices"] as $ele) {
                $ele->lectures_count = Subscription::subLecturesByID($ele->ID)->count();
            }
        $this->data['tags'] = Tag::all();
        return view('pages.main.lectures',  $this->data);
    }

    public function lectures_ajax(Request $req)
	{
       $lectures = Lecture::LecturesBySort($req);
       foreach ($lectures->items as $ele) {
           $ele->comment_count = Comment::GetByLectureID($ele->LectureID)->count();
       }
        return response()->json($lectures);
    }


    public function lecture_details($ID){
        $this->data['lecture'] = Lecture::getmainLectureID($ID);
        $this->data['lecture']->reviews = Lecture::LectureReviews($ID)->get();
        $this->data['lecture']->avg = Lecture::LectureAverage($ID);
        $this->data['lecture']->comments = Lecture::LectureCommentsWithReplays($ID);
        
        return view('pages.main.lecture_details', $this->data);
    }
    public function about(){
        $this->data['test'] = User::UserTest();
        return view("pages.main.about",$this->data);
    }
    public function contact_us(){
        return view("pages.main.contact_us",$this->data);
    }
    public function faq(){
        $this->data['categories'] = Category::all();
        return view("pages.main.faqpage",$this->data);
    }

    public function contact_request(Request $req){
        $req->validate( [
            'name' => 'required|max:50|min:2',
            'email' => 'required|email',
            'subject' => 'required|max:50|min:2',
            'message' => 'required|max:255|min:2'
        ]);
       
        DB::beginTransaction();
        try {
            ContactMails::make_message($req);
            DB::commit();
            return redirect()->route("contact_us")->with('message','Your message has been sent.');
            Notification::message(session('user')->ID,'Contact submition',"You have send a contact message to our company. 
            We will make sure to respond to it as fast as we can.");
        } catch (\Throwable $th) {
            DB::rollBack();
             //dd($th->getMessage());
             return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
    }
    public function enroll_lecture($lectureID){
        if(session()->has('user')){
            $lecture_sub = Lecture::SubByID($lectureID);
            $user_subs = [];
                foreach (session('user')->subscriptions as $ele) {
                array_push($user_subs, $ele->difficulty);
                }

            //true if the sub is not in the array
            if(!in_array($lecture_sub->difficulty, $user_subs)){
                return redirect()->route("membership")->with('message','You do not have the subsctiption bought for this lecture.');
            }
            else{
                //    if(!session('user')->admin_role){
                // check if the selected lecture is already seen by user
                   $confirm = DB::table('lecture_users')
                                   ->where('lecture_ID', $lectureID)
                                   ->where('user_ID',session('user')->ID)
                                   ->select()
                                   ->get();
                 
                   if(count($confirm) == 0){
                       DB::table("lecture_users")->insert([
                           'lecture_ID'=> $lectureID,
                           'user_ID'=> session('user')->ID,
                       ]);
                   }
            //    }
               
                return redirect()->route("lecture_content", ['id' => $lecture_sub->lectureID]);
            }
        }
        else{
            return redirect()->route("loginpage")->with('message','You have to be logged in presue this action.');
        }
    }

    public function membership(){
        $this->data['subs'] = Subscription::all();
        return view("pages.main.membership", $this->data);
    }
    public function membership_checkout($id){
        $this->data['sub'] = Subscription::find($id);
        $user_subs = [];
            $subs_by_user = Subscription::SubUser(session('user')->ID); 
                foreach ($subs_by_user as $ele) {
                array_push($user_subs, $ele->difficulty);
                }

            if(in_array($this->data['sub']->difficulty, $user_subs)){
                return redirect()->route("membership")->with('message','You already have this membership option selected.');
            }
        
            $this->data['addresar'] = User::getCountries();
        return view("pages.main.checkout", $this->data);

    }
    public function purchase_subscription(Request $req){
     
        $req->validate([
            'country.*' => 'required|not_in:0',
            'card_name'=>'required',
            'cvc'=>'required|min:3|numeric',
            'card_number' => 
                array(
                    'required',
                    'regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/'
                ),
                'expiry_date' => 
                array(
                    'required',
                    'regex:/^(0?[1-9]|1[0-2])\/(2[4-9]|[3-9]\d)$/'
                )
        ]);

     

        DB::beginTransaction();
        try {
                $user_Sub_ID = DB::table("user_subscriptions")->insertGetId([
                    'subscription_ID'=>$req->id,
                    'user_ID'=>session("user")->ID
                ]);
                DB::commit();

                DB::table("user_sub_payment")->insert([
                    'user_sub_ID'=>$user_Sub_ID,
                    'country'=>$req->country[0],
                    'card_name'=>$req->card_name,
                    'card_number'=>$req->card_number,
                    'expiry_date'=>$req->expiry_date,
                    'cvc'=>$req->cvc
                ]);
                return redirect()->route("membership")->with('message', 'Subscription added successfully!');
                Panel::lognote("A user has succesfully added a Subscription.", false);
        } catch (\Throwable $th) {
            DB::rollBack();
           // dd($th->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
       
        ///Insert podataka
    }
    public function lecture_content($ID){
        
        $this->data['lecture'] = Lecture::getmainLectureID($ID);
        $this->data['lecture']->images = Lecture::LectureImages($ID);
      
         return view("pages.main.lecture_content", $this->data);
    }

    public function lecture_content_finished($LectureID){
        //admin can go threww this without baing recorded in DB
        // if(!session('user')->admin_role){
            $userID = session('user')->ID;
            DB::table('lecture_users')
            ->where(function($query) use ($LectureID, $userID) {
                $query->where('lecture_ID', $LectureID)
                    ->where('user_ID', $userID);
            })->update(['is_finished' => 1]);

            Notification::message($userID,'Lecture Completed!','You have completted a lecture, that realy cool.
             Head over to quizzes and test you newly gained knowlagge!');
        // }
        return redirect()->route("u_lecture", ['ID'=> $LectureID]);
    }
    public function quizzes(){
        
         $this->data['quizzes'] = Lecture::LecturesWithQuestions()->paginate(6);
         return view("pages.main.quizzes", $this->data);
    }
    //
    public function quiz_details($lecture_ID){
        $this->data['quizzes'] = Lecture::LecturesWithQuestions()->paginate(3);
        $this->data['lecture'] = Lecture::getmainLectureID($lecture_ID);
        $this->data['questions'] = Question::select('ID', 'text AS question')->where('lecture_ID', $lecture_ID)->get();
            foreach ($this->data['questions']  as  $ele) {
                $ele->answers = Answer::select('ID','text as answer','is_correct')->where('question_ID', $ele->ID)->get();
        }
        $this->data['nextAttemptTime'] = DB::table("scores")
            ->where('user_ID', session('user')->ID)
            ->where('lecture_ID', $lecture_ID)
            ->orderByDesc('attempt_num') 
            ->value('next_attempt_time');

            date_default_timezone_set('Europe/Belgrade');
          
        return view('pages.main.quiz_details', $this->data);
    }
    //
    public function ajax_quiz(Request $req){
        date_default_timezone_set('Europe/Belgrade');
       
       if(session()->has('user')){
        DB::beginTransaction();
            try {
                 // LectureID: "4"
                // checkedanswers: [ "45", "48", "50", … ]
                $lecture_ID = $req->LectureID;
                $checkedanswers = $req->checkedanswers;
               

                //attempt settings
                $previousAttempt = DB::table("scores")
                ->where('user_ID',session('user')->ID)
                ->where('lecture_ID',$lecture_ID)
                ->orderByDesc('attempt_num')
                ->select('attempt_num')
                ->first();

                $attempt = 1;

                if(!$previousAttempt == null){
                    $attempt = $previousAttempt->attempt_num + 1;
                }

                //next_attempt_time settings

                //delayMinutes is always set to 5 minutes
                $delayMinutes = 5;
                $currentTimestamp = strtotime('now');
                $nextAttemptTime = date('Y-m-d H:i:s', $currentTimestamp + ($delayMinutes * 60));
           

                $totalScore = 0;
                $maxPossibleScore = 0;
                // $correctAnswers = [];
                //$wrongAnswers = [];
                $correctQuestionIds = [];
                $wrongQuestionIds = [];
                foreach ($checkedanswers as $answerId) {
                    $answer = Answer::find($answerId);
                    if ($answer) {
                        $maxPossibleScore += 5.5;
                        if ($answer->is_correct) {
                            $totalScore += 5.5;
                        //  $correctAnswers[] = $answer;
                        $correctQuestionIds[] = $answer->question_ID;
                        } else {
                            // $wrongAnswers[] = $answer;
                            $wrongQuestionIds[] = $answer->question_ID;
                        }
                    }
                }
                $currentPercentage = ($totalScore / $maxPossibleScore) * 100;
                $wrongQuestions = Question::whereIn('id', $wrongQuestionIds)->select('text as question, ID')->get();
                $correctQuestions = Question::whereIn('id', $correctQuestionIds)->select('text as question','ID')->get();
                
              DB::table('scores')->insert([
                'lecture_ID'=>$lecture_ID,
                'user_ID'=>session("user")->ID,
                'score_value'=>$totalScore,
                'completion_precent'=> $currentPercentage,
                'attempt_num'=> $attempt,
                'next_attempt_time' => $nextAttemptTime,
               ]);
               DB::commit();
               Panel::lognote("A user has completed a quiz on the site.", false);

               Notification::message(session("user")->ID,'Quiz complete!','We hope that you got desired results on a quiz. 
               Head over to score board and see how it went.');

            $result = [ "totalScore" => $totalScore,
                        "currentPercentage"=> $currentPercentage,
                        "wrongQuestions"=> $wrongQuestions,
                        "correctQuestions"=>$correctQuestions,
                        "lecture_ID"=>$lecture_ID
            ];

             return response()->json($result);

            } catch (\Throwable $th) {
                DB::rollBack();
                // dd($th->getMessage());
                 return redirect()->route('error')->with('errorMessage', 'An error occurred!');
            }
       }
       else{
        return redirect()->route('loginpage')->with('errorMessage', 'You are not autorized for this action. Make sure to sign up first.');
       }
       
    

       
    }
    public function private_policy(){
        return view('pages.main.private_policy',$this->data);
    }
    
    public function score_board(){

        $this->data['test'] = User::UserTest();

        $this->data['users'] = User::UsersWithScores();
        foreach ($this->data['users'] as  $value) {
           $value->scores =  Score::UserSum($value->userID);
           $value->total =  Score::ScoreSUMByUser($value->userID);
        }
        
        $this->data['sortedusers'] = $this->data['users']->sortByDesc(function ($user) {
            // Assuming the 'total_score' is always present in the 'total' object as you described
            return $user->total[0]->total_score;
        })->values();

        return view('pages.main.score_board',$this->data);
    }
    public function author(){
        
        return view("pages.other.author",$this->data);
    }
  
    
}
