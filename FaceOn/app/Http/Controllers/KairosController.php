<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kairos;

class KairosController extends Controller
{
	public $kairos_cred;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the Kairos login.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kairos_login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        GLOBAL $kairos_cred;

		$kairos_cred = new Kairos(config('kairos_app.id'), config('kairos_app.key'));

var_dump($kairos_cred);
die;

        // Call Kairos API to see if the image is recognized
        Kairos::recognize();

    }

    /**
     * Download image file from Amazon S3.
     *
     * @param $data Image filename
     * @return Response
     */
    public function downloadFileFromS3($data)
    {
        // Send a GetObject request
        $s3->getObject([
            'Bucket' => 'face-on-bucket',
            'Key'    => 'AKIAJGVM46L2RHCVU2NA',  // FIX
/*            'SourceFile'   => $data,*/
            'SaveAs'   => 'C:\Users\angsu\Desktop', // The path to a file to save the obj data - FIX
        ]);


/*echo $halfURL;
?><br><br><?php
echo $url;
?><br><br><?php
var_dump($data);
die;*/

    }
}



