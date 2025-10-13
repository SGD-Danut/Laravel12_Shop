<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Upload images</h1>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-11">
            <!-- Upload Images Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload images for {{ $uploadImagesFor }}: <span class="text-info"> {{ $model->name }}</span></h6>
                </div>
                <div class="card-body">
                    {{-- Cod pentru mesajul de success trimis din fișierul de tip Clasă --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- Codul pentru afișarea imaginilor selectate pentru încărcare: --}}
                    @if ($images)
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($images as $image)
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <img src="{{ $image->temporaryUrl() }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-{{ $this->getFileSizeClass($image->getSize()) }}">{{ $image->getClientOriginalName() }}</h5>
                                            <p class="card-text"></p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-{{ $this->getFileSizeClass($image->getSize()) }}">Size: {{ $this->formatFileSize($image->getSize()) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h6 class="text-warning"><strong>{{ $model->name }}</strong>  nu are nici-o imagine selectată pentru încărcare.</h6>
                    @endif
                    {{-- Formularul pentru selectarea imaginilor pentru încărcare: --}}
                    <form wire:submit="save">
                        <div class="form-group col-md-4">
                            <input type="file" wire:model="images" class="form-control-file" id="images" accept="image/*" multiple>
                            @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @if ($images)
                            <button type="submit" class="btn btn-primary">Save images</button>
                        @endif
                    </form>

                    <hr>

                    {{-- Codul pentru afișarea imaginilor deja încărcatee, cele ce aparțin categoriei: --}}
                    @if ($model->images->count() > 0)
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($model->images as $image)
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <input wire:model="newImages.{{ $image->id }}" type="file" class="d-none" accept="image/*" id="image-input-{{ $image->id }}">
                                        @if (!empty($newImages[$image->id]))
                                            <img src="{{ $newImages[$image->id]->temporaryUrl() }}" 
                                                class="card-img-top" 
                                                alt="..." 
                                                onclick="document.getElementById('image-input-{{ $image->id }}').click()" 
                                                style="cursor: pointer">
                                        @else
                                            <img src="{{ $image->imageable->galleryUrl() . $image->name }}" 
                                                class="card-img-top" 
                                                alt="..." 
                                                onclick="document.getElementById('image-input-{{ $image->id }}').click()" 
                                                style="cursor: pointer">
                                        @endif
                                        @error('newImages.' . $image->id)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div wire:loading wire:target="newImages.{{ $image->id }}"><span class="text-info">Uploading...</span></div>
                                        <div class="card-body">
                                            <input wire:model.live.debounce.1000ms="titles.{{ $image->id }}" type="text" class="form-control" title="Image title" id="title-{{ $image->id }}" placeholder="Image title">
                                            <div wire:loading wire:target="titles.{{ $image->id }}" class="text-info">Saving title...</div>
                                            @error("titles.$image->id")<div class="text-danger">{{ $message }}</div>@enderror
                                            <input wire:model.live.debounce.1000ms="descriptions.{{ $image->id }}" type="text" class="form-control" title="Image description" id="description-{{ $image->id }}" placeholder="Image description">
                                            <div wire:loading wire:target="descriptions.{{ $image->id }}" class="text-info">Saving description...</div>
                                            @error("descriptions.$image->id")<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <input wire:model.live.debounce.1000ms="positions.{{ $image->id }}" type="number" class="form-control" title="Image position" id="position-{{ $image->id }}">
                                                    <div wire:loading wire:target="positions.{{ $image->id }}" class="text-info">Saving position...</div>
                                                </div>
                                                {{-- Permanent delete image - SweetAlert Confirmation: --}}
                                                <button title="Permanent delete image" class="btn btn-danger btn-circle"
                                                    onclick="permanentDeleteImageConfirm('{{ $image->id }}', '{{ $image->name }}')">
                                                    <i class="fas fa-eraser"></i>
                                                </button>
                                            </div>
                                            @error("positions.$image->id")<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button onclick="permanentDeleteAllImagesConfirm()" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-eraser"></i>
                            </span>
                            <span class="text">Delete all images</span>
                        </button>
                    @else
                        <h6 class="text-warning"><strong>{{ $model->name }}</strong> nu are nici-o imagine în galerie.</h6>
                    @endif
                </div>
            </div>
        </div> 
    </div>
</div>

{{-- Din clasă se lansează un eveniment Livewire, aici ascultăm după acel eveniment și afișăm un mesaj de succes cu SweetAlert: --}}
@script
<script>
    $wire.on('upload-images-message', (successMessage) => {
        Swal.fire({
            icon: 'success',
            title: 'Imaginile au fost încărcate cu succes!',
            text: successMessage,
        });
        document.getElementById('images').value = '';
    });
</script>
@endscript
