<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserVisitCreateRequest;
use App\Http\Requests\UserVisitUpdateRequest;
use App\Repositories\Interfaces\UserVisitRepository;
use App\Validators\UserVisitValidator;


class UserVisitsController extends Controller
{

    /**
     * @var UserVisitRepository
     */
    protected $repository;

    /**
     * @var UserVisitValidator
     */
    protected $validator;

    public function __construct(UserVisitRepository $repository, UserVisitValidator $validator)
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
        $userVisits = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userVisits,
            ]);
        }

        return view('userVisits.index', compact('userVisits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserVisitCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserVisitCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userVisit = $this->repository->create($request->all());

            $response = [
                'message' => 'UserVisit created.',
                'data'    => $userVisit->toArray(),
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
        $userVisit = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userVisit,
            ]);
        }

        return view('userVisits.show', compact('userVisit'));
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

        $userVisit = $this->repository->find($id);

        return view('userVisits.edit', compact('userVisit'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserVisitUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(UserVisitUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userVisit = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'UserVisit updated.',
                'data'    => $userVisit->toArray(),
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
                'message' => 'UserVisit deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserVisit deleted.');
    }
}
