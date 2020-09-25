<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Cookie;
use Session;
use Redirect;
use Input;
use Validator;
use Response;
use View;
use DB;
use Mail;
use App\Mail\SendMailable;
use Socialite;
use App\Models\Gig;
use App\Models\Gigcustom;
use App\Models\User;
use App\Models\Gigextra;
use App\Models\Gigfaq;
use App\Models\Gigrequirement;
use App\Models\Image;
use App\Models\Pdf;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Review;
use App\Models\Myorder;

class GigsController extends Controller {

    public function __construct() {
        $this->middleware('is_userlogin', ['except' => ['listing', 'detail']]);
    }

    public function create() {
        $pageTitle = 'Create a new Gig';
        $catList = Category::getCategoryList();
        $skills = Skill::getSkillList();
        $input = Input::all();

        
        $user_id = Session::get('user_id');
        if (!empty($input)) {
            //echo "<pre>"; print_r($input);exit;
            $rules = array(
                // 'title' => 'required|min:5|max:80|unique:gigs',
                'title' => 'required|min:5|max:80',
                'category_id' => 'required',
                'subcategory_id' => 'required'
            );
            $customMessages = [
                'category_id.required' => 'The category name field is required field.',
                'subcategory_id.required' => 'The sub category name field is required field.'
            ];
            $validator = Validator::make($input, $rules, $customMessages);
            if ($validator->fails()) {
                return Redirect::to('gigs/create')->withErrors($validator)->withInput();
            } else {

                $skillsArray = array();
                if (isset($input['tags'])) {
                    foreach ($input['tags'] as $skikllist) {
                        $skillinfo = Skill::where('name', $skikllist)->first();

                        if ($skillinfo && $skillinfo->id) {
                            $skillsArray[] = $skillinfo->id;
                        } else {
                            $serialisedSkillData = array();
                            $serialisedSkillData['name'] = $skikllist;
                            $serialisedSkillData['status'] = 0;
                            $serialisedSkillData['user_id'] = $user_id;
                            $serialisedSkillData['slug'] = $this->createSlug($skikllist, 'skills');
                            $skillsArray[] = Skill::insertGetId($serialisedSkillData);
                        }
                    }
                }
                //print_r($skillsArray);exit;

                $serialisedData = $this->serialiseFormData($input);
                unset($serialisedData['stepcnt']);
                $slug = $this->createSlug($input['title'], 'gigs');
                $serialisedData['slug'] = $slug;
                $serialisedData['user_id'] = $user_id;
                $serialisedData['tags'] = implode(',', $skillsArray);
                Gig::insert($serialisedData);

                Session::flash('success_message', "Gig details saved successfully.");
                return Redirect::to('gigs/edit/' . $slug);
            }
        }

        return view('gigs.create', ['title' => $pageTitle, 'catList' => $catList, 'skills' => $skills]);
    }

