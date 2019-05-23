<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
            $this->middleware('guest:admin');
            $this->middleware('guest:customer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'imageupload' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $image = $request->file('imageupload');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/user_profile_images');
        $image->move($destinationPath, $image_name);
        $validatedData['profile_image'] = $image_name;
        // return $validatedData;
        try {
            $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
            $validatedData['activation_code'] = str_random(30).time();
            $user                             = app(Customer::class)->create($validatedData);
        } catch (\Exception $exception) {
            return "unable to create new user ".$exception;
            logger()->error($exception);
            return redirect()->back()->with('error', 'Unable to create new user.');
        }
        // return "registered succesfully";
        // $user->notify(new UserRegisteredSuccessfully($user));
        return redirect()->route('viewlogin')->with('registersuccess', 'Successfully created a new account. Please check your email and activate your account.');
    }
    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
            $user = app(Customer::class)->where('activation_code', $activationCode)->first();
            if (!$user) {
                return "The code does not exist for any user in our system.";
            }
            $user->status = 1;
            $user->email_verified_at = Carbon::now();
            $user->activation_code = null;
            $user->save();
            return redirect('/viewlogin')->with( ['verifysuccess' => 'Account Verification Successfull ! Now you can login with your account.'] );;
        } catch (\Exception $exception) {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->to('/viewlogin');
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    // public function showAdminRegisterForm()
    // {
    //     return view('auth.register', ['url' => 'admin']);
    // }

    // public function showCustomerRegisterForm()
    // {
    //     return view('auth.customer-register', ['url' => 'customer']);
    // }

    // protected function createCustomer(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     $customer = Customer::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'profile_image' => $request['image'],
    //         'status' => '1',
    //         'password' => Hash::make($request['password']),
    //     ]);
    //     return redirect()->intended('auth.customer-login');
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
    //     return "asd";
    // }
}
