<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Phone;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return Validator::make($data, [
            'salutation' => ['required', 'string', 'in:mrs,ms,mr'],
            'name' => ['required', 'string', 'max:45'],
            'last_name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:15', 'regex:/[A-Z]+/', 'regex:/[a-z]+/'],
            'company_name' => ['required', 'string', 'max:100'],
            'country_code' => ['required', 'string', 'max:45'],
            'country_calling_code' => ['required', 'string', 'max:45'],
            'e164' => ['required', 'string', 'max:45'],
            'country_id' => ['required', 'integer', 'exists:countries,id']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if($user){
            $phone = $user->phone()->create($data);
            $company = $user->company()->create([
                'name' => $data['company_name'],
                'country_id' => $data['country_id']
            ]);
        }
        return $user;
    }
}