    public function edit($slug = null) {
        // dd(Input::all());
        $pageTitle = 'Edit Gig';
        $catList = Category::getCategoryList();
        $skills = Skill::getSkillList();

        $recordInfo = Gig::where('slug', $slug)->first();
        if (empty($recordInfo)) {
            return Redirect::to('users/dashboard');
        }

        $recordFaqInfo = Gigfaq::where('gig_id', $recordInfo->id)->get();
        $recordExtInfo = Gigextra::where('gig_id', $recordInfo->id)->get();
        $recordCustInfo = Gigcustom::where('gig_id', $recordInfo->id)->orderBY('id')->get();
        $recordReqInfo = Gigrequirement::where('gig_id', $recordInfo->id)->get();
        $recordImgInfo = Image::where('gig_id', $recordInfo->id)->get();
        $recordPdfInfo = Pdf::where('gig_id', $recordInfo->id)->get();

//        echo "<pre>"; print_r($recordPdfInfo);exit;
        $subCatList = array();
        if ($recordInfo->category_id) {
            $subCatList = Category::getSubCategoryList($recordInfo->category_id);
        }
                $check1_1 = Input::has('1check1') ? 1 : 0;
                $check2_1 = Input::has('2check1') ? 1 : 0;
                $check3_1 = Input::has('3check1') ? 1 : 0;
                $check1_2 = Input::has('1check2') ? 1 : 0;
                $check2_2 = Input::has('2check2') ? 1 : 0;
                $check3_2 = Input::has('3check2') ? 1 : 0;
                $check1_3 = Input::has('1check3') ? 1 : 0;
                $check2_3=  Input::has('2check3') ? 1 : 0;
                $check3_3 = Input::has('3check3') ? 1 : 0;
                $check1_4=  Input::has('1check4') ? 1 : 0;
                $check2_4 = Input::has('2check4') ? 1 : 0;
                $check3_4 = Input::has('3check4') ? 1 : 0;
                $check1_5 = Input::has('1check5') ? 1 : 0;
                $check2_5 = Input::has('2check5') ? 1 : 0;
                $check3_5 = Input::has('3check5') ? 1 : 0;
                
                $fname = [];
                
                if(Input::has('fieldname1')) {
                    array_push($fname, 1);
                    $fieldname1 = Input::get('fieldname1');
                    
                }
                if(Input::has('fieldname2')) {
                    array_push($fname, 2);
                    $fieldname2 = Input::get('fieldname2');
                }
                if(Input::has('fieldname3')) {
                    array_push($fname, 3);
                    $fieldname3 = Input::get('fieldname3');
                }
                if(Input::has('fieldname4')) {
                    array_push($fname, 4);
                    $fieldname4 = Input::get('fieldname4');
                }
                if(Input::has('fieldname5')) {
                    array_push($fname, 5);
                    $fieldname5 = Input::get('fieldname5');
                }
                
        $input = Input::all();
        
        $user_id = Session::get('user_id');
        if (!empty($input)) {
            //echo "<pre>"; print_r($input);exit;

            if ($input['stepcnt'] == 1 || $input['stepcnt'] == 5 || $input['stepcnt'] == 6) {
                $rules = array(
                    'title' => 'required|min:5|max:80',
                    'category_id' => 'required',
                    'subcategory_id' => 'required'
               );
                $customMessages = [
                    'category_id.required' => 'The category name field is required field.',
                    'subcategory_id.required' => 'The sub category name field is required field.'
                ];

                $validator = Validator::make($input, $rules, $customMessages);
            } elseif ($input['stepcnt'] == 2) {
                
                if(Input::has('gig_fixed_price') && $input['gig_fixed_price'] != null){
                    $rules = array(
                    'gig_fixed_price' => 'required',
                    'gig_fixed_revision' => 'required',
                    'gig_fixed_delivery' => 'required',
                    
                );   
                   
                } else { 
                     $rules = array(
                    'basic_title' => 'required',
                    'standard_title' => 'required',
                    'premium_title' => 'required',
                    'basic_description' => 'required',
                    'standard_description' => 'required',
                    'premium_description' => 'required',
                    'basic_delivery' => 'required',
                    'standard_delivery' => 'required',
                    'premium_delivery' => 'required',
                    'basic_price' => 'required',
                    'standard_price' => 'required',
                    'premium_price' => 'required',
                );
                }
                
            //   dd($input['stepcnt']);
                
                
                
                $validator = Validator::make($input, $rules);
            } elseif ($input['stepcnt'] == 3) {
                $rules = array(
                    'description' => 'required',
                );
                $validator = Validator::make($input, $rules);
            } elseif ($input['stepcnt'] == 4) {
                $rules = array(
                    'reqdescription' => 'required',
                );
                $validator = Validator::make($input, $rules);
            } 
//            elseif ($input['stepcnt'] == 5) {
//                $rules = array(
//                    'youtube_url' => 'required',
//                );
//                $validator = Validator::make($input, $rules);
//            }

            if ($validator->fails()) {

                return response()->json(['errors' => $validator->errors()->all()]);
                //return Redirect::to('/admin/gigs/create')->withErrors($validator)->withInput();
            } else {

                $skillsArray = array();
                if (isset($input['tags'])) {
                    foreach ($input['tags'] as $skikllist) {
                        $skillinfo = Skill::where('name', $skikllist)->first();

                        if ($skillinfo && $skillinfo->id) {
                            $skillsArray[] = $skillinfo->id;
                        } else {
                            $serialisedSkillData = array();
                            $serialisedSkillData['name'] = $skikllist;
                            $serialisedSkillData['status'] = 0;
                            $serialisedSkillData['user_id'] = $user_id;
                            $serialisedSkillData['slug'] = $this->createSlug($skikllist, 'skills');
                            $skillsArray[] = Skill::insertGetId($serialisedSkillData);
                        }
                    }
                }

                $serialisedData = $this->serialiseFormData($input);
                
                  if(Input::has('gig_fixed_price') && $input['gig_fixed_price'] != null){
                    $serialisedData['basic_title'] = null;
                    $serialisedData['standard_title'] = null;
                    $serialisedData['premium_title'] = null;
                    $serialisedData['basic_description'] = null;
                    $serialisedData['standard_description'] = null;
                    $serialisedData['premium_description'] = null;
                    $serialisedData['basic_delivery'] = null;
                    $serialisedData['standard_delivery'] = null;
                    $serialisedData['premium_delivery'] = null;
                    $serialisedData['basic_revision'] = null;
                    $serialisedData['standard_revision'] = null;
                    $serialisedData['premium_revision'] = null;
                    $serialisedData['basic_price'] = null;
                    $serialisedData['standard_price'] = null;
                    $serialisedData['premium_price'] = null;
                } 
                else { 
                    $serialisedData['gig_fixed_price'] = null;
                    $serialisedData['gig_fixed_revision'] = null;
                    $serialisedData['gig_fixed_delivery'] = null;
                }

                if (!empty(array_filter($skillsArray))) {
                    $serialisedData['tags'] = implode(',', $skillsArray);
                } else {
                    $serialisedData['tags'] = '';
                }

                if ($serialisedData['stepcnt'] == 6) {
                    $serialisedData['status'] = 1;
                }

                $currentstepcount = $serialisedData['stepcnt'];
                unset($serialisedData['stepcnt']);
                unset($serialisedData['isdocupload']);

                //For faq
                if (isset($serialisedData['question'])) {
                    $questionarr = $serialisedData['question'];

                    unset($serialisedData['question']);
                }
                if (isset($serialisedData['answer'])) {
                    $answerarr = $serialisedData['answer'];
                    unset($serialisedData['answer']);
                }
                
                //For extra
                if (isset($serialisedData['exttitle'])) {
                    $exttitlearr = $serialisedData['exttitle'];
                    unset($serialisedData['exttitle']);
                }
                if (isset($serialisedData['extdescription'])) {
                    $extdescriptionarr = $serialisedData['extdescription'];
                    unset($serialisedData['extdescription']);
                }
                if (isset($serialisedData['extdelivery'])) {
                    $extdeliveryarr = $serialisedData['extdelivery'];
                    unset($serialisedData['extdelivery']);
                }
                if (isset($serialisedData['extprice'])) {
                    $extpricearr = $serialisedData['extprice'];
                    unset($serialisedData['extprice']);
                }
               
               //For custom fields
                // if (isset($serialisedData['fieldname'])) {
                //     $custFieldarr = $serialisedData['fieldname'];
                //     unset($serialisedData['fieldname']);
                // }
                   unset($serialisedData['fieldname1']);
                   unset($serialisedData['fieldname2']);
                   unset($serialisedData['fieldname3']);
                   unset($serialisedData['fieldname4']);
                   unset($serialisedData['fieldname5']);
                
                unset($serialisedData['1check1']);
                unset($serialisedData['2check1']);
                unset($serialisedData['3check1']);
                unset($serialisedData['1check2']);
                unset($serialisedData['2check2']);
                unset($serialisedData['3check2']);
                unset($serialisedData['1check3']);
                unset($serialisedData['2check3']);
                unset($serialisedData['3check3']);
                unset($serialisedData['1check4']);
                unset($serialisedData['2check4']);
                unset($serialisedData['3check4']);
                unset($serialisedData['1check5']);
                unset($serialisedData['2check5']);
                unset($serialisedData['3check5']);
                // if (isset($serialisedData['2check'])) {
                //     $scheckarr = $serialisedData['2check'];
                //     unset($serialisedData['2check']);
                // }
                // if (isset($serialisedData['3check'])) {
                //     $tcheckarr = $serialisedData['3check'];
                //     unset($serialisedData['3check']);
                // }
                // if (isset($serialisedData['1check'])) {
                //     $fcheckarr = $serialisedData['1check'];
                //     unset($serialisedData['1check']);
                // }
                
                
                
                

                //For requirement
                if (isset($serialisedData['reqdescription'])) {
                    $requirementarr = $serialisedData['reqdescription'];
                    unset($serialisedData['reqdescription']);
                }
                if (isset($serialisedData['is_mandatory'])) {
                    $reqmandatoryarr = $serialisedData['is_mandatory'];
                    unset($serialisedData['is_mandatory']);
                }
//echo "<pre>"; print_r($serialisedData);
//                
//                //For image
                if (isset($serialisedData['files_name'])) {
                    $filearr = $serialisedData['files_name'];
                    unset($serialisedData['files_name']);
                }
                if (isset($serialisedData['image'])) {
                    $imgarr = $serialisedData['image'];
                    unset($serialisedData['image']);
                }
                if (isset($serialisedData['image_id'])) {
                    $imgidarr = $serialisedData['image_id'];
                    unset($serialisedData['image_id']);
                }
                if (isset($serialisedData['old_image'])) {
                    $oldimgarr = $serialisedData['old_image'];
                    unset($serialisedData['old_image']);
                }

                //echo "<pre>"; print_r($serialisedData);exit;
//                Gig::insert($serialisedData); 

                Gig::where('id', $recordInfo->id)->update($serialisedData);
                
                if ($currentstepcount == 2) {
                    Gigextra::where('gig_id', $recordInfo->id)->delete();
                    if (!empty($exttitlearr)) {
                        $i = 0;
                        foreach ($exttitlearr as $key => $gigextra) {
                            $i = $i + 1;
                            $serialisedExtData = array();
                            $serialisedExtData['gig_id'] = $recordInfo->id;
                            $serialisedExtData['user_id'] = $user_id;
                            $eslug = $this->createSlug('extra' . $recordInfo->id . $i, 'gigextras');
                            $serialisedExtData['slug'] = $eslug;
                            $serialisedExtData['title'] = $gigextra;
                            $serialisedExtData['description'] = $extdescriptionarr[$key];
                            $serialisedExtData['price'] = $extpricearr[$key];
                            $serialisedExtData['delivery'] = $extdeliveryarr[$key];
                            $serialisedExtData['status'] = 1;
                            Gigextra::insert($serialisedExtData);
                        }
                    }
                    Gigcustom::where('gig_id', $recordInfo->id)->delete();
                    if ($fname != 0) {
                          
                            foreach ($fname as $i) {
                        //     $i = $i + 1;
                            $serialisedCustData = array();
                            $serialisedCustData['gig_id'] = $recordInfo->id;
                            $serialisedCustData['user_id'] = $user_id;
                            $serialisedCustData['fieldname'] = ${'fieldname' . $i};
                            $serialisedCustData['check1'] = ${'check1_' . $i};
                            $serialisedCustData['check2'] = ${'check2_' . $i};
                            $serialisedCustData['check3'] = ${'check3_' . $i};
                            
                            Gigcustom::insert($serialisedCustData);
                        }
                        // foreach ($custFieldarr as $key => $gigcustom) {
                        //     $i = $i + 1;
                        //     $serialisedCustData = array();
                        //     $serialisedCustData['gig_id'] = $recordInfo->id;
                        //     $serialisedCustData['user_id'] = $user_id;
                        //     $serialisedCustData['fieldname'] = $gigcustom;
                        //     $serialisedCustData['check1'] = ${'check1_' . $i};
                        //     $serialisedCustData['check2'] = ${'check2_' . $i};
                        //     $serialisedCustData['check3'] = ${'check3_' . $i};
                            
                        //     Gigcustom::insert($serialisedCustData);
                        // }
                    }
                }
                
                if ($currentstepcount == 3) {

                    //delete all gig first
                    Gigfaq::where('gig_id', $recordInfo->id)->delete();

                    //create new gigs
                    if (!empty($questionarr)) {
                        $i = 0;
                        $answerdata = $answerarr;
                        foreach ($questionarr as $key => $gigfaqquestion) {
                            $i = $i + 1;
                            $serialisedFaqData = array();
                            $serialisedFaqData['gig_id'] = $recordInfo->id;
                            $serialisedFaqData['user_id'] = $user_id;
                            $fslug = $this->createSlug('question' . $recordInfo->id . $i, 'gigfaqs');
                            $serialisedFaqData['slug'] = $fslug;
                            $serialisedFaqData['question'] = $gigfaqquestion;
                            $serialisedFaqData['answer'] = $answerdata[$key];
                            $serialisedFaqData['status'] = 1;
                            Gigfaq::insert($serialisedFaqData);
                        }
                    }
                }
                if ($currentstepcount == 4) {
                    Gigrequirement::where('gig_id', $recordInfo->id)->delete();
                    if (!empty($requirementarr)) {
                        $i = 0;
                        foreach ($requirementarr as $key => $gigrequire) {
                            $i = $i + 1;
                            $serialisedReqData = array();
                            $serialisedReqData['gig_id'] = $recordInfo->id;
                            $serialisedReqData['user_id'] = $user_id;
                            $rslug = $this->createSlug('requirement' . $recordInfo->id . $i, 'gigrequirements');
                            $serialisedReqData['slug'] = $rslug;
                            $serialisedReqData['description'] = $gigrequire;
                            if (isset($reqmandatoryarr[$key]) && $reqmandatoryarr[$key] == 1) {
                                $serialisedReqData['is_mandatory'] = 1;
                            } else {
                                $serialisedReqData['is_mandatory'] = 0;
                            }
                            $serialisedReqData['status'] = 1;
                            Gigrequirement::insert($serialisedReqData);
                        }
                    }
                }
                if ($currentstepcount == 5) {
                    if (isset($imgarr)) {
                        foreach ($imgarr as $key => $img) {
                            $serialisedImgData = array();
                            if ($img->getClientOriginalName()) {
                                $file = $img;
                                $uploadedFileName = $this->uploadImage($file, GIG_FULL_UPLOAD_PATH);
                                $this->resizeImage($uploadedFileName, GIG_FULL_UPLOAD_PATH, GIG_SMALL_UPLOAD_PATH, GIG_MW, GIG_MH);
                                if (isset($oldimgarr[$key])) {
                                    $old_image = $oldimgarr[$key];
                                    if ($old_image) {
                                        @unlink(GIG_FULL_UPLOAD_PATH . $old_image);
                                        @unlink(GIG_SMALL_UPLOAD_PATH . $old_image);
                                    }
                                }
                            }
                            $serialisedImgData['gig_id'] = $recordInfo->id;
                            $serialisedImgData['name'] = $uploadedFileName;
                            $serialisedImgData['status'] = 1;
                            $serialisedImgData['main'] = 0;

                            if (isset($imgidarr[$key])) {
                                Image::where('id', $imgidarr[$key])->update($serialisedImgData);
                            } else {
                                Image::insert($serialisedImgData);
                            }
                        }
                    }
                    
                    if (isset($filearr)) {
                            $serialisedFileData = array();
                            if ($img->getClientOriginalName()) {
                                $file = $img;
                                $uploadedFileName = $this->uploadImage($file, GIG_FULL_UPLOAD_PATH);
                                $this->resizeImage($uploadedFileName, GIG_FULL_UPLOAD_PATH, GIG_SMALL_UPLOAD_PATH, GIG_MW, GIG_MH);
                                if (isset($oldimgarr[$key])) {
                                    $old_image = $oldimgarr[$key];
                                    if ($old_image) {
                                        @unlink(GIG_FULL_UPLOAD_PATH . $old_image);
                                        @unlink(GIG_SMALL_UPLOAD_PATH . $old_image);
                                    }
                                }
                            }
                            $serialisedImgData['gig_id'] = $recordInfo->id;
                            $serialisedImgData['name'] = $uploadedFileName;
                            $serialisedImgData['status'] = 1;
                            $serialisedImgData['main'] = 0;

                            if (isset($imgidarr[$key])) {
                                Image::where('id', $imgidarr[$key])->update($serialisedImgData);
                            } else {
                                Image::insert($serialisedImgData);
                            }
                        
                    }

                    $mygigs = DB::table('gigs')->where(['id' => $recordInfo->id])->first();
                    if ($mygigs->youtube_url) {
                        $gigimgname = \App\Models\Gig::video_image($mygigs->youtube_url);
                        $imgName = 'gig' . $mygigs->id . '.jpg';
                        $img = GIG_FULL_UPLOAD_PATH . $imgName;
                        file_put_contents($img, file_get_contents($gigimgname));
                        DB::table('gigs')->where('id', $mygigs->id)->update(array('youtube_image' => $imgName));
                    }
                }


                if ($currentstepcount == 6) {
                    Session::flash('success_message', "Gig details saved successfully.");
                    return Redirect::to('gigs/' . $recordInfo->slug);
                } else {
                    return response()->json(['errors' => '', 'status' => 1, 'message' => ["Detail saved!"], 'gigslug' => [$recordInfo->slug]]);
                }
                // exit;
                //return json_encode(array('status'=>1,'message'=>"Detail saved!",'gigslug'=> $recordInfo->slug));
                exit;
            }
        }
        // dd($recordCustInfo);
//        echo "<pre>";print_r($recordInfo);exit;
        return view('gigs.edit', ['title' => $pageTitle, 'catList' => $catList, 'subCatList' => $subCatList, 'skills' => $skills, 'gigDetail' => $recordInfo, 'recordCustInfo' => $recordCustInfo, 'recordExtInfo' => $recordExtInfo, 'recordFaqInfo' => $recordFaqInfo, 'recordReqInfo' => $recordReqInfo, 'recordImgInfo' => $recordImgInfo, 'recordPdfInfo' => $recordPdfInfo]);
    }

