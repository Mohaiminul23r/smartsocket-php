<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\DeviceUser;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    // public function index(User $model)
    // {
    //     return view('users.index', ['users' => $model->paginate(15)]);
    // }
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware(function ($request, $next) {
            
            if(env('ROLE_ENABLE',0) == 1){                
                if (!$request->user()->hasPermission($request->route()->action['as'])){
                    return redirect('warning');
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request, User $model)
    {
        if ($request->wantsJson()){
            $user = new User();
            return $user->DataTableLoader($request);
        }
        $roles = Role::all();
        return view('users.index',compact('roles'));
    }

    public function create(Request $request)
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'city' => 'nullable',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        $request['password'] = bcrypt($request->password);
        $user = user::create($request->all());
    }
    public function destroy(User $user)
    {
        $device->delete();
    }

    public function viewDetails($id)
    {
        $user_data = User::findOrFail($id)
                    ->with('mobiles','roles')
                    ->get()->first();
        $device_data = User::where('id',$id)->with('devices.type','devices.ports')->get()->first();
        return view('users.view_details', compact('user_data', 'device_data'));
        
    }

    public function edit()
    {
        return view('users.edit');
    }
    public function update(Request $request)
    {
         $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'city' => 'required',
        'country' => 'required',

    ]);
        auth()->user()->update($request->all());

        return back()->withStatus(__('User successfully updated.'));
    }

    public function updateStatus(Request $request, User $user){
        if($request->status != NULL){
            $user->status = $request->status;
        }
        return (($user->update()) ? 1 : 0);
    }

    public function getUserRole($id){
        $user = user::findOrFail($id);
        $user_roles = $user->roles->pluck('id')->all();
        return $user_roles;
    }

    public function saveAssignedRole(Request $request, User $user){
        $user->roles()->sync($request->role);
    }
}
