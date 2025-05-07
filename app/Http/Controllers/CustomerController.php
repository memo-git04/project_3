<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function register(){
        return view('shop.login.register');
    }
    public function registerProcess(Request $request)
    {
        //validate data
        if($request->password != $request->repeatpass)
        {
            return Redirect::back();
        }

        $customer = Customer::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

//        dd($customer);
        return Redirect::route('customerLogin',[
            'customer' => $customer,
        ]);
    }

    public function customerLogin()
    {
        return view('shop.login.login');
    }
    public function loginCustomerProcess(\Illuminate\Http\Request $request)
    {
        $accounts = $request->only(['email', 'password']);

        if(Auth::guard('customer')->attempt($accounts))
        {
            //get data of customer
            $customer = Auth::guard('customer')->user();
            Auth::guard('customer')->login($customer);
            //data of customer login put in session
            session(['customer' => $customer]);
            //redirect to home page
            return Redirect::route('homePage');
        }else
        {
            return Redirect::back();
        }
    }
    public function logoutCustomer()
    {
        Auth::guard('customer')->logout();
        session()->forget('customer');
        return Redirect::route('homePage');
    }



}
