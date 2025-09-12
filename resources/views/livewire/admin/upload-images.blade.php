<div>
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
                {{-- <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($model->galleryUrl() . $image->name) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-muted">{{ $image->name }}</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div> --}}
                @livewire('admin.edit-images', ['theOldImageForEditing' => $image, 'path' => 'categories/' . $model->id . '/'])
            @endforeach
        </div>
        <div class="card-body">
            <button onclick="permanentDeleteAllImagesConfirm()" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-eraser"></i>
                </span>
                <span class="text">Delete all images</span>
            </button>
        </div>
    @else
        <h6 class="text-warning"><strong>{{ $model->name }}</strong> nu are nici-o imagine în galerie.</h6>
    @endif
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