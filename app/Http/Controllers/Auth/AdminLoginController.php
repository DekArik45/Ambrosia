<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    
    use AuthenticatesUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
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
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::guard('admin')->attempt($credential,$request->member)){
            return redirect()->intended(route("admin.home"));
        }
        return redirect()->back()->withInput($request->only('username','remember'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect("/admin/login");
      }
}
