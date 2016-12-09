<?php

namespace App\Http\Controllers;         // Custom

use Illuminate\Support\Facades\Auth;    // Custom


    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {

echo "Hi!";
die;



        // Call Kairos API to see if the submitted image is recognized
/*        KairosController::recognize();*/

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Db authentication (email & password) passed
            // Now call Kairos API to see if the submitted image is recognized
            KairosController::recognize();

            if ($recognized) {
                // User is recognized!  Login successful.
                return redirect()->intended('/home');
            } else {
                // User is NOT recognized!  Try again.
/*                alert("User image was not recognized.  Please try again.");*/
                AuthenticatesUsers::sendFailedLoginResponse($request);
            }

        }
    }