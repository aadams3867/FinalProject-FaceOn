<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Input;
use App;

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

    public $url;

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
            /*'gallery_name' => 'required|max:255'*/
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
        GLOBAL $url;

        // Creates a URL to be stored in the db
/*      $gallery = $data['gallery_name'];
        $img = $data['image'];
        $halfURL = $gallery . "/" . $img;  // From user input
        $url = Storage::url($halfURL);  // From config/filesystems.php*/

        RegisterController::uploadFileToS3($data['image'], $data['email']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'image' => $url,
            'gallery_name' => $data['email']
        ]);
    }

    /**
     * Upload image file to Amazon S3.
     *
     * @param $data Image filename
     * @return Response
     */
    public function uploadFileToS3($img, $gallery)
    {
        GLOBAL $url;

        // Create an S3 Client object
        $s3 = App::make('aws')->createClient('s3');

        // Assemble the 'gallery directory / file name' for S3
        $key = $gallery . '/' . $img->getClientOriginalName();

        // Send a PutObject request
        $s3->putObject([
            'Bucket' => 'face-on-bucket',
            'Key'    => $key,
            'SourceFile'   => $img->getRealPath(),
            'ContentType'   => $img->getMimeType(),
            'ContentDisposition'   => '',          
        ]);

        $url = $s3->getObjectUrl('face-on-bucket', $key);
//        $url = $s3->getObjectUrl('face-on-bucket', $img->getClientOriginalName());
    }
}
