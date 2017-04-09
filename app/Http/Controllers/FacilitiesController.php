<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FacilityCreateRequest;
use App\Http\Requests\FacilityUpdateRequest;
use App\Repositories\Interfaces\FacilityRepository;
use App\Validators\FacilityValidator;
use App;
use DB;

class FacilitiesController extends Controller
{

    /**
     * @var FacilityRepository
     */
    protected $repository;

    /**
     * @var FacilityValidator
     */
    protected $validator;

    public function __construct(FacilityRepository $repository, FacilityValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $facilities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $facilities,
            ]);
        }

        $title = trans('facility.facility');
        return view('facilities.index', compact('facilities','title'));
    }


    public function create()
    {
        # code...
        $title = trans('facility.facility'). '|' .trans('facility.create_facility');
        $resquars = App\Models\ResQuar::all();
        $streets = App\Models\Street::all();
        $companies = App\Models\Company::all();
        $activities = App\Models\Activity::all();
        return view('facilities.create',compact('resquars','streets','companies','activities','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FacilityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'banner_name' => 'required',
            'township' => 'required',
            'lyc_name' => 'required',
            
            'lyc_number'=>'required|numeric',
            'build_number'=>'required|numeric',
            'labour_number'=>'required|numeric',
            'owner_name'=>'required',
            'owner_id'=>'required|numeric', 
            'lyc_start'=>'required|required',
        ]);

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            

            $facility = $this->repository->create($request->all());

            // if($request->exists('activities'))
            // {
            //     foreach ($request->all()['activities'] as $activity) {
            //         $facility_act = new App\Facility_activity();
            //         $facility_act->facility_id = $facility->id;
            //         $facility_act->activity_id = $activity;
            //         $facility_act->save();
            //     }
            // }

            $response = [
                'message' => trans('facility.created'),
                'data'    => $facility->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('ok', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facility = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $facility,
            ]);
        }

        return view('facilities.show', compact('facility'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resquars = App\Models\ResQuar::all();
        $streets = App\Models\Street::all();
        $companies = App\Models\Company::all();
        $activities = App\Models\Activity::all();
        $facility = $this->repository->find($id);
        $act_ids=[];
        foreach($facility->activities as $activity)
        {
            $act_ids[]=$activity->id;
        }
        $title = trans('facility.facility'). '|' .trans('facility.update_facility');
        return view('facilities.edit', compact('act_ids','facility','resquars','streets','companies','activities','title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  FacilityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'banner_name' => 'required',
            'township' => 'required',
            'lyc_name' => 'required',
            
            'lyc_number'=>'required|numeric',
            'build_number'=>'required|numeric',
            'labour_number'=>'required|numeric',
            'owner_name'=>'required',
            'lyc_start'=>'required',
        ]);
        
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $facility = $this->repository->update($request->all(),$id );

            // if($request->exists('activities'))
            // {
            //     DB::table('facility_activity')->where('facility_id','=',$facility->id)->delete();
            //     foreach ($request->all()['activities'] as $activity) {
            //         $facility_act = new App\Facility_activity();
            //         $facility_act->facility_id = $facility->id;
            //         $facility_act->activity_id = $activity;
            //         $facility_act->save();
            //     }
            // }

            $response = [
                'message' => trans('facility.updated'),
                'data'    => $facility->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('ok', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);


        return redirect()->back()->with('ok', trans('facility.deleted'));
    }
}
