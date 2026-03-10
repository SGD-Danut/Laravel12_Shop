<!-- Modal -->
<div wire:ignore.self class="modal fade" id="productCategoriesModal" tabindex="-1" aria-labelledby="productCategoriesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      @isset($currentProduct)
        <form wire:submit.prevent="setProductCategories">
          <div class="modal-header">
            <h5 class="modal-title" id="productCategoriesModalLabel"> Edit categories for product: <br> <span class="text-info">{{ $currentProduct->name }}</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Product section: <span class="text-danger">{{ $currentProduct->section->name }}</span></h4>
            @foreach ($currentProduct->section->categories->sortBy('name') as $productCategory)
            <div class="form-check">
              <input wire:model="productCategories" 
                    value="{{ $productCategory->id }}" 
                    class="form-check-input" 
                    type="checkbox" 
                    id="productCategoryCheck{{ $productCategory->id }}">
              
              <label class="form-check-label @if(in_array($productCategory->id, $productCategories)) text-primary @endif" 
                    for="productCategoryCheck{{ $productCategory->id }}">
                  {{ $productCategory->name }}
              </label>
          </div>
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Product Categories</button>
          </div>
        </form>
      @endisset
    </div>
  </div>
</div>

@include('scripts.set-product-categories-sweet-alert')