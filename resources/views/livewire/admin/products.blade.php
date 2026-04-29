<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <div class="card-body">
        <a href="{{ route('new-product') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">New Product</span>
        </a>
    </div>
    <!-- Products Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $products->total() }} products {{ isset($selectedSectionTitle) ? 'from section:' . ' ' . $selectedSectionTitle : '' }} {{ isset($selectedCategoryTitle) ? 'and from category:' . ' ' . $selectedCategoryTitle : '' }}</h6>
            <br>
            <h6>Sections:</h6>
            @forelse ($sections as $section)
                <span wire:click="selectSection({{ $section->id }})" class="badge {{ $selectedSectionId == $section->id ? 'badge-primary' : 'badge-secondary' }}" style="cursor: pointer">{{ $section->name }}</span>
            @empty
                <p>No sections and no products!</p>
            @endforelse
            <br>
            <h6>Categories:</h6>
            @if (isset($selectedCategories))
                @forelse ($selectedCategories as $selectedCategory)
                    <span wire:click="selectCategory({{ $selectedCategory->id }})" class="badge {{ $selectedCategoryId == $selectedCategory->id ? 'badge-primary' : 'badge-secondary' }}" style="cursor: pointer">{{ $selectedCategory->name }}</span>
                @empty
                    <p>No selected section, no categories!</p>
                @endforelse
            @endif
        </div>
        @if (isset($products))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Section / Categories</th>
                                <th>Image</th>
                                <th>Price / Discount</th>
                                <th>Views</th>
                                <th>Stock</th>
                                <th>Position</th>
                                <th>Added date</th>
                                <th>Visibility / State</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Section / Categories</th>
                                <th>Image</th>
                                <th>Price / Discount</th>
                                <th>Views</th>
                                <th>Stock</th>
                                <th>Position</th>
                                <th>Added date</th>
                                <th>Visibility / State</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $products->currentPage() > 1 ? $loop->iteration + $products->perPage() * ($products->currentPage() - 1) : $loop->iteration }}</td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    Section: 
                                    <span wire:click="selectSection({{ $section->id }})" class="badge {{ $selectedSectionId == $section->id ? 'badge-primary' : 'badge-secondary' }}" style="cursor: pointer">{{ $product->section->name }}</span>
                                    <br>
                                    Categories:
                                    @forelse ($product->categories as $productCategory)
                                        <span wire:click="selectCategory({{ $productCategory->id }})" class="badge {{ $selectedCategoryId == $productCategory->id ? 'badge-primary' : 'badge-secondary' }}" style="cursor: pointer">{{ $productCategory->name }}</span>
                                    @empty
                                        <p>This product has no categories!</p>
                                    @endforelse
                                </td>
                                {{-- <td class="text-center" wire:ignore>
                                    @livewire('admin.product-image', ['model' => $product, 'defaultProductImage' => 'product.png', 'productImageDirectoryForSaving' => 'products'])
                                </td> --}}
                                <td>
                                    @if ($product->image == 'product.png')
                                        <img src="{{ $product->defaultImageUrl() }}" width="60" alt="Product image">
                                    @else
                                        <img src="{{ $product->imageUrl() }}" width="60" alt="Product image">
                                    @endif
                                </td>
                                <td>{{ $product->price }} / {{ $product->discount }}</td>
                                <td>{{ $product->views }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->position }}</td>
                                <td>{{ $product->created_at->format('d.m.Y') }}</td>
                                {{-- <td wire:ignore>
                                    @livewire('admin.section-status',['section' => $product])
                                </td> --}}
                                <td>  
                                    @if ($product->active)
                                        Active
                                    @else
                                        Inactive
                                    @endif

                                    /

                                    @if ($product->active)
                                        Promoted
                                    @else
                                        Standard
                                    @endif
                                </td>
                                <td>
                                    {{-- Edit product button: --}}
                                    <a title="Edit product" href="{{ route('edit-product', $product->id) }}" class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- Image gallery for product button: --}}
                                    <a title="Image gallery for product" href="{{ route('manage-product-images', $product->id) }}" class="btn btn-primary btn-circle">
                                        <i class="far fa-images"></i>
                                    </a>
                                    <!-- Button trigger for change categories modal -->
                                    <button wire:click="obtainProductId({{ $product->id }})" title="Edit product categories" type="button" class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#productCategoriesModal">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <div class="alert alert-warning">No products!</div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        @endif
    </div>
    @include('admin.content.products.product-categories-modal')
</div>
