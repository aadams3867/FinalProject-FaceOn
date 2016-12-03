<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'image' => 'required|max:255',
            'gallery_name' => 'required|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // $path = $data['image']->store($data['gallery_name'])
        // $handle = fopen($_FILES["UploadFileName"]["tmp_name"], 'r');
        
        // Creates a URL to be stored in the db
        $halfpath = $data['gallery_name'] . "/" . $data['image'];
        $url = Storage::url($halfpath);
        //$url = Storage::url($data['image']);

        // Uploads the image file to S3
/*        $path = Storage::putFile(
            $data['gallery_name'], $request->file($data['image'])
        );

echo $url;
die;*/

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
//            'image' => $data['image'],
            'image' => $url,
            'gallery_name' => $data['gallery_name']
        ]);
    }
}
