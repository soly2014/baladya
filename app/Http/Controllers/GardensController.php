<?php

namespace App\Http\Controllers;

use App\Models\ResQuar;
use App\Models\Street;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GardenCreateRequest;
use App\Http\Requests\GardenUpdateRequest;
use App\Repositories\Interfaces\GardenRepository;
use App\Validators\GardenValidator;


class GardensController extends Controller
{

    /**
     * @var GardenRepository
     */
    protected $repository;

    /**
     * @var GardenValidator
     */
    protected $validator;

    public function __construct(GardenRepository $repository, GardenValidator $validator)
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
        $gardens = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $gardens,
            ]);
        }

        return view('gardens.index', compact('gardens'));
    }



    /*  start create */
    public function create(){

        $streets = Street::all();
        $resQuars= ResQuar::all();
        return view('gardens.create',compact('streets','resQuars'));
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  GardenCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'street_id' => 'required',
            'res_quar_id' => 'required',
            'name' => 'required',

        ]);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $garden = $this->repository->create($request->all());

            $response = [
                'message' => 'Garden created.',
                'data'    => $garden->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Session::flash('success',trans('dashboard.created'));
            return redirect()->back()->with('message', $response['message']);
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
        $garden = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $garden,
            ]);
        }

        return view('gardens.show', compact('garden'));
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

        $garden = $this->repository->find($id);

        $streets = Street::all();
        $resQuars= ResQuar::all();

        return view('gardens.edit', compact('garden','streets','resQuars'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GardenUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $garden = $this->repository->update($request->all(),$id);

            $response = [
                'message' => 'Garden updated.',
                'data'    => $garden->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Session::flash('success',trans('dashboard.updated'));
            return redirect()->back()->with('message', $response['message']);
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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Garden deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Garden deleted.');
    }
}
