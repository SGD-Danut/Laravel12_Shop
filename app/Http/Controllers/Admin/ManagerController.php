<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStaffMemberRequest;
use App\Http\Requests\UpdateStaffMemberRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules\Password;

class ManagerController extends Controller
{
    public function showStaffMembers() {
        // Obținem membrii staff neșterși fără managerul principal și îi salvăm într-o variabilă:
        $staffMembers = Staff::all()->whereNotIn('id', 1)->sortBy('name');
        // Dacă în request avem valoarea 'blocked', membrii neșterși o să fie înlocuiți cu cei șterși cu soft delete:
        if (request('blocked') == true) {
            $staffMembers = Staff::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
        }
        // Întoarcem vederea și punem la dispoziție vederii:
        return view('admin.staff.staff-members')
        ->with('staffMembers', $staffMembers) // utilizatorii neșterși sau șterși cu soft delete.
        ->with('blockedStaffMembers', request('blocked')); // o variabilă care ne va spune dacă avem valoarea blocked în request sau nu.
    }

    public function showNewStaffForm () {
        return view('admin.staff.new-member');
    }

    public function createNewStaffMember(AddStaffMemberRequest $request) {
        $staff = new Staff();

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            $request->file('photo')->move('storage/images/admin/staff' , $photoName);
            $staff->photo = $photoName;
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->type = $request->type;
        $staff->password = bcrypt($request->password);
        $staff->save();

        return redirect(route('show-staff'))->with('success', "A fost creat membrul staff-ului numit: " . $request->name);
    }

    public function editStaffMember($staffMemberId) {
        $staffMember = Staff::findOrFail($staffMemberId);
        return view('admin.staff.edit-member')->with('staffMember', $staffMember);
    }

    public function updateStaffMember(UpdateStaffMemberRequest $request, $staffMemberId) {
        $staffMember = Staff::findOrFail($staffMemberId);

        if ($request->hasFile('photo')) {
            if ($staffMember->photo != 'staff-member.png') {
                File::delete($staffMember->photoPath());
            }
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photoName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            $request->file('photo')->move('storage/images/admin/staff' , $photoName);
            $staffMember->photo = $photoName;
        }

        $staffMember->name = $request->name;
        $staffMember->email = $request->email;
        $staffMember->phone = $request->phone;
        $staffMember->type = $request->type;
        $staffMember->save();

        $successMessage = 'Membrul staff-ului numit: ' . $request->name . ' a fost actualizat cu succes!';
        Alert::success('Actualizare date reușită!', $successMessage)->persistent(true, false);
        return back()->with('success', $successMessage);
    }

    public function updateStaffMemberPassword(Request $request, $staffMemberId) {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ]
        ]);

        $staffMember = Staff::findOrFail($staffMemberId);
        $staffMember->password = bcrypt($request->password);
        $staffMember->save();

        $successMessage = 'Parola membrului staff: ' . '<strong>' . $staffMember->name . '</strong>' . ' a fost actualizată! Noua parolă este: ' . '<strong>' . $request->password . '</strong>';
        Alert::success('Parolă actualizată!', $successMessage)->toHtml()->persistent(true, false);
        return back()->with('success', $successMessage);
    }

    public function blockStaffMember($staffMemberId) {
        $staffMember = Staff::findOrFail($staffMemberId);
        $staffMember->delete();

        $successMessage = 'Membrul staff: <strong>' . $staffMember->name . '</strong> a fost blocat!';
        Alert::success('Membru blocat!', $successMessage)->toHtml()->persistent(true, false);
        return back()->with('success', $successMessage);
    }

    public function restoreStaffMember($staffMemberId) {
        $staffMember = Staff::onlyTrashed()->where('id', $staffMemberId)->first();
        $staffMember->restore();
        
        $successMessage = 'Membrul staff: <strong>' . $staffMember->name . '</strong> a fost deblocat!';
        Alert::success('Membru deblocat!', $successMessage)->toHtml()->persistent(true, false);
        return redirect(route('show-staff'))->with('success', $successMessage);
    }

    public function permanentDeleteStaffMember($staffMemberId) {
        $staffMember = Staff::onlyTrashed()->where('id', $staffMemberId)->first();
        
        if ($staffMember->photo != 'staff-member.png') {
            File::delete($staffMember->photoPath());
        }

        $staffMember->forceDelete();
        
        $successMessage = 'Membrul staff: <strong>' . $staffMember->name . '</strong> a fost șters definitiv!';
        Alert::success('Membru șters definitiv!', $successMessage)->toHtml()->persistent(true, false);
        return redirect(route('show-staff'))->with('success', $successMessage);
    }
}
