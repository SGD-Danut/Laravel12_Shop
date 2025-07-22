@extends('admin.master.template')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Staff Members</h1>
    <!-- New Staff Member Card + Button -->
    <div class="card-body">
        <a href="{{ route('show-new-staff') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">New Member</span>
        </a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of the staff members</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($staffMembers as $staffMember)
                        <tr>
                            <td>{{ $staffMember->name }}</td>
                            <td>{{ $staffMember->email }}</td>
                            <td>{{ $staffMember->phone }}</td>
                            <td>
                                @if ($staffMember->photo == 'staff-member.png')
                                    <img src="{{ asset('admin/img/staff/' . $staffMember->photo) }}" width="60" alt="No staff image">
                                @else
                                    <img src="{{ asset('storage/images/admin/staff/' . $staffMember->photo) }}" width="60" alt="No staff image">
                                @endif
                            </td>
                            <td>{{ $staffMember->type }}</td>
                            <td></td>
                        </tr>
                        @empty
                            <p>Nu sunt membrii staff!</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection