<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use Session;

use App\Models\Gig;
use App\Models\User;
use App\Models\Myorder;

class HomesController extends Controller {
    
    
    public function index(){ 

       $pageTitle = 'Welcome';
       $gigcatlist = Gig::where(['status'=>1])->orderBy('id', 'ASC')->limit(15)->get();
       $mysavegigs = $this->getSavedGigs();
       $recentCompletedlist  = Myorder::with('Gig')->whereHas('Gig', function($q){$q->where('title', '!=', ''); })->where('status', 2)->orderBy('id', 'ASC')->limit(16)->get();
       if(Session::get('user_id')){
           $loginuser = User::where(['id'=>Session::get('user_id')])->first();
           return view('homes.loginindex', ['title' => $pageTitle, 'loginuser'=>$loginuser, 'gigcatlist'=>$gigcatlist, 'mysavegigs'=>$mysavegigs, 'recentCompletedlist'=>$recentCompletedlist]);
       }else{
           $testimonils = DB::table('testimonials')->where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
           return view('homes.index', ['title' => $pageTitle, 'fixheader'=>1, 'gigcatlist'=>$gigcatlist, 'mysavegigs'=>$mysavegigs, 'recentCompletedlist'=>$recentCompletedlist, 'testimonils'=>$testimonils]);     
       }
       
    }
    public function home(){ 
       $pageTitle = 'Welcome';   
       
    }
    
    public function categories(){ 
       $pageTitle = 'Explore Jobs by Categories';   
       $categories = DB::table('categories')->where(['status'=>1, 'parent_id'=>0])->get(); 
       return view('homes.categories', ['title' => $pageTitle, 'categories'=>$categories]);    
    }
    
    
    public function sendmail(){   
       $uname = array('uname' => 'dinesh'); 
       Mail::send('emails.welcome', $uname, function($message) use ($uname)
        {
            $message->setSender(array('dinesh.dhaker@logicspice.com' => 'Demo'));
            $message->setFrom(array('dinesh.dhaker@logicspice.com' => 'Demo'));
            $message->to('dinesh.dhaker@logicspice.com', 'John Smith')->subject('Welcome!');
        });
        $email_address = 'dinesh.dhaker@logicspice.com';
         if (count(Mail::failures()) > 0) {
                    echo $errors = 'Failed to send password reset email, please try again.';
                    foreach (Mail::failures() as $email_address) {
                        echo " - $email_address <br />";
                    }
                }
        echo 'ff';
    }
}
?>