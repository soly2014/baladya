<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContractorCreateRequest;
use App\Http\Requests\ContractorUpdateRequest;
use App\Repositories\Interfaces\ContractorRepository;
use App\Validators\ContractorValidator;
use App;
use DB;


class ContractorsController extends Controller
{

    /**
     * @var ContractorRepository
     */
    protected $repository;

    /**
     * @var ContractorValidator
     */
    protected $validator;

    public function __construct(ContractorRepository $repository, ContractorValidator $validator)
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
        $contractors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contractors,
            ]);
        }
        $title = trans('contractor.contractor');

        return view('contractors.index', compact('contractors','title'));
    }

    public function create()
    {
        # code...
        $resQuars = App\Models\ResQuar::all();
        $title = trans('contractor.contractor'). '|' .trans('contractor.create_contractor');
        return view('contractors.create',compact('title','resQuars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContractorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contractor = $this->repository->create($request->all());

            foreach ($request->all()['resQuars'] as $res) {
                # code...
                $con_res = new App\Contractor_res();
                $con_res->contractor_id = $contractor->id;
                $con_res->res_quar_id = $res;
                $con_res->save();
            }

            

            $response = [
                'message' => trans('contractor.created'),
                'data'    => $contractor->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Session::flash('success',trans('dashboard.created'));
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
        $contractor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contractor,
            ]);
        }

        return view('contractors.show', compact('contractor'));
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
        $resQuars = App\Models\ResQuar::all();
        $contractor = $this->repository->find($id);

        

        $title = trans('contractor.contractor'). '|' .trans('contractor.update_contractor');
        return view('contractors.edit', compact('contractor','title','resQuars','selectedres'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ContractorUpdateRequest $request
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

            $contractor = $this->repository->update($request->all(), $id);

            DB::table('contractor_res_quar')->where('contractor_id','=',$contractor->id)->delete();

            if($request->has('resQuars')) {
                $contractor->resQuars()->attach($request->get('resQuars'));
            }

            $response = [
                'message' => trans('contractor.updated'),
                'data'    => $contractor->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Session::flash('success',trans('dashboard.updated'));
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
        return redirect()->back()->with('ok', trans('contractor.deleted'));
    }

    
    public function getContractorRes($id)
    {
        # code...
        $contractor = App\Models\User::findOrFail($id);
        $resids = $contractor->resQuars->pluck('id')->toArray();
        $resnames = $contractor->resQuars->pluck('name')->toArray();
        return response()->json(['ids'=>$resids , 'names'=>$resnames]);
    }
}
