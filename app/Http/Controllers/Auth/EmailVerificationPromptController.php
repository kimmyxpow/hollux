<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if (auth()->user()->hasRole('admin')) {
                return to_route('dashboard.admin.index');
            }

            if (auth()->user()->hasRole('receptionist')) {
                return to_route('dashboard.receptionist.index');
            }

            if (auth()->user()->hasRole('user')) {
                return to_route('dashboard.user.index');
            }
        }
        
        return view('auth.verify-email');
    }
}
