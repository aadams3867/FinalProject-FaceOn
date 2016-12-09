<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KairosController extends Controller
{
	public $kairos;

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
        return view('kairos');
    }

    /**
     * Send a request to Kairos API to see if the image is recognized.
     *
     * @return Response
     */
    public function recognize()
    {
        GLOBAL $kairos;

        echo $kairos;
        die;
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



