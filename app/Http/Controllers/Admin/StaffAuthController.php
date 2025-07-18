<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Auth\StaffLoginRequest;
use Illuminate\Support\Facades\Auth;

class StaffAuthController extends Controller
{
    public function showStaffLoginForm() {
        return view('admin.login');
    }

    public function staffLogin(StaffLoginRequest $request) {
        $request->authenticate();

        $request->session()->regenerate();

        Alert::success('Ești autentificat.', 'Autentificarea a avut loc cu succes!')->persistent(true, false);
        return redirect()->intended(route('admin-dashboard'));
    }
    
    public function staffLogout() {
        Auth::guard('staff')->logout();
        Alert::success('Deconectare cu succes!', 'Ați fost deconectat din administrare!');
        return redirect(route('show-home-page'));
    }
}
