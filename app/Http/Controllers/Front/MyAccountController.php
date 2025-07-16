<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use RealRashid\SweetAlert\Facades\Alert;

class MyAccountController extends Controller
{
    public function showMyAccountPage() {
        return view('front.user.my-account.my-account');
    }

    public function showMyAccountChangePasswordPage() {
        return view('front.user.my-account.change-password');
    }

    public function changeUserPassword(Request $request) {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'confirmed', 'min:8'],
            'new_password_confirmation' => 'same:new_password'
        ]);

        $user = User::findOrFail(auth()->id());
        $user->password = bcrypt($request->new_password);
        $user->save();

        Alert::success('Parola a fost schimbata!', 'Salvati noua parola într-un loc sigur!');

        return back();
    }
}