    public function getsubcategorylist($id = null) {
        if ($id && $id > 0) {
            $subCatList = Category::getSubCategoryList($id);
            return view('elements.subcategorylist', ['subCatList' => $subCatList]);
        } else{
            return view('elements.subcategorylist', ['subCatList' => array()]);
        }
    }

    public function add() {
        $pageTitle = 'Manage Settings';
        return view('gigs.add', ['title' => $pageTitle]);
    }

    public function management(Request $request) {
        $pageTitle = 'Manage Settings';
        $query = new Gig();

        $query = $query->where('user_id', '=', Session::get('user_id'));
        $query = $query->whereNull('type_gig');
//        if ($request->has('category_id') && $request->get('category_id') > 0) {
//            $query = $query->where('category_id', $request->get('category_id'));
//        }
        if ($request->has('page')) {
            $page = $request->get('page');
        } else {
            $page = 1;
        }
        if ($page == 1) {
            $limit = 19;
        } else {
            $limit = 20;
        }
        $allrecords = $query->orderBy('id', 'DESC')->paginate($limit, ['*'], 'page', $page);
        if ($request->ajax()) {
            return view('elements.gigs.management', ['allrecords' => $allrecords, 'page' => $page]);
        }
        //echo "<pre>"; print_r($allrecords);exit;
        $catList = Category::getCategoryList();
        return view('gigs.management', ['title' => $pageTitle, 'allrecords' => $allrecords, 'catList' => $catList, 'page' => $page, 'limit' => $limit]);
    }

