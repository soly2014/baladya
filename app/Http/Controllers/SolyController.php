<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;
use Session;
use App\Models\ViolationImage;
use App\Models\Violation;



class SolyController extends Controller
{
    

     public function getStreets(Request $request)
    {

    	$id = $request->id;
    	$streets = Street::where('res_quar_id',$id)->get();

    	if (count($streets) > 0) {
    		
    		$view = view('soly.streets',compact('streets'))->render();
    		return response()->json(['view'=>$view]);
    	} else {

    		return response()->json('false');
    	}



    }


    public function addImageViolation(Request $request)
    {

      //  dd(Session::get('violation_images'));
         
         $image = $request->file('file');
         
         $imageName = time().$image->getClientOriginalName();
          
         $targetDir =$_SERVER['DOCUMENT_ROOT'] .'/assets/images/Violations';

         $image->move($targetDir,$imageName);


         $old = Session::get('violation_images');

        Session::set('violation_images',array_prepend($old,$imageName));



    }





    public function addVoiceViolation(Request $request)
    {

      //  dd(Session::get('violation_images'));
         
         $image = $request->file('file');
         
         $imageName = time().$image->getClientOriginalName();
          
         $targetDir =$_SERVER['DOCUMENT_ROOT'] .'/assets/images/voices';

         $image->move($targetDir,$imageName);


//         $old = Session::get('violation_voices');

        Session::set('violation_voice',$imageName);



    }





    public function addVideoViolation(Request $request)
    {

      //  dd(Session::get('violation_images'));
         
         $image = $request->file('file');
         
         $imageName = time().$image->getClientOriginalName();
          
         $targetDir =$_SERVER['DOCUMENT_ROOT'] .'/assets/images/videos';

         $image->move($targetDir,$imageName);


       //  $old = Session::get('violation_videos');

        Session::set('violation_video',$imageName);



    }





}
