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
            <h6 class="m-0 font-weight-bold text-primary">List of products - {{ $products->total() }}</h6>
        </div>
        @if (isset($products))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price / Discount</th>
                                <th>Views</th>
                                <th>Stock</th>
                                <th>Position</th>
                                <th>Added date</th>
                                <th>Active / Promoted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price / Discount</th>
                                <th>Views</th>
                                <th>Stock</th>
                                <th>Position</th>
                                <th>Added date</th>
                                <th>Active / Promoted</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $products->currentPage() > 1 ? $loop->iteration + $products->perPage() * ($products->currentPage() - 1) : $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td class="text-center">
                                    @livewire('admin.product-image', ['model' => $product, 'defaultProductImage' => 'product.png', 'productImageDirectoryForSaving' => 'products'], key($product->id))
                                </td>
                                <td>{{ $product->price }} / {{ $product->discount }}</td>
                                <td>{{ $product->views }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->position }}</td>
                                <td>{{ $product->created_at->format('d.m.Y') }}</td>
                                <td>
                                    @livewire('admin.section-status',['section' => $product], key($product->id))
                                </td>
                                <td>
                                    {{-- Edit product button: --}}
                                    <a title="Edit product" href="{{ route('edit-product', $product->id) }}" class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
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
</div>
