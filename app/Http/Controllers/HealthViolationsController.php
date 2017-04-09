<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

class HealthViolationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $healthviolations = App\Health_violation::all();
        $title = trans('healthviolation.healthviolation');
        
        return view('health_violations.index',compact('healthviolations','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($visit)
    {
        //
        $uservisit= App\Models\UserVisit::find($visit);
        
        $facility = App\Models\Facility::find($uservisit->facility_id);
        
        $activity = App\Models\Activity::find($facility->activity_type_id);
        $HVTypes = $activity->healthenvtypes; 

        $title = trans('healthviolation.healthviolation'). '|' .trans('healthviolation.create_healthviolation');
        $facilitystatuses = App\Models\FacilityStatus::all();
        
        return view('health_violations.create',compact('facilitystatuses','HVTypes','title','visit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $healthviolation = new App\Health_violation();
        $healthviolation->visit_id = $request->all()["visit_id"];
        $healthviolation->facility_status_id =$request->all()["facility_status_id"];
        $healthviolation->save();

        if($request->exists('HVTypes'))
        {
            foreach ($request->all()['HVTypes'] as $type) {
                $hvt = new App\HV_violation_type();
                $hvt->health_violation_id = $healthviolation->id;
                $hvt->health_env_type_id = $type;
                $hvt->save();
            }
        }
        $response = [
            'message' => trans('healthviolation.created'),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect('admin/health_violation')->with('ok', $response['message']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = trans('healthviolation.healthviolation'). '|' .trans('healthviolation.update_healthviolation');
        $healthviolation=App\Health_violation::find($id);
        
        $facilitystatuses = App\Models\FacilityStatus::all();
        $HVTypes = App\Models\HealthEnvType::all();
        
        $HVT_ids=[];
        foreach($healthviolation->healthenvtypes as $type)
        {
            $HVT_ids[]=$type->id;
        }
        
        return view('health_violations.edit',compact('healthviolation','facilitystatuses','HVTypes','HVT_ids','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $healthviolation=App\Health_violation::find($id);
        $healthviolation->update($request->all());

        if($request->exists('HVTypes'))
        {
            DB::table('hv_violation_type')->where('health_violation_id','=',$healthviolation->id)->delete();
            foreach ($request->all()['HVTypes'] as $type) {
                $hvt = new App\HV_violation_type();
                $hvt->health_violation_id = $healthviolation->id;
                $hvt->health_env_type_id = $type;
                $hvt->save();
            }
        }

        $response = [
            'message' => trans('healthviolation.updated'),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->back()->with('ok', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveHealthViolations(Request $request)
    {
        $violationExists = App\Health_violation::where('visit_id','=',$request->all()["userVisitId"])->first();
        $healthviolation = new App\Health_violation();
        if(count($violationExists) == 0){
            $healthviolation->visit_id = $request->all()["userVisitId"];
            $healthviolation->facility_status_id = $request->all()["facilityStatus"];
            $healthviolation->save();

            if($request->exists('hviolations'))
            {
                foreach ($request->all()['hviolations'] as $type) {
                    $hvt = new App\HV_violation_type();
                    $hvt->health_violation_id = $healthviolation->id;
                    $hvt->health_env_type_id = $type;
                    $hvt->save();
                }
            }
            return response()->json(['hviolations' => $healthviolation->healthenvtypes]);
        }
        else{
            App\HV_violation_type::where('health_violation_id','=',$violationExists->id)->delete();
            if($request->exists('hviolations'))
            {

                foreach ($request->all()['hviolations'] as $type) {
                    $hvt = new App\HV_violation_type();
                    $hvt->health_violation_id = $violationExists->id;
                    $hvt->health_env_type_id = $type;
                    $hvt->save();
                }
            }
            return response()->json(['hviolations' => $violationExists->healthenvtypes]);
        }
        
    }

    public function saveNotice(Request $request)
    {
        $hviolation = App\Health_violation::where('visit_id','=',$request->all()["userVisitId"])->first();
        $hviolation->notice = iconv("UTF-8", "ISO-8859-1",$request->all()["notice"]);
        $hviolation->save();

        return response()->json(['hviolation' => $hviolation]);
    }
}
