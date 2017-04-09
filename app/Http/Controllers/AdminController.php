<?php

namespace App\Http\Controllers;
use App\activity;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
    	# code...
    	return view('partials.landpage');
    }

    public function activityIndex()
    {
    	# code...
        // dd('hit');
    	$activities = activity::all();
    	return view('admin.activity.index',compact('activities'));
    }

    public function activityCreate()
    {
    	# code...
    	return view('admin.activity.create');
    }

    public function activitySave(Request $request)
    {
    	# code...
    	$activity = new activity($request->all());
    	if($activity->save())
    	{
            $activities = activity::all();
    		return view('admin.activity.index',compact('activities'));
    	}else
    	{
    		abort(500);
    	}
    }

    public function activityEdit(activity $activity)
    {
        # code...
        return view('admin.activity.edit',compact('activity'));

    }

    public function activityUpdate(Request $request,activity $activity)
    {
        # code...
        if($activity->update($request->all()))
        {
            $activities = activity::all();
            return view('admin.activity.index',compact('activities'));
        }else{
            abort(500);
        }
    }

    public function activityDelete(activity $activity)
    {
        # code...
        $activity->delete();
        return back();
    }


}
