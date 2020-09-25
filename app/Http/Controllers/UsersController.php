<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Session;
use App\Events\NewMessage;
use Redirect;
use Input;
use Validator;
use DB;
use Mail;
use App\Mail\SendMailable;
use Socialite;
use App\Models\User;
use App\Models\Service;
use App\Models\Myorder;
use App\Models\Image;
use App\Models\Gig;
use App\Models\Message;
use App\Models\Country;
use App\Models\Review;
use App\Models\Notification;

class UsersController extends Controller {
    public function __construct() {
        $this->middleware('userlogedin', ['only' => ['login', 'forgotPassword', 'resetPassword', 'register','auth']]);
        $this->middleware('is_userlogin', ['except' => ['logout', 'login','forgotPassword', 'resetPassword', 'redirectToGoogle', 'handleGoogleCallback', 'redirectToFacebook', 'handleFacebookCallback', 'redirectToLinkedin', 'handleLinkedinCallback', 'register', 'sociallogin','emailConfirmation', 'publicprofile']]);
    }
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email_address', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...
    //         dd(Auth::user());
    //     }
    // }
    public function login(Request $request) {
        $pageTitle = 'Login';
        $input = Input::all();
        if (!empty($input)) {
            $rules = array(
                // 'email_address' => 'required|email',
                'email_address' => 'required',
                'password' => 'required'
            );
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return Redirect::to('/login')->withErrors($validator)->withInput(Input::except('password'));
            } else {
                // $userInfo = User::where('email_address', $input['email_address'])->orWhere('user_name', $input['email_address'])->first();
                
                // if(filter_var(request('email_address'), FILTER_VALIDATE_EMAIL)){
                //     $credentials = $request->only('email_address', 'password');
                // } else { 
                //     $request->input('user_name') = $request->input('email_address');
                //     $credentials = $request->only('user_name', 'password');
                // }
                $username = $request->input('email_address');
                $password = $request->input('password');
                
                if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
                    //user sent their email 
                    Auth::attempt(['email_address' => $username, 'password' => $password]);
                } else {
                    //they sent their username instead 
                    Auth::attempt(['user_name' => $username, 'password' => $password]);
                }
                if (Auth::check()) {
                    // Authentication passed...
                    $userInfo = Auth::user();
                    if ($userInfo->status == 1 && $userInfo->activation_status == 1) {
                        if (isset($input['user_remember']) && $input['user_remember'] == '1') {
                            Cookie::queue('user_email_address', $userInfo->email_address, time() + 60 * 60 * 24 * 7, "/");
                            Cookie::queue('user_password', $input['password'], time() + 60 * 60 * 24 * 7, "/");
                            Cookie::queue('user_remember', '1', time() + 60 * 60 * 24 * 100, "/");
                        } else {
                            Cookie::queue('user_email_address', '', time() + 60 * 60 * 24 * 7, "/");
                            Cookie::queue('user_password', '', time() + 60 * 60 * 24 * 7, "/");
                            Cookie::queue('user_remember', '', time() + 60 * 60 * 24 * 7, "/");
                        }
                        Session::put('user_id', $userInfo->id);
                        Session::put('user_name', ucwords($userInfo->first_name . ' ' . $userInfo->last_name));
                        Session::put('email_address', $userInfo->email_address);
                        return Redirect::to('users/dashboard');
                    } else if ($userInfo->status == 1 && $userInfo->activation_status == 0) {
                        $error = 'You need to activate your account before login.';
                    } else if ($userInfo->status == 0 && $userInfo->activation_status == 0) {
                        $error = 'Your account might have been temporarily disabled. Please contact us for more details.';
                    }else if ($userInfo->status == 0 && $userInfo->activation_status == 1) { 
                        $error = 'Your account might have been temporarily disabled. Please contact us for more details.';
                    }
                } else {
                    $error = "Invalid Username or Password!";
                }  
                return Redirect::to('/login')->withErrors($error)->withInput(Input::except('password'));
            }
        }
        return view('users.login', ['title' => $pageTitle]);
    }
    public function forgotPassword() {
        $pageTitle = 'Forgot Password';
        $input = Input::all();
        if (!empty($input)) {
            $rules = array(
                'email_address' => 'required|email',
            );
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return Redirect::to('/forgot-password')->withErrors($validator);
            } else {
                $userInfo = User::where('email_address', $input['email_address'])->first();
                if (!empty($userInfo)) {
                    $uniqueKey = bin2hex(openssl_random_pseudo_bytes(25));
                    User::where('id', $userInfo->id)->update(array('forget_password_status' => 1, 'unique_key' => $uniqueKey));

                    $link = HTTP_PATH . "/reset-password/" . $uniqueKey;
                    $name = ucwords($userInfo->first_name . ' ' . $userInfo->last_name);
                    $emailId = $userInfo->email_address;
                    $emailTemplate = DB::table('emailtemplates')->where('id', 4)->first();
                    $toRepArray = array('[!username!]', '[!link!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
                    $fromRepArray = array($name, $link, HTTP_PATH, SITE_TITLE);
                    $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
                    $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
                    Mail::to($emailId)->send(new SendMailable($emailBody, $emailSubject));
                    Session::flash('success_message', "A link to reset your password was sent to your email address.");
                    return Redirect::to('/login');
                } else {
                    $error = 'Please enter valid email address.';
                }
                return Redirect::to('/forgot-password')->withErrors($error);
            }
        }
        return view('users.forgotPassword', ['title' => $pageTitle]);
    }

    public function resetPassword($ukey = null) {
        $pageTitle = 'Reset Password';
        $userInfo = User::where('unique_key', $ukey)->first();
        if ($userInfo && $userInfo->forget_password_status == 1) {
            $input = Input::all();
            if (!empty($input)) {
                $rules = array(
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|same:password',
                );
                $validator = Validator::make($input, $rules);
                if ($validator->fails()) {
                    return Redirect::to('/reset-password/'.$ukey)->withErrors($validator);
                }elseif(password_verify($input['password'], $userInfo->password)){
                    return Redirect::to('/reset-password/'.$ukey)->withErrors('You cannot put your old password as new password, please another password.');
                } else {   
                    $new_password = $this->encpassword($input['password']);
                    User::where('id', $userInfo->id)->update(array('forget_password_status' => 0, 'password' => $new_password));
                    Session::flash('success_message', "A link to reset your password was sent to your email address.");
                    return Redirect::to('/login');
                }
            }
            return view('users.resetPassword', ['title' => $pageTitle]);
        } else {
            Session::flash('error_message', "You have already use this link!");
            return Redirect::to('/login');
        }
    }

    public function register() {
        $pageTitle = 'Register';
        $input = Input::all();
        if (!empty($input)) {
            $rules = array(
                'user_name' => 'required|max:15|unique:users',
                'email_address' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password'
            );
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return Redirect::to('/register')->withErrors($validator)->withInput(Input::except('password'));
            } else {
                unset($input['g-recaptcha-response']);
                $input['user_name'] = trim($input['user_name']);
                $serialisedData = $this->serialiseFormData($input);
                $serialisedData['slug'] = $this->createSlug($input['user_name'], 'users');
                $serialisedData['status'] =  0;
                $serialisedData['password'] =  $this->encpassword($input['password']);
                $uniqueKey = bin2hex(openssl_random_pseudo_bytes(25));
                $serialisedData['unique_key'] = $uniqueKey;
                User::insert($serialisedData); 
                
                $link = HTTP_PATH . "/email-confirmation/" . $uniqueKey;
                $name = $input['user_name'];
                $emailId = $input['email_address'];
                $new_password = $input['password'];
               
                $emailTemplate = DB::table('emailtemplates')->where('id', 3)->first();
                $toRepArray = array('[!email!]', '[!username!]', '[!password!]', '[!link!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
                $fromRepArray = array($emailId, $name, $new_password, $link, HTTP_PATH, SITE_TITLE);
                $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
                $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
                Mail::to($emailId)->send(new SendMailable($emailBody,$emailSubject));
                
                Session::flash('success_message', "We have sent you an account activation link by email. Please check your spam folder if you do not receive the email within the next few minutes.");
                return Redirect::to('/login');
            }
        }
        return view('users.register', ['title' => $pageTitle]);
    }
    
    public function emailConfirmation($ukey = null) {
        $userInfo = User::where('unique_key', $ukey)->first();
        if ($userInfo) {
            if($userInfo->activation_status == 1){
                Session::flash('error_message', "You have already use this link!");
            }else{
                User::where('id', $userInfo->id)->update(array('activation_status' => 1, 'status' => 1));
                Session::flash('success_message', "Your Account has been verified Successfully! Please Login");          
            }
        }else{
            Session::flash('error_message', "Invalide URL!");              
        }        
        return Redirect::to('/login');
    }    

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {
            $user = Socialite::driver('google')->user();
            $data = array();
            $data['login_type'] = 'google';
            $data['social_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['avatar_original'] = $user->avatar_original;
            $this->sociallogin($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
            return redirect('google');
        }
    }

    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
            $data = array();
            $data['login_type'] = 'facebook';
            $data['social_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['avatar_original'] = $user->avatar_original;
            $this->sociallogin($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
            return redirect('auth/facebook');
        }
    }
    
    public function redirectToLinkedin() {
        return Socialite::driver('LinkedIn')->redirect();
    }

    public function handleLinkedinCallback() {
        try {
            $user = Socialite::driver('LinkedIn')->user();
            $data = array();
            $data['login_type'] = 'linkedin';
            $data['social_id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['avatar_original'] = $user->avatar_original;
            $this->sociallogin($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
            return redirect('auth/facebook');
        }
    }

    public function sociallogin($data = array()) {
//        $data['login_type'] = 'facebook';
//        $data['social_id'] = '113511857662946434944';
//        $data['name'] = 'Dinesh Dhaker';
//        $data['email'] = 'dinesh.dhaker@logicspice.com';
//        $data['avatar_original'] = 'https://lh6.googleusercontent.com/-ObLBMUQ2GMM/AAAAAAAAAAI/AAAAAAAAAAA/APUIFaOMjcKb7TEXJePyWBT_mkfoYDuVrA/mo/photo.jpg';

        if (Session::has('user_id')){
            if ($data['login_type'] == 'google') {
                User::where('id', Session::get('user_id'))->update(array('google_id' => $data['social_id']));
            }else if ($data['login_type'] == 'facebook') {
                User::where('id', Session::get('user_id'))->update(array('facebook_id' => $data['social_id']));
            }else {
                User::where('id', Session::get('user_id'))->update(array('linkedin_id' => $data['social_id']));
            }
            echo "<script>window.close();window.opener.location.reload();</script>";
            exit;
        }
        
        if(empty($data['email'])){
            Session::flash('error_message', "Social login not return email address, so please try with mnormal login/signup.");
        }else{
            $emailAddress = $data['email'];        
            $userInfo = User::where('email_address', $emailAddress)->first();
            if (!empty($userInfo) && $userInfo->id > 0) {
                if ($userInfo->status == 1) {
                    Session::put('user_id', $userInfo->id);
                    Session::put('user_name', ucwords($userInfo->first_name . ' ' . $userInfo->last_name));
                    Session::put('email_address', $userInfo->email_address);
                    Session::save();
                } else {
                    Session::flash('error_message', "Your account might have been temporarily disabled. Please contact us for more details.");
                }
            } else {
                $nameArray = explode(' ', $data['name']);
                $firstName = array_shift($nameArray);
                $lastName = implode(' ', $nameArray);
                $serialisedData = array();
                $serialisedData['first_name'] = $firstName;
                $serialisedData['last_name'] = $lastName;
                $serialisedData['email_address'] = $data['email'];
                if ($data['login_type'] == 'google') {
                    $serialisedData['google_id'] = $data['social_id'];
                    $serialisedData['facebook_id'] = '';
                    $serialisedData['linkedin_id'] = '';
                } else if ($data['login_type'] == 'facebook') {
                    $serialisedData['facebook_id'] = $data['social_id'];
                    $serialisedData['google_id'] = '';
                    $serialisedData['linkedin_id'] = '';
                } else {
                    $serialisedData['linkedin_id'] = $data['social_id'];
                    $serialisedData['google_id'] = '';
                    $serialisedData['facebook_id'] = '';
                }

                $serialisedData['slug'] = $this->createSlug($data['name'], 'users');
                $serialisedData['status'] = 1;
                $serialisedData['activation_status'] = 1;
                $password = bin2hex(openssl_random_pseudo_bytes(4));
                $serialisedData['password'] = $this->encpassword($password);
                User::insert($serialisedData); 
                
                $userInfo = User::where('email_address', $emailAddress)->first();
                Session::put('user_id', $userInfo->id);
                Session::put('user_name', ucwords($userInfo->first_name . ' ' . $userInfo->last_name));
                Session::put('email_address', $userInfo->email_address);
                Session::save();

                $name = $data['name'];
                $emailId = $data['email'];
                $login_type = $data['login_type'];

                $emailTemplate = DB::table('emailtemplates')->where('id', 5)->first();
                $toRepArray = array('[!email!]', '[!name!]', '[!username!]', '[!password!]', '[!login_type!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
                $fromRepArray = array($emailId, $name, $name, $password, $login_type, HTTP_PATH, SITE_TITLE);
                $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
                $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
                Mail::to($emailId)->send(new SendMailable($emailBody, $emailSubject));
            }
        }
        echo "<script>window.close();window.opener.location.reload();</script>";
        exit;
    }

    public function logout() {
        Session::forget('user_id');
        Session::forget('user_name');
        Session::forget('email_address');
        Session::save();
        Session::flash('success_message', "Logout successfully.");
        return Redirect::to('/login');
    }
    
    public function dashboard() {
        $pageTitle = 'User Dashboard';
        $recordInfo = User::where('id', Session::get('user_id'))->first();
        $skillsList  = DB::table('skills')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','id')->all();
        $countryLists  = DB::table('countries')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','name')->all();
        $qualificationsLists  = DB::table('qualifications')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','name')->all();
        
        $latestservices = Service::where(['status'=>'1'])->where('user_id', '!=' , Session::get('user_id'))->orderBy('id', 'DESC')->limit(10)->get();
        $myorders  = Myorder::where('seller_id', Session::get('user_id'))->orderBy('id', 'DESC')->limit(4)->get();
        $mygigs  = Gig::where(['user_id'=>Session::get('user_id')])->orderBy('id', 'DESC')->limit(5)->get();
        
        return view('users.dashboard', ['title' => $pageTitle, 'recordInfo'=>$recordInfo, 'skillsList'=>$skillsList, 'countryLists'=>$countryLists, 'qualificationsLists'=>$qualificationsLists, 'latestservices'=>$latestservices, 'myorders'=>$myorders, 'mygigs'=>$mygigs]);
    }
    
    public function uploadprofileimage() {
        $input = Input::all();
        if (Input::hasFile('profile_image')) {
            $file = Input::file('profile_image');
            $uploadedFileName = $this->uploadImage($file, PROFILE_FULL_UPLOAD_PATH);
            $this->resizeImage($uploadedFileName, PROFILE_FULL_UPLOAD_PATH, PROFILE_SMALL_UPLOAD_PATH, PROFILE_MW, PROFILE_MH);
            $recordInfo =  User::select('profile_image')->where('id', Session::get('user_id'))->first();
            @unlink(PROFILE_FULL_UPLOAD_PATH.$recordInfo->profile_image);
            @unlink(PROFILE_SMALL_UPLOAD_PATH.$recordInfo->profile_image);
            User::where('id', Session::get('user_id'))->update(array('profile_image' => $uploadedFileName));
            echo $uploadedFileName;
        }
    }
    
    public function updatedata(Request $request) {
        if ($request->has('statusnameid')) {
            User::where('id', Session::get('user_id'))->update(array('user_status' => $request->get('statusnameid')));
        } elseif ($request->has('contact')) {
            User::where('id', Session::get('user_id'))->update(array('contact' => $request->input('contact')));
        } elseif ($request->has('countrynameid')) {
            $countryInfo = DB::table('countries')->where('name', $request->get('countrynameid'))->first();
            User::where('id', Session::get('user_id'))->update(array('country_id' => $countryInfo->id, 'city' => $request->get('city_id'), 'zipcode' => $request->get('zipcode_id')));
        } else if ($request->has('description')) {
            User::where('id', Session::get('user_id'))->update(array('description' => $request->input('description')));
        } else if ($request->get('lang_name')) {
            $lang_name = $request->get('lang_name');
            $lang_level = $request->get('lang_level');
            $lang_old = $request->get('lang_old');
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $languagesArray = array();
            if ($recordInfo->languages) {
                $languagesArray = json_decode($recordInfo->languages, TRUE);
                if ($lang_old) {
                    $languagesArray[$lang_old]['lang_name'] = $lang_name;
                    $languagesArray[$lang_old]['lang_level'] = $lang_level;
                } else {
                    $lang_key = str_replace(' ', '_', strtolower($lang_name));
                    if (array_key_exists($lang_key, $languagesArray)) {
                        $lang_key = $lang_key . '_' . rand(0, 99);
                    }
                    $languagesArray[$lang_key]['lang_name'] = $lang_name;
                    $languagesArray[$lang_key]['lang_level'] = $lang_level;
                }
            } else {
                $lang_key = str_replace(' ', '_', strtolower($lang_name));
                $languagesArray[$lang_key]['lang_name'] = $lang_name;
                $languagesArray[$lang_key]['lang_level'] = $lang_level;
            }
            User::where('id', Session::get('user_id'))->update(array('languages' => json_encode($languagesArray)));
        } else if ($request->get('deletekey')) {
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $languagesArray = json_decode($recordInfo->languages, TRUE);
            unset($languagesArray[$request->get('deletekey')]);
            User::where('id', Session::get('user_id'))->update(array('languages' => json_encode($languagesArray)));
        } else if ($request->get('skill_ids')) {
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $skillsArray = array();
            if ($recordInfo->skills) {
                $skillsArray = explode(',', $recordInfo->skills);
            }
            $skillsArray[] = $request->get('skill_ids');
            User::where('id', Session::get('user_id'))->update(array('skills' => implode(',', $skillsArray)));
        } else if ($request->get('deleteskill')) {
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $skillsArray = explode(',', $recordInfo->skills);
            $assArray = array_combine($skillsArray, $skillsArray);
            unset($assArray[$request->get('deleteskill')]);
            User::where('id', Session::get('user_id'))->update(array('skills' => implode(',', $assArray)));
        } else if ($request->get('university_name')) {
            $country_name = $request->get('country_name');
            $university_name = $request->get('university_name');
            $qual_name = $request->get('qual_name');
            $stream_name = $request->get('stream_name');
            $year = $request->get('year');
            $edu_old = $request->get('edu_old');
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $educationsArray = array();
            if ($recordInfo->educations) {
                $educationsArray = json_decode($recordInfo->educations, TRUE);
                if ($edu_old) {
                    $educationsArray[$edu_old]['country_name'] = $country_name;
                    $educationsArray[$edu_old]['university_name'] = $university_name;
                    $educationsArray[$edu_old]['qual_name'] = $qual_name;
                    $educationsArray[$edu_old]['stream_name'] = $stream_name;
                    $educationsArray[$edu_old]['year'] = $year;
                } else {
                    $edu_key = str_replace(' ', '_', strtolower($stream_name));
                    if (array_key_exists($edu_key, $educationsArray)) {
                        $edu_key = $edu_key . '_' . rand(0, 99);
                    }
                    $educationsArray[$edu_key]['country_name'] = $country_name;
                    $educationsArray[$edu_key]['university_name'] = $university_name;
                    $educationsArray[$edu_key]['qual_name'] = $qual_name;
                    $educationsArray[$edu_key]['stream_name'] = $stream_name;
                    $educationsArray[$edu_key]['year'] = $year;
                }
            } else { 
                $edu_key = str_replace(' ', '_', strtolower($stream_name));
                $educationsArray[$edu_key]['country_name'] = $country_name;
                $educationsArray[$edu_key]['university_name'] = $university_name;
                $educationsArray[$edu_key]['qual_name'] = $qual_name;
                $educationsArray[$edu_key]['stream_name'] = $stream_name;
                $educationsArray[$edu_key]['year'] = $year;
            }
            User::where('id', Session::get('user_id'))->update(array('educations' => json_encode($educationsArray)));
        } else if ($request->get('deleteedu')) {
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $educationsArray = json_decode($recordInfo->educations, TRUE);
            unset($educationsArray[$request->get('deleteedu')]);
            User::where('id', Session::get('user_id'))->update(array('educations' => json_encode($educationsArray)));
        } else if ($request->get('certificate_name')) {
            $certificate_name = $request->get('certificate_name');
            $certificate_from = $request->get('certificate_from');
            $year = $request->get('year');
            $cert_old = $request->get('cert_old');
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $ecertificationArray = array();
            if ($recordInfo->certifications) {
                $ecertificationArray = json_decode($recordInfo->certifications, TRUE);
                if ($cert_old) {
                    $ecertificationArray[$cert_old]['certificate_name'] = $certificate_name;
                    $ecertificationArray[$cert_old]['certificate_from'] = $certificate_from;
                    $ecertificationArray[$cert_old]['year'] = $year;
                } else {
                    $cert_key = str_replace(' ', '_', strtolower($certificate_name));
                    if (array_key_exists($cert_key, $ecertificationArray)) {
                        $cert_key = $cert_key . '_' . rand(0, 99);
                    }
                    $ecertificationArray[$cert_key]['certificate_name'] = $certificate_name;
                    $ecertificationArray[$cert_key]['certificate_from'] = $certificate_from;
                    $ecertificationArray[$cert_key]['year'] = $year;
                }
            } else {
                $cert_key = str_replace(' ', '_', strtolower($certificate_name));
                $ecertificationArray[$cert_key]['certificate_name'] = $certificate_name;
                $ecertificationArray[$cert_key]['certificate_from'] = $certificate_from;
                $ecertificationArray[$cert_key]['year'] = $year;
            }
            User::where('id', Session::get('user_id'))->update(array('certifications' => json_encode($ecertificationArray)));
        } else if ($request->get('deletecert')) {
            $recordInfo = User::where('id', Session::get('user_id'))->first();
            $educationsArray = json_decode($recordInfo->certifications, TRUE);
            unset($educationsArray[$request->get('deletecert')]);
            User::where('id', Session::get('user_id'))->update(array('certifications' => json_encode($educationsArray)));
        }
    }
    
    public function settings() {
        $pageTitle = 'Manage Settings';
        $recordInfo = User::where('id', Session::get('user_id'))->first();
        $countries = Country::all();
        return view('users.settings', ['title' => $pageTitle, 'recordInfo'=>$recordInfo, 'countries' => $countries]);
    }
    
    public function updatesettings(Request $request) {
        $recordInfo = User::where('id', Session::get('user_id'))->first();
        if($request->has('old_password')){
            $old_password = $request->get('old_password');
            $newpassword = $request->get('newpassword'); 
            if(!password_verify($old_password, $recordInfo->password)) {
                $error = 'Current password is not correct.';
                return response()->json(['error' => $error]);
            }else if($old_password == $newpassword){
                $error = 'You can not change new password same as current password';
                return response()->json(['error' => $error]);
            }else{
                $new_password = $this->encpassword($newpassword);
                User::where('id', Session::get('user_id'))->update(array('password' => $new_password));
                $success = 'success';
            return response()->json(['success' => $success]);
            }
        }
        // return response()->json('Old Password is required!');
       
    }
    // public function updatesettings(Request $request) {
    //     $recordInfo = User::where('id', Session::get('user_id'))->first();
    //     if($request->has('old_password')){
    //         $old_password = $request->get('old_password');
    //         $newpassword = $request->get('newpassword'); 
    //         if(!password_verify($old_password, $recordInfo->password)) {
    //             echo 'Current password is not correct.';
    //         }else if($old_password == $newpassword){
    //             echo 'You can not change new password same as current password'; exit;
    //         }else{
    //             $new_password = $this->encpassword($newpassword);
    //             User::where('id', Session::get('user_id'))->update(array('password' => $new_password));
    //             echo '1';
    //         }
    //     }
    //     if($request->has('paypal_email')){
    //         $paypal_email = $request->get('paypal_email');
    //         User::where('id', Session::get('user_id'))->update(array('paypal_email' => $paypal_email));
    //         echo '1';
    //     }
    // }
     public function updateAccount(Request $request){
        // $this->validate($request,[
        //     'email' => 'required|string|email|max:255|unique:users,email_address,'. auth()->id(),
        // ]);
        $user= User::where('id', Session::get('user_id'))->first();
        
        $request->validate([
            // 'first_name' => 'string|max:30',
            'email_address' => 'required|string|email|max:255|unique:users,email_address,'.$user->id,
            // 'last_name' => 'string|max:30',
            // 'contact' => 'numeric',
            // 'address' => 'string|max:255',
            // 'city' => 'string|max:30',
            // 'state' => 'string|max:30',
            // 'zipcode' => 'numeric',
            // 'preffered_language' => 'string|max:50'
        ]);
        // dd($user);
            $user->update([
                'email_address' => $request->email_address,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact' => $request->contact,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'country_id' => $request->country_id,
                'preferred_language' => $request->pref_lang
            ]);
            return back()->withSuccess('Account successfuly updated!');

        // dd($request->all());
    }
    public function updatePaypal(Request $request){
        // $this->validate($request,[
        //     'email' => 'required|string|email|max:255|unique:users,email_address,'. auth()->id(),
        // ]);
        $user= User::where('id', Session::get('user_id'))->first();
        $request->validate([
            'paypal_email' => 'required|string|email|max:255|unique:users,email_address,'.$user->id,
        ]);
        // dd($user);
            $user->update([
                'paypal_email' => $request->paypal_email, 
            ]);
            return Redirect::to(URL::previous() . '#paypal_email')->with('success', 'Paypal Email Saved!');

        // dd($request->all());
    }
    public function updatePayoneer(Request $request){
        // $this->validate($request,[
        //     'email' => 'required|string|email|max:255|unique:users,email_address,'. auth()->id(),
        // ]);
        $user= User::where('id', Session::get('user_id'))->first();
        $request->validate([
            'payoneer_email' => 'required|string|email|max:255|unique:users,email_address,'.$user->id,
        ]);
        // dd($user);
            $user->update([
                'payoneer_email' => $request->payoneer_email, 
            ]);
            return Redirect::to(URL::previous() . '#payoneer_email')->with('success', 'Payoneer Email Saved!');
        // dd($request->all());
    }
    public function updateBank(Request $request){
        // $this->validate($request,[
        //     'email' => 'required|string|email|max:255|unique:users,email_address,'. auth()->id(),
        // ]);
        $user= User::where('id', Session::get('user_id'))->first();
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_country' => 'required|string|max:255',
            'bank_state' => 'required|string|max:255',
            'bank_city' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            
        ]);
        // dd($user);
            $user->update([
            'bank_name' => $request->bank_name,
            'bank_country' => $request->bank_country,
            'bank_state' => $request->bank_state,
            'bank_city' => $request->bank_city,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'iban_number' => $request->iban_number,
            'swift_code' => $request->swift_code,
            ]);
            return response()->json(['success' => 'success']);

        // dd($request->all());
    }
    public function buyercontacts(){ 
       $pageTitle = 'View Buyer Contacts'; 
       $allrecords = Myorder::where('seller_id', Session::get('user_id'))->groupBy('buyer_id')->get();
       return view('users.buyercontacts', ['title' => $pageTitle, 'allrecords'=>$allrecords]);    
    }
    public function sellercontacts(){ 
        $pageTitle = 'View Seller Contacts'; 
        $allrecords = Myorder::where('buyer_id', Session::get('user_id'))->groupBy('seller_id')->get();
        return view('users.sellercontacts', ['title' => $pageTitle, 'allrecords'=>$allrecords]);   
    }
    
    public function publicprofile($slug){ 
        $recordInfo = User::where('slug', $slug)->first();
        if(!$recordInfo){
            return Redirect::to('dashboard');
        }        
        $pageTitle =  $recordInfo->first_name.' '.$recordInfo->last_name.' Public Profile'; 
        
        $skillsList  = DB::table('skills')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','id')->all();
        $countryLists  = DB::table('countries')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','name')->all();
        $qualificationsLists  = DB::table('qualifications')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','name')->all();
        $mygigs  = Gig::where(['status'=>1, 'user_id'=>$recordInfo->id])->orderBy('id', 'DESC')->limit(9)->get();
        $myreviews  = Review::where(['status'=>1, 'user_id'=>$recordInfo->id])->orderBy('id', 'DESC')->limit(10)->get();
        $mysavegigs = $this->getSavedGigs();
        
         $date1 = date('Y-m-d',strtotime("-30 days"));
        $sellingOrders = DB::table('myorders')
                ->select('seller_id', 'id', DB::raw('sum(total_amount) as total_sum'))
                ->where('seller_id','=', Session::get('user_id'))                     
                ->where('created_at','>=', $date1)                                       
                ->get();
        
        $topRatedInfo = DB::table('reviews')->where(['otheruser_id'=>Session::get('user_id')])->where('rating','>',4)->pluck(DB::raw('count(*) as total'),'id')->all();
        
        return view('users.publicprofile', ['title' => $pageTitle, 'recordInfo'=>$recordInfo, 'topRatedInfo'=>$topRatedInfo,'sellingOrders' => $sellingOrders, 'skillsList'=>$skillsList, 'countryLists'=>$countryLists, 'qualificationsLists'=>$qualificationsLists, 'mygigs'=>$mygigs, 'myreviews'=>$myreviews, 'mysavegigs'=>$mysavegigs]);
    }
    
    public function likeunlike(Request $request) {
       $gid =  $request->get('gid');
       $type =  $request->get('type');
       if($type == 1){
            $mysavegigsAA  = DB::table('savedgigs')->where(['user_id'=>Session::get('user_id')])->first();
            if($mysavegigsAA){
                $mysavegigs = array();
                if($mysavegigsAA->gig_ids){
                    $mysavegigs = explode(',', $mysavegigsAA->gig_ids);
                }
                if(!in_array($gid, $mysavegigs)){
                    $mysavegigs[] = $gid;
                }
                $gigidss = implode(',', $mysavegigs);
                DB::table('savedgigs')->where('id', $mysavegigsAA->id)->update(['gig_ids'=>$gigidss]);  
            }else{
                $serialisedData = array();
                $serialisedData['user_id'] =  Session::get('user_id');
                $serialisedData['gig_ids'] =  $gid;                
                $serialisedData = $this->serialiseFormData($serialisedData);
                DB::table('savedgigs')->insert($serialisedData);
            }
       }else{
            $mysavegigsAA  = DB::table('savedgigs')->where(['user_id'=>Session::get('user_id')])->first();
            $mysavegigs = array();
            if($mysavegigsAA->gig_ids){
                $mysavegigs = explode(',', $mysavegigsAA->gig_ids);
            }
            if (($key = array_search($gid, $mysavegigs)) !== false) {
                unset($mysavegigs[$key]);
            }
            $gigidss = implode(',', $mysavegigs);
            DB::table('savedgigs')->where('id', $mysavegigsAA->id)->update(['gig_ids'=>$gigidss]);  
       }
       
        $mysavegigs = array();
        if(Session::get('user_id')){
            $mysavegigsAA  = DB::table('savedgigs')->where(['user_id'=>Session::get('user_id')])->first();
            if($mysavegigsAA){
                if($mysavegigsAA->gig_ids){
                    $mysavegigs = explode(',', $mysavegigsAA->gig_ids);
                }
            }
        }
       return view('elements.likeunlikeinner', ['gid' => $gid, 'mysavegigs'=>$mysavegigs]);
    }
    
    
    public function mysavedgig(){ 
        $pageTitle = 'My Saved Gigs'; 
        $mysavegigsAA  = DB::table('savedgigs')->where(['user_id'=>Session::get('user_id')])->first();
        $mysavegigs = array(0);
        if($mysavegigsAA){
            if($mysavegigsAA->gig_ids){
                $mysavegigs = explode(',', $mysavegigsAA->gig_ids);
            }
        }
       
       $allrecords = Gig::whereIn('id', $mysavegigs)->get();
       return view('users.mysavedgig', ['title' => $pageTitle, 'allrecords'=>$allrecords]);    
    }
    
    public function deletelikeunlike(Request $request) {
        $gid =  $request->get('gid');
        $mysavegigsAA  = DB::table('savedgigs')->where(['user_id'=>Session::get('user_id')])->first();
        $mysavegigs = array();
        if($mysavegigsAA->gig_ids){
            $mysavegigs = explode(',', $mysavegigsAA->gig_ids);
        }
        if (($key = array_search($gid, $mysavegigs)) !== false) {
            unset($mysavegigs[$key]);
        }
        $gigidss = implode(',', $mysavegigs);
        DB::table('savedgigs')->where('id', $mysavegigsAA->id)->update(['gig_ids'=>$gigidss]); 
    }
    
    public function notifications(){ 
        $pageTitle = 'My Notifications';         
        $allrecords = Notification::where('user_id', Session::get('user_id'))->orderBy('id', 'DESC')->limit(100)->get();
        return view('users.notifications', ['title' => $pageTitle, 'allrecords'=>$allrecords]);    
    }   
    
    public function deletenotification($slug=null){ 
        if($slug){
            Notification::where('slug', $slug)->delete();
            Session::flash('success_message', "Notification deleted successfully.");
            return Redirect::to('users/notifications');
        }   
    } 
    
    public function viewnotification($slug=null){ 
        $notification  = Notification::where(['user_id'=>Session::get('user_id'), 'slug'=>$slug])->first();
        if($notification){
            $url = $notification->url;
            Notification::where(['user_id'=>Session::get('user_id'), 'url'=>$notification->url])->update(['status'=>1]);  
            return Redirect::to($url);
        }else{
            Session::flash('error_message', "You can not access his URL.");
            return Redirect::to('users/notifications');
        }   
    } 
    
    public function checknotifications(){ 
        $notifications  = Notification::where(['user_id'=>Session::get('user_id'), 'status'=>0])->select(['from_name','slug', 'created_at', 'message'])->orderBy('id', 'DESC')->limit(10)->get();
        if(count($notifications) > 0){
            $data  = array();
            $i = 0;
            foreach($notifications as $notification){
                $data[$i]['url'] = $notification->slug;
                $data[$i]['timeago'] = $notification->created_at->diffForHumans();
                $data[$i]['from_name'] = $notification->from_name;
                $data[$i]['message'] = $notification->message;
                $i++;
            }
            echo json_encode($data);
        }else{
            return '1';
        }        
    }
    
    public function messageuser() {
        $pageTitle = 'Users Message';
            $input = Input::all();
            $serialisedData = $this->serialiseFormData($input);
            $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $serialisedData['receiver_id'],
            'message' => $serialisedData['message'],
            'status' => 0
            ]);
            $receiver = User::where('id', $serialisedData['receiver_id'])->get();
            
            broadcast(new NewMessage($message));
            
            return view('messages.message', ['title' => $pageTitle, 'receiver' => $receiver]);
        
    }
}
?>