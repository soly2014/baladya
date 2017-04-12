<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ResQuar;
use App\Models\User;
use App\Models\Violation;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


class DashboardController extends Controller {


    //
    public function index() {
    

    $notificationBuilder = new PayloadNotificationBuilder();
    $notificationBuilder->setTitle('title')
                ->setBody('body')
                ->setSound('sound')
                ->setBadge('badge');

$notification = $notificationBuilder->build();

      //  dd(\Session::get('type'));
        $users= User::all()->count();
        $violations = Violation::all()->count();
        $companies = Company::all()->count();
        $resQuars = ResQuar::all()->count();
        $title = trans('dashboard.dashboard');

       //  $user_id = Session('user_object')->id;
       // $user = App\Models\User::find($user_id);


        return view('admin.dashboard.landpage',compact('title','users','violations','companies','resQuars','user'));
    }

}
