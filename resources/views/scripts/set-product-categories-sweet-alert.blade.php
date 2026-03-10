<!-- SweetAlert custom script -->
<script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>

<script>
    // Ascultă pentru închiderea modalului
    window.addEventListener('close-modal', event => {
        $('#productCategoriesModal').modal('hide');
    });

    // Ascultă pentru SweetAlert
    window.addEventListener('swal:modal', event => {
        // În Livewire v3, datele sunt direct în event.detail
        let data = event.detail[0]; 
        
        Swal.fire({
            icon: data.type,
            title: data.title,
            text: data.text,
            timer: 3000,
            showConfirmButton: false,
            toast: true, // îl face să arate ca o notificare discretă
            position: 'top-end' // poziționat în colț
        });
    });
</script>