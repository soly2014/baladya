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

        return view('facilities.index', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FacilityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $facility = $this->repository->create($request->all());

            $response = [
                'message' => 'Facility created.',
                'data'    => $facility->toArray(),
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

        $facility = $this->repository->find($id);

        return view('facilities.edit', compact('facility'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  FacilityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(FacilityUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $facility = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Facility updated.',
                'data'    => $facility->toArray(),
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
                'message' => 'Facility deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Facility deleted.');
    }
}
