<?php

namespace App\Http\Controllers;

use App\User;
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
        return view('users.index');
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
        return view('users.view_details', compact('user_data', 'device_data'));
        
    }
    public function updateStatus(Request $request, User $user){
        if($request->status != NULL){
            $user->status = $request->status;
        }
        return (($user->update()) ? 1 : 0);
    }
}
