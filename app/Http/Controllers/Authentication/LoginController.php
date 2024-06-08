<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            Alert::success('Succesfully', 'Anda Berhasil Login !');
            return to_route('dashboard');
        } else {
            Alert::warning('Oops!', 'Data Anda Tidak Valid');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        auth()->logout();
        Alert::success('Succesfully', 'Anda Berhasil Logout !');
        return to_route('login');
    }
}
