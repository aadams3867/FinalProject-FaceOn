<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kairos;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Lang;

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
        GLOBAL $url, $kairos;

        // Upload the image file to Amazon S3
        RegisterController::uploadFileToS3('verify', $request['image']);

        // Set up Kairos object with credentials
        $kairos = new Kairos(config('kairos_app.id'), config('kairos_app.key'));

        // Setup up array of data to submit to Kairos
        $argumentArray = array(
            'image' => $url,
            'subject_id' => $request['name'],
            'gallery_name' => $request['gallery_name']
        );

        // Call Kairos API to see if the image is verified
        $response = $kairos->verify($argumentArray);

        // Reformat the response 
		$jsonDecoded = json_decode($response, true);

		// Check for errors
		if (array_key_exists('Errors', $jsonDecoded)) {
			echo "ERROR: ";
			var_dump($jsonDecoded['Errors'][0]['Message']);
			?><br><br><?php
			echo $url;
			?><br><br><?php
			die;
		}

		// Login logic
		if ($jsonDecoded['images'][0]['transaction']['confidence'] >= 0.75) {
			// Facial verification!  On to Phase 2.
			return redirect()->route('phase2');
		} else {
			// Imposter!  Try again.
			return redirect()->back()
            ->withInput($request->only('name', 'gallery_name'))
            ->withErrors([
                'image' => Lang::get('auth.failed'),
            ]);			
		}

    }

/*
echo $url;
?><br><br><?php
var_dump($data);
die;*/

}