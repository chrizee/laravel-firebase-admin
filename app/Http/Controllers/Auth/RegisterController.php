<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register')->with(["title" => "Register"]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            "pic" => "nullable|image|max:1999"
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return User
     * @internal param array $data
     */
    protected function create(Request $request)
    {
        //handle file upload
        if($request->hasFile('pic') && $request->file("pic")->isValid()) {
            $extension = $request->file('pic')->getClientOriginalExtension();
            $fileNameToStore = 'user_'.uniqid().'.'.$extension; //make he filename unique
            $request->file('pic')->storeAs('public/user_images', $fileNameToStore);
        } else {
            $fileNameToStore = $this->noUser;
        }

        $data = $request->all();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'picture' => $fileNameToStore
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

}
