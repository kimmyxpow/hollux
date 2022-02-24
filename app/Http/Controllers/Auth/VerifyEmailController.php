<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->hasRole('admin')) {
                return to_route('dashboard.admin.index', ['verified' => 1]);
            }

            if ($request->user()->hasRole('receptionist')) {
                return to_route('dashboard.receptionist.index', ['verified' => 1]);
            }

            if ($request->user()->hasRole('user')) {
                return to_route('dashboard.user.index', ['verified' => 1]);
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($request->user()->hasRole('admin')) {
            return to_route('dashboard.admin.index', ['verified' => 1]);
        }

        if ($request->user()->hasRole('receptionist')) {
            return to_route('dashboard.receptionist.index', ['verified' => 1]);
        }

        if ($request->user()->hasRole('user')) {
            return to_route('dashboard.user.index', ['verified' => 1]);
        }
    }
}
