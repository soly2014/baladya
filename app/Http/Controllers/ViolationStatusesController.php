<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ViolationStatusCreateRequest;
use App\Http\Requests\ViolationStatusUpdateRequest;
use App\Repositories\Interfaces\ViolationStatusRepository;
use App\Validators\ViolationStatusValidator;


class ViolationStatusesController extends Controller
{

    /**
     * @var ViolationStatusRepository
     */
    protected $repository;

    /**
     * @var ViolationStatusValidator
     */
    protected $validator;

    public function __construct(ViolationStatusRepository $repository, ViolationStatusValidator $validator)
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
        $violationStatuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $violationStatuses,
            ]);
        }

        return view('violationStatuses.index', compact('violationStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ViolationStatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ViolationStatusCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $violationStatus = $this->repository->create($request->all());

            $response = [
                'message' => trans('facility_status.created'),
                'data'    => $violationStatus->toArray(),
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
        $violationStatus = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $violationStatus,
            ]);
        }

        return view('violationStatuses.show', compact('violationStatus'));
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

        $violationStatus = $this->repository->find($id);

        return view('violationStatuses.edit', compact('violationStatus'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ViolationStatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ViolationStatusUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $violationStatus = $this->repository->update($id, $request->all());

            $response = [
                'message' => trans('facility_status.updated'),
                'data'    => $violationStatus->toArray(),
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
        return redirect()->back()->with('ok', trans('facility_status.deleted'));
    }
}
