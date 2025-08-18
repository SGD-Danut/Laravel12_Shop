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
                                <td></td>
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