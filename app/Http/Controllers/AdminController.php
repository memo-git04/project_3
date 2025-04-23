<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.modules.user.index_user', [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get roles from database
        $roles = \App\Models\Role::all();
        return view('admin.modules.user.add_user',[
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        Admin::create([
            'username' => $request->user_name,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address'=>$request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        //return
//        dd($request);
        return Redirect::route('users.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //get roles from database
        $roles = \App\Models\Role::all();
        return view('admin.modules.user.edit_user', [
            'admin' => $admin,
            'roles' =>$roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin->update([
            'username' => $request->edit_username,
            'full_name' => $request->edit_fullname,
            'phone' => $request->edit_phone,
            'address'=>$request->edit_address,
            'email' => $request->edit_email,
            'role_id' => $request->edit_role,
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return Redirect::route('users.index');
    }


    public function login()
    {
        return view('admin.login.page-login');
    }
    public function loginProcess(Request $request)
    {
        $accounts = $request->only(['email', 'password']);
        //        dd($accounts);
        if (Auth::guard('admin')->attempt($accounts)) {
            //lay du lieu cuar nguoi dang nhap
            $admin = Auth::guard('admin')->user();
            Auth::guard('admin')->login($admin);
            //luu du lieu cua nguoi dang nhap len session
            session(['admin' => $admin]);
            return Redirect::route('home');
        } else {
            return Redirect::back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->forget('admin');
        return Redirect::route('login');
    }
}
