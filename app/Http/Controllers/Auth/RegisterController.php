<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;

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
    protected $redirectTo = '/admin/dashboard';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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

        // $header = ['Content-Type' => 'application/json'];
        // $body = array('business_name' => $data['business_name']);
        // $body = json_encode($body);
        // $client = new Client();
        // $res = $client->request('POST','https://asia-northeast1-gdgdemo-219811.cloudfunctions.net/wp_builder_function', array('headers' => $header, 'body' => $body));
        // if($res->getStatusCode() == 200){

        //     $str_lower = strtolower($data['business_name']);
        //     $business_name = preg_replace('/[^A-Za-z0-9\-]/', '', $str_lower);
        //     $redirectTo = $business_name.'dkjericsample.tk';
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                // 'business_name' => $business_name,
                'password' => Hash::make($data['password']),
            ]);
        // }else{
        //     return;
        // }

    }
}
