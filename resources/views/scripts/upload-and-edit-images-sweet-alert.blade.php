<!-- SweetAlert custom script -->
<script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
<script>
    // SweetAlert pentru pentru validare client a numarului de imagini selectate:
    document.getElementById("images").addEventListener("change", function() {
        if (this.files.length > 12) {
            Swal.fire({
                icon: 'error',
                title: 'Too many files: ' + this.files.length + ' uploaded, 12 max',
                text: 'You can upload max 12 files one time',
                footer: '<h4>If you need to upload more than 12 files you mus repeat the upload process!</h4>'
            });
            this.value = '';
        }
    });
</script>
<!-- Permanent delete image with SweetAlert confirm window custom script -->
<script>
    window.permanentDeleteImageConfirm = function(id, name) {
        Swal.fire({
            icon: 'question',
            text: 'Do you want to permanent delete image: ' + name + ' ?',
            showCancelButton: true,
            confirmButtonText: 'Permanent delete',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('permanent-delete-image', { imageId: id });
                Swal.fire({
                    icon: 'info',
                    text: 'Image: ' + name + ' was deleted!',
                })
            }
        });
    }
</script>
<!-- Permanent delete all images with SweetAlert confirm window custom script -->
<script>
    window.permanentDeleteAllImagesConfirm = function() {
        Swal.fire({
            icon: 'question',
            text: 'Do you want to permanent delete all images ?',
            showCancelButton: true,
            confirmButtonText: 'Permanent delete all',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('permanent-delete-all-images');
                Swal.fire({
                    icon: 'info',
                    text: 'All images were deleted!',
                })
            }
        });
    }
</script>