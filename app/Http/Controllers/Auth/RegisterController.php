<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $branch = ['nullable'];
        if (Hash::check('2', $data['role'])) {
            $role = USER::USER_STUDENT;
            $branch = ['required', 'integer', 'between:3,7'];
        } else if (Hash::check('0', $data['role'])) {
            $role = USER::USER_TEACHER;
        } else {
            session()->flash('error', 'It seems some fishing activity.');
            $error =  \Illuminate\Validation\ValidationException::withMessages([
                'role' => ['Role doesn\'t exists'],
            ]);
            throw $error;
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:512'],
            'verification_id' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:512'],
            'role' => ['required'],
            'branch' => $branch,
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $role = $data['role'];
        if (Hash::check('2', $role)) {
            $role = USER::USER_STUDENT;
            $branch = $data['branch'];
        } else if (Hash::check('0', $role)) {
            $role = USER::USER_TEACHER;
        }
        if (array_key_exists('image', $data)) {
            $image = $data['image']->store('images/users');
        } else {
            $image = null;
        }
        $verification_id = $data['verification_id']->store('images/verification_id');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $image,
            'verification_id' => $verification_id,
            'role' => $role,
            'verification_token' => User::generateVerificationCode()
        ]);

        if ($user->role == User::USER_STUDENT) {
            $user->update([
                'approval_status' => 1,
                'branch' => $branch
            ]);
        }
        session()->flash('success', 'We have sent a verification email. Please verify and try logging in.');
        return redirect()->route('login');
    }
}
