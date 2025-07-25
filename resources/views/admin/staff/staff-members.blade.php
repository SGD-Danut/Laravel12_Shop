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
            <h6 class="m-0 font-weight-bold text-primary">List of the {{ $blockedStaffMembers ? 'blocked' : '' }} staff members ({{ $staffMembers->count() }}) </h6>
            @if ($blockedStaffMembers)
                <h6 class="text-right"><a href="{{ route('show-staff') }}">Staff members</a></h6>
            @else
                <h6 class="text-right"><a href="{{ route('show-staff', ['blocked' => true]) }}">Blocked staff members</a></h6>
            @endif
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
                                    <img src="{{ $staffMember->photoUrl() }}" width="60" alt="No staff image">
                                @endif
                            </td>
                            <td>{{ $staffMember->type }}</td>
                            <td>
                                @if (!$staffMember->trashed())
                                    {{-- Edit staff member button: --}}
                                    <a title="Edit staff member" href="{{ route('edit-staff', $staffMember->id) }}" class="btn btn-success btn-circle">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    {{-- Block staff member form + button: --}}
                                    <form id="form-soft-delete-{{ $staffMember->id }}" action="{{ route('block-staff', $staffMember->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    {{-- Block staff member - JavaScript Popup Confirmation: --}}
                                    {{-- <button title="Block staff member" class="btn btn-danger btn-circle" onclick="
                                    if (confirm('Confirmați blocarea membrului: {{ $staffMember->name }}?')) {
                                        document.getElementById('form-soft-delete-{{ $staffMember->id }}').submit();
                                    }"><i class="fas fa-user-slash"></i>
                                    </button> --}}
                                    {{-- Block staff member - SweetAlert Confirmation: --}}
                                    <button title="Block staff member" class="btn btn-danger btn-circle"
                                    onclick="softDeleteConfirm('form-soft-delete-{{ $staffMember->id }}', '{{ $staffMember->name }}')">
                                    <i class="fas fa-user-slash"></i>
                                    </button>
                                @else
                                    {{-- Restore staff member form + button: --}}
                                    <form id="form-restore-{{ $staffMember->id }}" action="{{ route('restore-staff', $staffMember->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                    </form>
                                    {{-- Restore staff member - SweetAlert Confirmation: --}}
                                    <button title="Restore staff member" class="btn btn-primary btn-circle"
                                    onclick="restoreConfirm('form-restore-{{ $staffMember->id }}', '{{ $staffMember->name }}')">
                                    <i class="fas fa-unlock"></i>
                                    </button>
                                    {{-- Permanent delete staff member form + button: --}}
                                    <form id="form-permanent-delete-{{ $staffMember->id }}" action="{{ route('delete-staff', $staffMember->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                    </form>
                                    {{-- Permanent delete staff member - SweetAlert Confirmation: --}}
                                    <button title="Permanent delete staff member" class="btn btn-danger btn-circle"
                                    onclick="permanentDeleteConfirm('form-permanent-delete-{{ $staffMember->id }}', '{{ $staffMember->name }}')">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
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

@section('custom-js')
    @include('admin.master.parts.scripts.sweet-alert')
@endsection