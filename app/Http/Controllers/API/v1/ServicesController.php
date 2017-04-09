<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Repositories\Interfaces\ServiceRepository;
use App\Validators\ServiceValidator;


class ServicesController extends Controller
{

    /**
     * @var ServiceRepository
     */
    protected $repository;

    /**
     * @var ServiceValidator
     */
    protected $validator;

    public function __construct(ServiceRepository $repository, ServiceValidator $validator)
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
        $services = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $services,
            ]);
        }

        return view('services.index', compact('services'));
    }

    public function create()
    {
        # code...
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $service = $this->repository->create($request->all());

            $response = [
                'message' => 'Service created.',
                'data'    => $service->toArray(),
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
        $service = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $service,
            ]);
        }

        return view('services.show', compact('service'));
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

        $service = $this->repository->find($id);

        return view('services.edit', compact('service'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ServiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $service = $this->repository->update($request->all(),$id);

            $response = [
                'message' => 'Service updated.',
                'data'    => $service->toArray(),
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
                'message' => 'Service deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Service deleted.');
    }
}
