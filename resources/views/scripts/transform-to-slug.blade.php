<script>
    function setSlug() {
        var theTitle = document.getElementById("name").value.toLowerCase().trim();

        var theSlug = theTitle.replace(/&/g, '-and-')
            .replace(/[^a-z0-9-]+/g, '-')
            .replace(/\-\-+/g, '-')
            .replace(/^-+|-+$/g, '');

        document.getElementById("slug").value = theSlug;
    }
</script>