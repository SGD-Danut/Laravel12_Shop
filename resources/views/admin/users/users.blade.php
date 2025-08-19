@extends('admin.master.template')

@section('content')
    @livewire('admin.users')
    <!-- SweetAlert custom script -->
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
    <script>
        window.softDeleteUserConfirm = function(id, name) {
            Swal.fire({
                icon: 'question',
                text: 'Do you want to block: ' + name + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Block',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('block-user', { userId: id });
                    Swal.fire({
                        icon: 'info',
                        text: 'User: ' + name + ' was blocked!',
                    })
                }
            });
        }
    </script>
    <!-- Restore user with SweetAlert confirm window custom script -->
    <script>
        window.restoreUserConfirm = function(id, name) {
            Swal.fire({
                icon: 'question',
                text: 'Do you want to restore: ' + name + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Restore',
                confirmButtonColor: '#2d8534',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('restore-user', { userId: id });
                    Swal.fire({
                        icon: 'info',
                        text: 'User: ' + name + ' was restored!',
                    })
                }
            });
        }
    </script>
    <!-- Permanent delete user with SweetAlert confirm window custom script -->
    <script>
        window.permanentDeleteUserConfirm = function(id, name) {
            Swal.fire({
                icon: 'question',
                text: 'Do you want to permanent delete: ' + name + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Permanent delete',
                confirmButtonColor: '#e3342f',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('permanent-delete-user', { userId: id });
                    Swal.fire({
                        icon: 'info',
                        text: 'User: ' + name + ' was deleted!',
                    })
                }
            });
        }
    </script>
@endsection
