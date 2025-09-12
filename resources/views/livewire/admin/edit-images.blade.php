<div>
    <div class="col mb-4">
        <div class="card h-100">
            {{-- <img src="" class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <input wire:model.lazy="position" type="number" class="form-control" title="Image position" id="input-position-{{ $theOldImageForEditing->id }}">
                    </div>
                    {{-- Permanent delete image - SweetAlert Confirmation: --}}
                    <button title="Permanent delete image" class="btn btn-danger btn-circle"
                        onclick="permanentDeleteImageConfirm('{{ $theOldImageForEditing->id }}', '{{ $theOldImageForEditing->name }}')">
                        <i class="fas fa-eraser"></i>
                    </button>
                    <div class="form-group col-md-9">
                        @livewire('admin.section-status',['section' => $theOldImageForEditing])
                    </div>
                    <input wire:model="theNewImageForUpload" type="file" class="d-none" accept="image/*" id="image-input-{{ $theOldImageForEditing->id }}">
                    @if ($theNewImageForUpload)
                        <img src="{{ $theNewImageForUpload->temporaryUrl() }}" class="card-img-top" alt="..." id="image-itself-{{ $theOldImageForEditing->id }}" onclick="document.getElementById('image-input-{{ $theOldImageForEditing->id }}').click()" style="cursor: pointer">
                    @else
                         <img src="{{ $theOldImageForEditing->imageable->galleryUrl() . $theOldImageForEditing->name }}" class="card-img-top" alt="..." id="image-to-show-{{ $theOldImageForEditing->id }}" onclick="document.getElementById('image-input-{{ $theOldImageForEditing->id }}').click()" style="cursor: pointer">
                    @endif
                    <span class="text-danger">@error('theNewImageForUpload') {{ $message }} @enderror</span>
                    <div wire:loading wire:target="theNewImageForUpload"><span class="text-info">Uploading...</span></div>
                    <input wire:model.lazy="name" type="text" class="form-control" title="Image name" id="name" placeholder="Image name">
                    <input wire:model.lazy="description" type="text" class="form-control" title="Image description" id="description" placeholder="Image description">
                </div>
            </div>
        </div>
    </div>
</div>
