<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postEmail(Request $request)
    {


        $this->validate($request, ['username' => 'required|email']);

        $response = Password::sendResetLink($request->only('username'), function (Message $message) {

            $message->from('info@siyaleader.co.za', 'Siyaleader');
            $message->subject("Siyaleader Notification - Your Password Reset Link: ");
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['username' => trans($response)]);
        }
    }

}