    public function uploaddocument() {
        $msgString = "";
        $input = Input::all();
        $user_id = Session::get('user_id');
        if (!empty($input)) {
//            echo "<pre>"; print_r($input);exit;
            $rules = array(
                'files_name' => 'mimes:doc,docx,pdf',
            );

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {

                return response()->json(['errors' => $validator->errors()->all()]);
                //return Redirect::to('/admin/gigs/create')->withErrors($validator)->withInput();
            } else {

                $files = explode(',', $input['pdf_doc']);
                if (Input::hasFile('files_name')) {
                    $file = Input::file('files_name');
                    $uploadedFileName = $this->uploadImage($file, GIG_DOC_FULL_UPLOAD_PATH);
                    $rand = rand(100, 999);
                    $html = '<li id="' . $rand . '" data-img="' . $uploadedFileName . '" class="portfolio-cc">' . $uploadedFileName . '<a href="#" onclick="deletefile(' . $rand . ')" class="delete"><i class="fa fa-trash-o"></i></a></li>';
                    $files[] = $uploadedFileName;
                }
                return response()->json(['errors' => '', 'status' => 1, 'message' => ["Gig document is successfully uploaded."], 'file_name' => [$html], 'json_data' => [implode(',', $files)]]);
            }
        }
        exit;
    }

