<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
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

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
