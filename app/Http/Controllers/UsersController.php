<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ResQuar;
use App\Models\Role;
use App\Models\Service;
use App\Models\Contractor;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryRepository;
use App\Validators\UserValidator;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UsersController extends Controller
{

    /**
     * @var
     */
    protected $repository;

    /**
     * @var
     */
    protected $validator;




    public function __construct(UserRepositoryRepository $repository, UserValidator $validator)
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
        $users= $this->repository->all();

        $title = trans('users.users');
        return view('users.index', compact('users','title'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $resQuars = ResQuar::all();
        $companies = Company::all();
        $contractors = Role::find(4)->users;
        $roles = Role::all();
        $title = trans('users.users'). '|' .trans('users.create_user');
        return view('users.create',compact('title','services','resQuars','roles','companies','contractors'));
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $this->validate($request, [

            'code' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',
            'service_id' => 'required',

        ]);


        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $inputs =$request->all();
            $inputs['password'] = bcrypt($request->password);
            if($inputs['contractor_id']=='')
                $inputs['contractor_id']=null;

           // $user = $this->repository->create($inputs);
            $user = new User();
            foreach ($inputs as $key=>$value){
                if ($key != '_token' && $key !='role_id'&& $key !='resQuars') {

                    $user[$key] = $value;
                }
            }
            $user->save();

            $roleId=$request->get('role_id');
            $userObj= User::find($user->id);
            $userObj->roles()->attach($roleId);
            $activation = Activation::create($user);

            Activation::complete($user, $activation->code);
            if($request->has('resQuars'))
            $userObj->resQuars()->attach($request->get('resQuars'));

            $response = [
                'message' => trans('users.created'),
                'data'    => $user->toArray(),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Service::all();
        $resQuars = ResQuar::all();
        $roles = Role::all();
        $user= User::find($id);
        $contractors = Role::find(4)->users;
        $title = trans('contractor.contractor'). '|' .trans('dashboard.details');
        $view=1;
        return view('users.edit', compact('user','contractors','title','view','services','resQuars','roles'));
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::all();
        $resQuars = ResQuar::all();
        $companies = Company::all();
        $contractors = Role::find(4)->users;

        $roles = Role::all();
        $user = $this->repository->find($id);
        $title = trans('contractor.contractor'). '|' .trans('users.update_user');
        return view('users.edit', compact('user','contractors','title','services','resQuars','roles','companies'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',


        ]);

        try {
            $input=$request->all();
            if($request->has('password')){
                $input['password']=bcrypt($request->get('password'));
            }


            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($input, $id);
            $userObj= User::find($user->id);

            DB::table('res_quar_user')->where('user_id','=',$userObj->id)->delete();

            if($request->has('resQuars')) {
                $userObj->resQuars()->detach($request->get('resQuars'));
                $userObj->resQuars()->attach($request->get('resQuars'));
            }
            $response = [
                'message' => trans('contractor.updated'),
                'data'    => $user->toArray(),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        Session::flash('success','تم الحذف');

        return redirect()->back();

    }

    public function updatePassword(Request $request)
    {
        $this->middleware('guest');
        $user =  User::where('code','=',$request->all()['code'])->first();
        if(count($user)>0)
        {
            $user->password = bcrypt($request->all()['password']);
            $user->save();
            return response()->json([
                    'status'   => 1
                ]);
        }
        else
        {
            return response()->json([
                    'status'   => 0
                ]);
        }
    }

    
}
