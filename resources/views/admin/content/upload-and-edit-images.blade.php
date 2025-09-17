<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Upload images</h1>
<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-lg-11">
        <!-- Upload Images Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Upload images for {{ $uploadImagesFor }}: <span class="text-info"> {{ $category->name }}</span></h6>
            </div>
            <div class="card-body">
                @livewire('admin.upload-and-edit-images', ['model' => $category, 'path' => 'categories'])
            </div>
        </div>
    </div> 
</div>