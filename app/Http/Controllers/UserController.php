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

    public function index(Request $request, User $model)
    {
        if ($request->wantsJson()){
            $user = new User();
            return $user->DataTableLoader($request);
        }
        $roles = Role::all();
        return view('users.index',compact('roles'));
    }

    public function destroy(User $user)
    {
        $device->delete();
    }

    public function viewDetails($id)
    {
        $user_data = User::findOrFail($id)
                    ->with('mobiles')
                    ->get()->first();
        $device_data = User::where('id',$id)->with('devices.type','devices.ports')->get()->first();

        $user = user::findOrFail($id);
        $user_roles = $user->roles->pluck('id')->all();
        $roles = Role::all();
        return view('users.view_details', compact('user_data', 'device_data','roles','user_roles'));
        
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
