<div>
    <input wire:model='productImage' type="file" class="d-none" accept="image/*" id="input-{{ $model->id }}">
    @if ($productImage)
        <img src="{{ $productImage->temporaryUrl() }}" width="60" alt="" role="button"
        onclick="document.getElementById('input-{{ $model->id }}').click();">
    @else
        @if ($model->image != 'product.png')
            <img src="{{ $model->imageUrl() }}" width="60" alt="" role="button"
            onclick="document.getElementById('input-{{ $model->id }}').click();">
        @else
            <img src="{{ $model->defaultImageUrl() }}" width="60" alt="" role="button"
            onclick="document.getElementById('input-{{ $model->id }}').click();">
        @endif
    @endif
    @error('productImage') <span class="text-danger">{{ $message }}</span> @enderror
    <div wire:loading wire:target="productImage" class="spinner-border" role="status"></div>
</div>
