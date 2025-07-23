<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStaffMemberRequest;
use App\Http\Requests\UpdateStaffMemberRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ManagerController extends Controller
{
    public function showStaffMembers() {
        $staffMembers = Staff::all()->whereNotIn('id', 1)->sortBy('name');
        return view('admin.staff.staff-members')->with('staffMembers', $staffMembers);
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
}