    public function delete($slug = null) {
        if ($slug) {
            Gig::where('slug', $slug)->delete();
            Session::flash('success_message', "Gig deleted successfully.");
            return Redirect::to('gigs/management');
        }
    }

    

    public function deleteimage($id = null) {
        if ($id) {
            Image::where('id', $id)->delete();
            exit;
        }
    }

    public function listing(Request $request, $catslug = null, $subcatslug = null) { 
        $pageTitle = 'View Gigs';
        
        $query = new Gig();
        $query = $query->with('User');
        $query = $query->where('status', 1);
        // $query = $query->where('basic_price', '!=', 0)->where('gig_fixed_price', '!=', 0);
        // $query = $query->where('basic_price', '!=', 0);
        $query = $query->whereNull('type_gig');
        
       
        
        $mysavegigs = $this->getSavedGigs();
        $olftitle = '';    
        $catInfo = array();
        $subDesc = '';
      
        
        if($catslug){
            $catInfo = Category::where('slug', $catslug)->first();
            if (empty($catInfo)) {
                return Redirect::to('gigs');
            }else{
               $category_id = $catInfo->id;
               
               $query = $query->where('category_id', $catInfo->id);               
            }            
        }
        //echo '<pre>';print_r($catInfo);exit;
        
        $subCatInfo = array();
        if($subcatslug){
             
            
            
        
            $subCatInfo = Category::where('slug', $subcatslug)->first();
            if (empty($subCatInfo)) {
                return Redirect::to('gigs/'.$catslug);
            }else{
               $subcategory_id = $subCatInfo->id;
               $subDesc = $subCatInfo->sub_description;
               $query = $query->where('subcategory_id', $subCatInfo->id);               
            }            
        }else
               
        if ($request->has('subcategory_id') && $request->get('subcategory_id') > 0) {
            $subCatDesc = Category::where('id', $request->get('subcategory_id'))->pluck('sub_description')->first();
            
            $query = $query->where('subcategory_id', $request->get('subcategory_id'));
        }        
        if ($request->has('title') && $request->get('title') !='') {
            $olftitle = $request->get('title');
            $query = $query->where('title', 'like', '%'.$request->get('title').'%');
        }
        if ($request->has('price_min') && $request->get('price_min') !='') {
            $query = $query->where('basic_price', '>=', $request->get('price_min'))->where('gig_fixed_price', '>=', $request->get('price_min'));
        }
        if ($request->has('price_max') && $request->get('price_max') !='') {
            $query = $query->where('basic_price', '<=', $request->get('price_max'))->orWhere('gig_fixed_price', '<=', $request->get('price_max'));
        }        
        if ($request->has('delivery_time') && $request->get('delivery_time') > 0) {
            $query = $query->where('basic_delivery', '<=', $request->get('delivery_time'))->orWhere('gig_fixed_delivery', '<=', $request->get('delivery_time'));
        }
        if ($request->has('langauge') && $request->get('langauge') !='') {
            $langaugeArray = $request->get('langauge');
            $query = $query->whereHas('User', function($q) use ($langaugeArray){
                $first = array_shift($langaugeArray);
                $q = $q->where('languages', 'like', '%'.$first.'%');
                if(count($langaugeArray) > 0){
                    foreach($langaugeArray as $langn){
                        $q = $q->orWhere('languages', 'like', '%'.$langn.'%');
                    }
                }
            });
        }
        
        if ($request->has('country_id') && $request->get('country_id') > 0) {
            $country_id = $request->get('country_id');
            $query = $query->whereHas('User', function($q) use ($country_id){
                $q->where('country_id', $country_id);
            });
        }  
        
        $filter_type = 0;
        if ($request->has('filter_type') && $request->get('filter_type') > 0) {
            $filter_type = $request->get('filter_type');
        }
        switch ($filter_type){
            case 1:
                $query = $query->orderBy('basic_price', 'ASC');
                break;
            case 2:
                $query = $query->orderBy('basic_price', 'DESC');
                break;
            case 3:
                $query = $query->orderBy('id', 'DESC');
                break;
            case 4:
                $query = $query->orderBy('id', 'ASC');
                break;
            // case 5:
            //     $query = $query->orderBy('gig_fixed_price', 'ASC');
            //     break;
            default:
               $query = $query->orderBy('basic_price', 'ASC');        
        }        
        
        if ($request->has('page')) {
            $page = $request->get('page');
        } else {
            $page = 1;
        }
        
        $limit = 16;
        
        $allrecords = $query->paginate($limit, ['*'], 'page', $page);
        
        
//        echo '<pre>';print_r($allrecords);exit;

 if($request->has('subcategory_id') && $request->ajax())
        {
        
        $subdesc = Category::where('id', $request->get('subcategory_id'))->pluck('sub_description')->first();
        
        //   session()->put('subdesc', $subdesc);
       
        } else {  $subdesc = ''; }
        
if ($request->ajax()) {
            // return view('elements.gigs.listing', ['allrecords' => $allrecords, 'page' => $page, 'mysavegigs'=>$mysavegigs, 'isajax'=>1, 'subCatDesc' => $subCatDesc]);
            // return response()->json($subdesc);
            // return view('elements.gigs.listing', ['allrecords' => $allrecords, 'page' => $page, 'mysavegigs'=>$mysavegigs, 'isajax'=>1, 'subdesc' => $subdesc]);
            $flag = 1;
             return Response::json(['view' => View::make('elements.gigs.listing', ['allrecords' => $allrecords, 'page' => $page, 'mysavegigs'=>$mysavegigs, 'isajax'=>1])->render(), 'subdesc' => $subdesc]);
            // $isajax = 1;
            // return view('elements.gigs.listing', compact('allrecords','page','mysavegigs','isajax','subdesc'));
            // return response()->json(['allrecords' => $allrecords, 'page' => $page, 'mysavegigs'=>$mysavegigs, 'isajax'=>1, 'subdesc' => $subdesc]);
                    // return view('gigs.listing', ['title' => $pageTitle, 'allrecords' => $allrecords, 'catList' => $catList, 'gigcatlist' => $gigcatlist,  'page' => $page, 'limit' => $limit, 'countryLists'=>$countryLists, 'catInfo'=>$catInfo, 'subCatInfo'=>$subCatInfo, 'catListSlugs'=>$catListSlugs, 'mysavegigs'=>$mysavegigs, 'olftitle'=>$olftitle]);

        }
        
//        if($request->ajax()){
//            return view('elements.gigs.listing', ['allrecords'=>$allrecords, 'mysavegigs'=>$mysavegigs]);
//        }
       
        $catListSlugs = array();
        if(isset($subcategory_id) && $subcategory_id > 0){ 
            
            $catList = Category::getSubCategoryList($category_id);
            
            $gigcatlist = DB::table('gigs')
                        ->select('subcategory_id', DB::raw('count(*) as total'))
                        ->where('subcategory_id', $subcategory_id)
                        ->where('category_id', $category_id)
                        ->whereNull('type_gig')
                        ->groupBy('subcategory_id')
                        ->pluck('total', 'subcategory_id')->all();
        }elseif(isset($category_id) && $category_id > 0){
            $catList = Category::getSubCategoryList($category_id);
            $gigcatlist = DB::table('gigs')
                        ->select('subcategory_id', DB::raw('count(*) as total'))
                        ->where('category_id', $category_id)
                        ->whereNull('type_gig')
                        ->groupBy('subcategory_id')
                        ->pluck('total', 'subcategory_id')->all();
        }else{
            $catListSlugs = Category::where(['status'=>1,'parent_id'=>0])->orderBy('name', 'ASC')->pluck('slug','id')->all();
            $catList = Category::getCategoryList();
            $gigcatlist = DB::table('gigs')
                        ->select('category_id', DB::raw('count(*) as total'))
                    ->whereNull('type_gig')
                        ->groupBy('category_id')
                        ->pluck('total', 'category_id')->all();
        }
        //print_r($catList);exit;
        $countryLists  = DB::table('countries')->where('status', 1)->orderBy('name', 'ASC')->pluck('name','id')->all();
        
         
        
// dd($allrecords);
// dd($gigcatlist);
        
        // return view('gigs.listing', ['title' => $pageTitle, 'allrecords' => $allrecords, 'catList' => $catList, 'gigcatlist' => $gigcatlist,  'page' => $page, 'limit' => $limit, 'countryLists'=>$countryLists, 'catInfo'=>$catInfo, 'subCatInfo'=>$subCatInfo, 'catListSlugs'=>$catListSlugs, 'mysavegigs'=>$mysavegigs, 'olftitle'=>$olftitle, 'subCatDesc' => $subCatDesc]);
         return view('gigs.listing', ['title' => $pageTitle, 'subdesc' => $subDesc, 'subcatslug' => $subcatslug, 'allrecords' => $allrecords, 'catList' => $catList, 'gigcatlist' => $gigcatlist,  'page' => $page, 'limit' => $limit, 'countryLists'=>$countryLists, 'catInfo'=>$catInfo, 'subCatInfo'=>$subCatInfo, 'catListSlugs'=>$catListSlugs, 'mysavegigs'=>$mysavegigs, 'olftitle'=>$olftitle]);
        // return view('gigs.listing', ['title' => $pageTitle, 'allrecords' => $allrecords, 'catList' => $catList, 'gigcatlist' => $gigcatlist,  'page' => $page, 'limit' => $limit, 'countryLists'=>$countryLists, 'catInfo'=>$catInfo, 'subCatInfo'=>$subCatInfo, 'catListSlugs'=>$catListSlugs, 'mysavegigs'=>$mysavegigs, 'olftitle'=>$olftitle]);
    
        // return ($catInfo);
    }
    
