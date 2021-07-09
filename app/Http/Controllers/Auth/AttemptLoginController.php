<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttemptLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (!auth()->attempt($request->only('username', 'password'))) {
            return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
                'password' => 'Wrong password'
            ]);
        }

        return redirect()->intended('/');
    }
}
