{{-- Legătură către scriptul ckeditor: --}}
<script src="/ckeditor/ckeditor.js"></script>
{{-- Se face legătura cu texarea-ul cu id="textareaDescription": --}}
<script>
    CKEDITOR.replace( 'textareaDescription' );
</script>
{{-- Dezactivare mesaj de atenționare că trebuie actualizat ckeditor-ul la ultima versiune: --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const observer = new MutationObserver(() => {
            const notifArea = document.querySelector('.cke_notifications_area');
            if (notifArea) {
                notifArea.remove();
                observer.disconnect(); // oprește observarea după ștergere
            }
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });
</script>