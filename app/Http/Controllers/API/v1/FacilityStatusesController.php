<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FacilityStatusCreateRequest;
use App\Http\Requests\FacilityStatusUpdateRequest;
use App\Repositories\Interfaces\FacilityStatusRepository;
use App\Validators\FacilityStatusValidator;


class FacilityStatusesController extends Controller
{

    /**
     * @var FacilityStatusRepository
     */
    protected $repository;

    /**
     * @var FacilityStatusValidator
     */
    protected $validator;

    public function __construct(FacilityStatusRepository $repository, FacilityStatusValidator $validator)
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
        $facilityStatuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $facilityStatuses,
            ]);
        }

        return view('facilityStatuses.index', compact('facilityStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FacilityStatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityStatusCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $facilityStatus = $this->repository->create($request->all());

            $response = [
                'message' => 'FacilityStatus created.',
                'data'    => $facilityStatus->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

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
        $facilityStatus = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $facilityStatus,
            ]);
        }

        return view('facilityStatuses.show', compact('facilityStatus'));
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

        $facilityStatus = $this->repository->find($id);

        return view('facilityStatuses.edit', compact('facilityStatus'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  FacilityStatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(FacilityStatusUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $facilityStatus = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'FacilityStatus updated.',
                'data'    => $facilityStatus->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

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
                'message' => 'FacilityStatus deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'FacilityStatus deleted.');
    }
}
