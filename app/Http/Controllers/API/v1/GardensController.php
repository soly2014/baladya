<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  GardenCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GardenCreateRequest $request)
    {

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

        return view('gardens.edit', compact('garden'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GardenUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GardenUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $garden = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Garden updated.',
                'data'    => $garden->toArray(),
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
                'message' => 'Garden deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Garden deleted.');
    }
}
