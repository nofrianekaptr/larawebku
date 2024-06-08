<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectAfterLogin()
    {
        $redirectUrl = 'dashboard';
        return to_route($redirectUrl);
    }
}
