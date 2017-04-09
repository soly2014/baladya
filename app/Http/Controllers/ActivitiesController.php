<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ActivityCreateRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Repositories\Interfaces\ActivityRepository;
use App\Validators\ActivityValidator;
use App\Models\Activity;


class ActivitiesController extends Controller
{

    /**
     * @var ActivityRepository
     */
    protected $repository;

    /**
     * @var ActivityValidator
     */
    protected $validator;

    public function __construct(ActivityRepository $repository, ActivityValidator $validator)
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
        $activities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activities,
            ]);
        }
        $title = trans('activity.activity');

        return view('activities.index', compact('activities','title'));
    }

    public function create()
    {
        # code...
        $title = trans('activity.activity') . ' | ' . trans('activity.create_activity');
        return view('activities.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ActivityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $activity = $this->repository->create($request->all());

            $response = [
                'message' => trans('activity.created'),
                'data'    => $activity->toArray(),
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
        $activity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activity,
            ]);
        }

        return view('activities.show', compact('activity'));
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


        $title = trans('activity.activity') . ' | ' . trans('activity.update_activity');
        $activity = $this->repository->find($id);

        return view('activities.edit', compact('activity','title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ActivityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $activity = $this->repository->update($request->all(),$id );

            $response = [
                'message' => trans('activity.updated'),
                'data'    => $activity->toArray(),
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

        return redirect()->back()->with('ok', trans('activity.deleted'));
    }
}
