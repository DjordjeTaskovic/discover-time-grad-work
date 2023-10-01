<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\LectureUser;
use App\Models\Notification;
use App\Models\Panel;
use App\Models\Review;
use App\Models\Score;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function u_dashboard(){
        
        $this->data['user'] = session()->get("user");
       
        return view('dashboard.user_pages.user', $this->data);
    }
    public function u_user_update(Request $request){
      
        $request->validate([
            "username"=>"min:3|max:35|required",
            "email"=>"email|required",
            "phone"=>"max:10",
            "password"=>"max:15",
            "re_password"=>"same:password",
            "profile"=>"mimes:jpeg,jpg,png,gif",
        ]);
        
            DB::beginTransaction();
            try
            {
                User::where('ID','=',$request->ID)
                    ->update([
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    ]);

                $pass = md5($request->password);

                if(!$request->password == null){
                    User::where('ID','=', $request->ID)
                    ->update([
                    'password'=>$pass
                    ]);
                 }
                 if(!$request->profile == null){
                    $imgname = $request->profile->getClientOriginalName();
                    $request->profile->move(public_path().'/assets/images/profile/', $imgname);
    
                    User::where('ID','=', $request->ID)
                    ->update([
                    'photo' => $imgname
                    ]);
                 }
                
                 DB::commit();
                 return redirect()->route("u_dashboard");
             }
             catch(\Exception $e)
             {
                 DB::rollBack();
                // dd($e->getMessage());
                 return redirect()->route('error')->with('errorMessage', 'An error occurred!');
             }
    }
    //user lectures index
    public function u_lectures(){
        
        $this->data['items'] = User::userLectures(session('user')->ID, "non_archived")->get();
        foreach ($this->data['items'] as $value) {
            $value->user_rev_check = Lecture::LectureReview($value->ID, session('user')->ID) == null;
        }
       
        return view('dashboard.user_pages.lectures', $this->data);
    }
    // user Lecture show
    public function u_lecture($ID){
       
        $this->data['his_data'] = Lecture::getLectureID($ID);
        $this->data['user_score'] = Score::UserLectureSum(session('user')->ID, $ID);
        $this->data['review']  = Lecture::LectureReview($ID , session('user')->ID);
      
        return view('dashboard.user_pages.lecture_single', $this->data);
    }

    public function u_lecture_favorite($id, $parameter){
      
        
        DB::beginTransaction();
        try {
            if ($parameter == 'add_favorite') {
                LectureUser::where('lecture_ID', $id)->update(['is_favourite'=> 1]);
                $msg = 'Lecture is added to favorites!';
            }
            if ($parameter == 'un_favorite'){
                LectureUser::where('lecture_ID', $id)->update(['is_favourite'=> 0]);
                $msg = 'Lecture is removed from favorites!';
            }
            DB::commit();
            return redirect()->route('u_lectures')->with('success', $msg);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
           // dd($e->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
    }
    //updateing is_removed 
    public function u_lecture_archive($id,$parameter){
     
        DB::beginTransaction();
        try {
            if ($parameter == 'add_archived') {
                LectureUser::where('lecture_ID', $id)->update(['is_archived'=> 1]);
                $msg = 'Lecture is archived!';
            }
            if ($parameter == 'un_archived'){
                LectureUser::where('lecture_ID',$id)->update(['is_archived'=> 0]);
                $msg = 'Lecture removed from archive!';
            }
            DB::commit();
            return redirect()->route('u_lectures')->with('success', $msg);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            //dd($e->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
    }
    public function u_reviews(){
        if(session("user")){
            $ID = session("user")->ID;
        }
        $this->data['revs'] = Review::RevLecture($ID);
        return view('dashboard.user_pages.review', $this->data);
    }
    public function u_lecture_favorites(){
        if(session("user")){
            $ID = session("user")->ID;
        }
        $this->data['favorites'] = User::userLectures($ID, "favorites")->paginate(4);
        return view('dashboard.user_pages.lecture_favorites', $this->data);

    }
    public function u_lecture_archived(){
        if(session("user")){
            $ID = session("user")->ID;
        }
        $this->data['archived'] = User::userLectures($ID, "archived")->paginate(4); 
      
        return view('dashboard.user_pages.lecture_archived', $this->data);

    }

    public function u_sub_details($ID){
      
        $this->data['subscription'] = Subscription::UserSub($ID);
        return view('dashboard.user_pages.sub_details', $this->data);

    }
   
    public function leave_review(Request $req){
        $req->validate([
            'rate'=>'required|numeric|not_in:0',
            'text'=>'required'
        ]);
        
        DB::beginTransaction();
       try {
            $ratingValue = (int)$req->rate; 
          
            if($ratingValue == 1){
                DB::table('lecture_reviews')
            ->where('lecture_ID', $req->lecture_ID)
            ->update([
                'review_count1' => DB::raw('review_count1 + 1'),
                'total_review_count' => DB::raw('total_review_count + 1'),
                'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
            ]);
            }
            if($ratingValue == 2){
                DB::table('lecture_reviews')
            ->where('lecture_ID', $req->lecture_ID)
            ->update([
                'review_count2' => DB::raw('review_count2 + 1'),
                'total_review_count' => DB::raw('total_review_count + 1'),
                'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
            ]);
            }
            if($ratingValue == 3){
                DB::table('lecture_reviews')
            ->where('lecture_ID', $req->lecture_ID)
            ->update([
                'review_count3' => DB::raw('review_count3 + 1'),
                'total_review_count' => DB::raw('total_review_count + 1'),
                'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
            ]);
            }
            if($ratingValue == 4){
                DB::table('lecture_reviews')
            ->where('lecture_ID', $req->lecture_ID)
            ->update([
                'review_count4' => DB::raw('review_count4 + 1'),
                'total_review_count' => DB::raw('total_review_count + 1'),
                'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
            ]);
            }
            if($ratingValue == 5){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count5' => DB::raw('review_count5 + 1'),
                    'total_review_count' => DB::raw('total_review_count + 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
            }

            DB::table("reviews")->insert([
                'user_ID'=>session("user")->ID,
                'lecture_ID'=> $req->lecture_ID,
                'review_value'=>$req->rate,
                'text'=>$req->text
            ]);

            DB::commit();
            Panel::lognote("User has left a review on a lecture.", false);
            return redirect()->route('u_lecture',['ID'=>$req->lecture_ID])->with(['message'=>'Thank you for leaving the review!']);

       } catch (\Throwable $th) {
            DB::rollBack();
           // dd($th->getMessage());
            return redirect()->route('error');
       }
      
        
    }
    public function u_update_review(Request $req){
       
        $req->validate([
            'rate'=>'required|numeric|not_in:0',
            'text'=>'required'
        ]);
   
        if(session()->has('user')){

            DB::beginTransaction();
            try {
                //downgrade tha star column
                $pastrating = DB::table('reviews as r')
                ->where('r.ID','=',$req->RevID)
                ->select('r.review_value')
                ->first();
                

                if($pastrating->review_value == 1){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count1' => DB::raw('review_count1 - 1'),
                    'total_review_count' => DB::raw('total_review_count - 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($pastrating->review_value == 2){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count2' => DB::raw('review_count2 - 1'),
                    'total_review_count' => DB::raw('total_review_count - 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($pastrating->review_value == 3){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count3' => DB::raw('review_count3 - 1'),
                    'total_review_count' => DB::raw('total_review_count - 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($pastrating->review_value == 4){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count4' => DB::raw('review_count4 - 1'),
                    'total_review_count' => DB::raw('total_review_count - 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($pastrating->review_value == 5){
                        DB::table('lecture_reviews')
                    ->where('lecture_ID', $req->lecture_ID)
                    ->update([
                        'review_count5' => DB::raw('review_count5 - 1'),
                        'total_review_count' => DB::raw('total_review_count - 1'),
                        'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                    ]);
                }
              



                //upgrade the star coulumn
                $ratingValue = (int)$req->rate; 
                if($ratingValue == 1){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count1' => DB::raw('review_count1 + 1'),
                    'total_review_count' => DB::raw('total_review_count + 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($ratingValue == 2){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count2' => DB::raw('review_count2 + 1'),
                    'total_review_count' => DB::raw('total_review_count + 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($ratingValue == 3){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count3' => DB::raw('review_count3 + 1'),
                    'total_review_count' => DB::raw('total_review_count + 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($ratingValue == 4){
                    DB::table('lecture_reviews')
                ->where('lecture_ID', $req->lecture_ID)
                ->update([
                    'review_count4' => DB::raw('review_count4 + 1'),
                    'total_review_count' => DB::raw('total_review_count + 1'),
                    'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                ]);
                }
                if($ratingValue == 5){
                        DB::table('lecture_reviews')
                    ->where('lecture_ID', $req->lecture_ID)
                    ->update([
                        'review_count5' => DB::raw('review_count5 + 1'),
                        'total_review_count' => DB::raw('total_review_count + 1'),
                        'average_review' => DB::raw('(5 * review_count5 + 4 * review_count4 + 3 * review_count3 + 2 * review_count2 + 1 * review_count1) / total_review_count')
                    ]);
                }
    
                //
            DB::table("reviews")
            ->where('ID','=',$req->RevID)
            ->update([
                    'review_value'=>$req->rate,
                    'text'=>$req->text
            ]);

            DB::commit();
            return back();

            }  
            catch (\Throwable $th) {
            DB::rollBack();
          //  dd($th->getMessage());
            return redirect()->route('error');
            }
        }

    }

    public function u_calendar(){

        $this->data['calendar'] = LectureUser::GetCalendarEvents(session('user')->ID);
        
        return view('dashboard.user_pages.list_calendar', $this->data);
    }

    public function u_calendar_event_form(){
        
        $this->data['lectures'] = LectureUser::GetLecuresByUser(session('user')->ID);
    
        return view('dashboard.user_pages.calendar_event_form',$this->data);
    }

    public function u_add_calendar_event_form(Request $req){
        $req->validate([
            'name'=>'required|max:50',
            'start_date'=>'required|date',
            'end_date'=>'date',
            'start_time'=>'required',
            'lecture.*'=>'required|not_in:0'

        ]);
        DB::beginTransaction();
        try {
            //if user has lecture as seen
            $lectureForUser = DB::table("lecture_users")
                            ->where('user_ID',session('user')->ID)
                            ->where('lecture_ID', $req->lecture[0])
                            ->select()
                            ->first();
          
                if($lectureForUser != null){
                    DB::table("calendar_events")->insert([
                        'lecture_user_ID'=>$lectureForUser->ID,
                        'name'=>$req->name,
                        'start_date'=>$req->start_date,
                        'end_date'=>$req->end_date,
                        'start_time'=>$req->start_time,
                        'end_time'=>$req->end_time,
                    ]);
            }

            DB::commit();
            return redirect()->route('u_calendar_event_form')->with('success', 'Data added successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();
          //  dd($th->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
        
    }
    public function u_add_comment(Request $req){
        $req->validate([
            'comment'=>'required|min:10',
        ]);
    
        DB::beginTransaction();
        try {
            if(session()->has('user')){
                    if($req->comment_type == "base_comment"){
                        DB::table("comments")->insert([
                            'text'=>$req->comment,
                            'lecture_ID'=>$req->lecture_ID,
                            'user_ID'=>session('user')->ID
                        ]);
                    }
                    else{
                       
                        DB::table("comments")->insert([
                            'text'=>$req->comment,
                            'user_ID'=>session('user')->ID,
                            'parent_ID'=>$req->comment_ID
                        ]);
                    }
                    DB::commit();
                    Panel::lognote("A user has left a comment on a lecture.", false);
                    return redirect()->route('lecture_details',['ID'=>$req->lecture_ID])->with('comm-success', 'Data added successfully!');
            }
            return redirect()->route('lecture_details',['ID'=>$req->lecture_ID])->with('comm-warning', 'Your not logged in to preform ths action.');

        } catch (\Throwable $th) {
            DB::rollBack();
          //  dd($th->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }
        
    }
    public function u_membership(){
        $this->data['subs'] = Subscription::SubUser(session("user")->ID);
        return view('dashboard.user_pages.membership',$this->data);
    }
    public function u_sub_remove($sub_ID){

        try {
         
            if(session()->has('user')){
                $user_ID = session('user')->ID;
                UserSubscription::RemoveSub($user_ID, $sub_ID);
                Panel::lognote("A user has removed a subscription.", false);
            }
            return redirect()->route('u_membership')->with('message', 'The subscription has beed removed.');
        } catch (\Throwable $th) {
            DB::rollBack();
               // dd($th->getMessage());
            return redirect()->route('error')->with('errorMessage', 'An error occurred!');
        }

    }
    public function u_notifications(){
        if(session()->has('user')){
            $usedID =session('user')->ID;
        }
        $this->data['notifications']= Notification::notiByUserID($usedID);
        return view('dashboard.user_pages.notifications',$this->data);
    }
                //////
    public function u_notification_mark_read(Request $req){
    
        DB::table('notifications')
        ->where("ID",$req->noti_ID)->update([
            'is_read'=> 1
        ]);
        return back();
    }

}
