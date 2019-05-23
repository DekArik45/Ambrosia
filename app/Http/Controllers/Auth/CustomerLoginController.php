<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.customer-login');
    }
    
    use AuthenticatesUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function username(){
        return 'username';
    }

    /**
    * Handle a login request to the application.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    *
    * @throws \Illuminate\Validation\ValidationException
    */

    public function login(Request $request){

        $credential =[
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::guard('customer')->attempt($credential,$request->member)){
            return redirect()->intended(route("customer.home"));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout() {
        Auth::guard('customer')->logout();
        return redirect("/");
      }
}
