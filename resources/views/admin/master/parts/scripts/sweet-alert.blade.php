<!-- SweetAlert custom script -->
<script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
<script>
    // SweetAlert pentru pentru ștergerea temporară a membrului staff:
    window.softDeleteConfirm = function(formId, name) {
        Swal.fire({
            icon: 'question',
            text: 'Do you want to block: ' + name + ' ?',
            showCancelButton: true,
            confirmButtonText: 'Block',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
    // SweetAlert pentru restaurarea membrului staff:
    window.restoreConfirm = function(formId, name) {
        Swal.fire({
            icon: 'question',
            text: 'Do you want to restore: ' + name + ' ?',
            showCancelButton: true,
            confirmButtonText: 'Restore',
            confirmButtonColor: '#1cc88a',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
    // SweetAlert pentru ștergerea definitivă a membrului staff:
    window.permanentDeleteConfirm = function(formId, name) {
        Swal.fire({
            icon: 'question',
            text: 'Do you want to permanet delete: ' + name + ' ?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