    public function offeredgig() {
        $pageTitle = 'Offered Gigs';
        

        $allrecords = Gig::where('offer_user', Session::get('user_id'))->orderBy('id', 'DESC')->get();
        
        return view('gigs.offeredgig', ['title' => $pageTitle, 'allrecords' => $allrecords]);
    }
    
    public function myofferedgig() {
        $pageTitle = 'My Offered Gigs';       

        $allrecords = Gig::where('user_id', Session::get('user_id'))->where('type_gig', 'offer')->orderBy('id', 'DESC')->get();
        
        return view('gigs.myofferedgig', ['title' => $pageTitle, 'allrecords' => $allrecords]);
    }
    
    public function detail(Request $request, $slug = null) {
        $pageTitle = 'View Gig Detail';

        $recordInfo = Gig::where('slug', $slug)->first();
        
        
//        echo '<pre>';print_r($recordInfo);exit;
        if (empty($recordInfo)) {
            return Redirect::to('gigs/management');
        }
        $userInfo = array();
        if(isset($recordInfo->User->slug)){
            $userInfo = User::where('slug', $recordInfo->User->slug)->first();
        }
        
        $pageTitle = $recordInfo->title;
        
        $query = new Review();
        $query = $query->with('Myorder');
        $query = $query->where('status', 1);
        
        $gig_id = $recordInfo->id;
        $query = $query->whereHas('Myorder', function($q) use ($gig_id){
            $q->where('gig_id', $gig_id)->where('as_a', 'seller');
        });       
        
        $gigreviews  = $query->orderBy('id', 'DESC')->limit(10)->get();
        $othergigs = Gig::where('user_id', $recordInfo->user_id)->where('status', 1)->get();
        
        $date1 = date('Y-m-d',strtotime("-30 days"));
        $sellingOrders = DB::table('myorders')
                ->select('seller_id', 'id', DB::raw('sum(total_amount) as total_sum'))
                ->where('seller_id','=', Session::get('user_id'))                     
                ->where('created_at','>=', $date1)                                       
                ->get();
        $tagIds = explode(",", $recordInfo->tags);
        
        $parentcat = Category::where('id', $recordInfo->category_id)->first();
        $subcat = Category::where('id', $recordInfo->subcategory_id)->first();
        
        // dd($parentcat);
        $tags = Skill::whereIn('id', $tagIds)->get();
        
        $topRatedInfo = DB::table('reviews')->where(['otheruser_id'=>Session::get('user_id')])->where('rating','>',4)->pluck(DB::raw('count(*) as total'),'id')->all();
        // dd($recordInfo->Image);
        return view('gigs.detail', ['title' => $pageTitle, 'parentcat' => $parentcat, 'subcat' => $subcat, 'recordInfo' => $recordInfo, 'userInfo' => $userInfo, 'topRatedInfo'=>$topRatedInfo,'sellingOrders' => $sellingOrders, 'gigreviews'=>$gigreviews, 'othergigs' => $othergigs, 'tags' => $tags]);
    }
    
    
    public function createoffer(Request $request){ 
        $pageTitle = 'Create a new Gig';
        $catList = Category::getCategoryList();
        $skills = Skill::getSkillList();
        $input = Input::all();

        $user_id = Session::get('user_id');
        if (!empty($input)) {
            
            $recordInfo = Gig::where('id', $input['select_gig'])->first();
            
            $serialisedData['id'] = '';
            $serialisedData['basic_description'] = $input['description'];
            $serialisedData['basic_price'] = $input['basic_price'];
            $serialisedData['basic_delivery'] = $input['basic_delivery'];
            $serialisedData['expiry'] = $input['expiry'];
            $serialisedData['one_delivery'] = 1;
            $serialisedData['standard_title'] = '';
            $serialisedData['standard_description'] = '';
            $serialisedData['standard_delivery'] = '';
            $serialisedData['standard_revision'] = '';
            $serialisedData['standard_price'] = '';
            $serialisedData['premium_title'] = '';
            $serialisedData['premium_description'] = '';
            $serialisedData['premium_delivery'] = '';
            $serialisedData['premium_revision'] = '';
            $serialisedData['premium_price'] = '';
            $serialisedData['title'] = $recordInfo->title;
            $serialisedData['category_id'] = $recordInfo->category_id;
            $serialisedData['subcategory_id'] = $recordInfo->subcategory_id;
            $serialisedData['tags'] = $recordInfo->tags;
            $serialisedData['description'] = $recordInfo->description;
            $serialisedData['photo'] = $recordInfo->photo;
            $serialisedData['youtube_url'] = $recordInfo->youtube_url;
            $serialisedData['youtube_image'] = $recordInfo->youtube_image;
            $serialisedData['pdf_doc'] = $recordInfo->pdf_doc;
            
            $slug = $this->createSlug($recordInfo->title, 'gigs');
            $serialisedData['slug'] = $slug;
            $serialisedData['user_id'] = $user_id;
            $serialisedData['type_gig'] = 'offer';
            $serialisedData['offer_user'] = $input['offer_user'];

            $userInfo = User::where('id', $input['offer_user'])->first();
            Gig::insert($serialisedData);
            
            $gigId = DB::getPdo()->lastInsertId();

            if($recordInfo->Image){
                foreach($recordInfo->Image as $gigimage) {
                    if (isset($gigimage->name) && !empty($gigimage->name)){
                        $path = GIG_FULL_UPLOAD_PATH . $gigimage->name;
                        if (file_exists($path) && !empty($gigimage->name)){
                            $uploadedFileName = $gigimage->name;
                            $uploadedFileNew = $gigimage->name.'-'.time();
                            $success = \File::copy(GIG_FULL_UPLOAD_PATH.'/'.$uploadedFileName,GIG_FULL_UPLOAD_PATH.'/'.$uploadedFileNew);

                            $this->resizeImage($uploadedFileNew, GIG_FULL_UPLOAD_PATH, GIG_SMALL_UPLOAD_PATH, GIG_MW, GIG_MH);

                            $serialisedImgData = array();

                            $serialisedImgData['gig_id'] = $gigId;
                            $serialisedImgData['name'] = $uploadedFileName;
                            $serialisedImgData['status'] = 1;
                            $serialisedImgData['main'] = 0;

                            Image::insert($serialisedImgData);
                        }
                    } 
                }
            }

            $name = ucwords($userInfo->first_name . ' ' . $userInfo->last_name);
            $username = ucwords($recordInfo->User->first_name . ' ' . $recordInfo->User->last_name);
            $price = '$'.$input['basic_price'];
            $duedate = date('d M Y',strtotime($input['expiry']));
            $item = $recordInfo->title;
            $emailId = $userInfo->email_address;

            $emailTemplate = DB::table('emailtemplates')->where('id', 22)->first();
            $toRepArray = array('[!username!]', '[!name!]', '[!duedate!]', '[!item!]', '[!price!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
            $fromRepArray = array($username, $name, $duedate, $item, $price, HTTP_PATH, SITE_TITLE);
            $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
            $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
            Mail::to($emailId)->send(new SendMailable($emailBody, $emailSubject));

            Session::flash('success_message', "Gig details saved successfully.");
            return Redirect::to('gigs/myofferedgig');
        }

    }
    
    public function acceptreject(Request $request, $type, $slug) {
        if($type == 1){
            $pageTitle = 'Accept Offer';
            $recordInfo = Gig::where('slug', $slug)->first();
            $userInfo = User::where('id', $recordInfo->offer_user)->first();
            
            DB::table('gigs')->where('id', $recordInfo->id)->update(array('offer_status' => 1));
            
            $username = ucwords($userInfo->first_name . ' ' . $userInfo->last_name);
            $name = ucwords($recordInfo->User->first_name . ' ' . $recordInfo->User->last_name);
            $price = '$'.$recordInfo->basic_price;
            $item = $recordInfo->title;
            $emailId = $recordInfo->User->email_address;

            $emailTemplate = DB::table('emailtemplates')->where('id', 23)->first();
            $toRepArray = array('[!username!]', '[!name!]', '[!item!]', '[!price!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
            $fromRepArray = array($username, $name, $item, $price, HTTP_PATH, SITE_TITLE);
            $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
            $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
            Mail::to($emailId)->send(new SendMailable($emailBody, $emailSubject));

            Session::flash('success_message', "Custom offer accepted successfully.");
            return Redirect::to('gigs/offeredgig');
                
        }elseif($type == 2){
            $pageTitle = 'Reject Offer';
            $recordInfo = Gig::where('slug', $slug)->first();
            $userInfo = User::where('id', $recordInfo->offer_user)->first();
            
            DB::table('gigs')->where('id', $recordInfo->id)->update(array('offer_status' => 2));
            
            $username = ucwords($userInfo->first_name . ' ' . $userInfo->last_name);
            $name = ucwords($recordInfo->User->first_name . ' ' . $recordInfo->User->last_name);
            $price = '$'.$recordInfo->basic_price;
            $item = $recordInfo->title;
            $emailId = $recordInfo->User->email_address;

            $emailTemplate = DB::table('emailtemplates')->where('id', 24)->first();
            $toRepArray = array('[!username!]', '[!name!]', '[!item!]', '[!price!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
            $fromRepArray = array($username, $name, $item, $price, HTTP_PATH, SITE_TITLE);
            $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
            $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
            Mail::to($emailId)->send(new SendMailable($emailBody, $emailSubject));

            Session::flash('success_message', "Custom offer rejected successfully.");
            return Redirect::to('gigs/offeredgig');     
        }elseif($type == 3){
            $pageTitle = 'Withdrawn Offer';
            $recordInfo = Gig::where('slug', $slug)->first();
            $userInfo = User::where('id', $recordInfo->offer_user)->first();
            
            DB::table('gigs')->where('id', $recordInfo->id)->update(array('offer_status' => 3));
            
            $name = ucwords($userInfo->first_name . ' ' . $userInfo->last_name);
            $username = ucwords($recordInfo->User->first_name . ' ' . $recordInfo->User->last_name);
            $price = '$'.$recordInfo->basic_price;
            $item = $recordInfo->title;
            $emailId = $userInfo->email_address;

            $emailTemplate = DB::table('emailtemplates')->where('id', 25)->first();
            $toRepArray = array('[!username!]', '[!name!]', '[!item!]', '[!price!]', '[!HTTP_PATH!]', '[!SITE_TITLE!]');
            $fromRepArray = array($username, $name, $item, $price, HTTP_PATH, SITE_TITLE);
            $emailSubject = str_replace($toRepArray, $fromRepArray, $emailTemplate->subject);
            $emailBody = str_replace($toRepArray, $fromRepArray, $emailTemplate->template);
            Mail::to($emailId)->send(new SendMailable($emailBody, $emailSubject));

            Session::flash('success_message', "Custom offer rejected successfully.");
            return Redirect::to('gigs/myofferedgig');     
        }          
    }

}

?>