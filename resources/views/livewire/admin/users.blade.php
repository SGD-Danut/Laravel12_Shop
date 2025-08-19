<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <!-- Search User Input -->
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="search-user-box">Search user</span>
        </div>
        <input wire:model.lazy="searchedUser" id="search-user" type="text" class="form-control" placeholder="Search by name or email" aria-describedby="search-user-box">
    </div>
    <!-- User Checkboxes, Radio -->
    <div class="form-check">
        <input wire:click="showUsersByType('public')" class="form-check-input" type="radio" name="typeOfUsers" id="publicUsers" value="public" checked>
        <label class="form-check-label" for="publicUsers">
            Public users
        </label>
    </div>
    <div class="form-check">
        <input wire:click="showUsersByType('blocked')" class="form-check-input" type="radio" name="typeOfUsers" id="blockedUsers" value="blocked">
        <label class="form-check-label" for="blockedUsers">
            Blocked users
        </label>
    </div>
    <!-- Users Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of users - {{ isset($foundUsers) ? $foundUsers->total() . ' user(s) found' : 'No users' }}</h6>
        </div>
        @if (isset($foundUsers))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th>Registered date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th>Registered date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($foundUsers as $foundUser)
                            <tr>
                                <td>{{ $foundUsers->currentPage() > 1 ? $loop->iteration + $foundUsers->perPage() * ($foundUsers->currentPage() - 1) : $loop->iteration }}</td>
                                <td>{{ $foundUser->name }}</td>
                                <td>{{ $foundUser->email }}</td>
                                <td>{{ $foundUser->email_verified_at ? 'Yes' : 'No' }}</td>
                                <td>{{ $foundUser->created_at->format('d.m.Y') }}</td>
                                <td>
                                    @if ($foundUser->trashed())
                                        {{-- Restore user member - SweetAlert Confirmation: --}}
                                        <button title="Restore user" class="btn btn-success btn-circle"
                                        onclick="restoreUserConfirm('{{ $foundUser->id }}', '{{ $foundUser->name }}')">
                                        <i class="fas fa-user-check"></i>
                                        </button>
                                        {{-- Permanent delete user member - SweetAlert Confirmation: --}}
                                        <button title="Permanent delete user" class="btn btn-danger btn-circle"
                                        onclick="permanentDeleteUserConfirm('{{ $foundUser->id }}', '{{ $foundUser->name }}')">
                                        <i class="fas fa-user-times"></i>
                                        </button>
                                    @else
                                        {{-- Block user member - SweetAlert Confirmation: --}}
                                        <button title="Block user" class="btn btn-warning btn-circle"
                                        onclick="softDeleteUserConfirm('{{ $foundUser->id }}', '{{ $foundUser->name }}')">
                                        <i class="fas fa-user-lock"></i>
                                        </button>
                                    @endif
                                    @if (!$foundUser->trashed())
                                        @if (!$foundUser->email_verified_at)
                                            {{-- Validate user email - JavaScript Alert Confirmation: --}}
                                            <button
                                                onclick="confirm('Confirm email validation for: {{ $foundUser->name }} ?') || event.stopImmediatePropagation()"
                                                wire:click="validateEmail({{ $foundUser->id }})" title="Validate email"
                                                class="btn btn-success btn-circle">
                                                <i class="fas fa-at"></i>
                                            </button>
                                        @else
                                            {{-- Invalidate user email - JavaScript Alert Confirmation: --}}
                                            <button
                                                onclick="confirm('Confirm email invalidation for: {{ $foundUser->name }} ?') || event.stopImmediatePropagation()"
                                                wire:click="invalidateEmail({{ $foundUser->id }})" title="Invalidate email"
                                                class="btn btn-danger btn-circle">
                                                <i class="fas fa-at"></i>
                                            </button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <div class="alert alert-warning">No user was found by the search criteria!</div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $foundUsers->links() }}
                </div>
            </div>
        @endif
    </div>
</div>