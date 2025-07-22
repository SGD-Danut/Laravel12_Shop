<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStaffMemberRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

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
}
