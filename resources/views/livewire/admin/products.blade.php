<div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
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
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $products->currentPage() > 1 ? $loop->iteration + $products->perPage() * ($products->currentPage() - 1) : $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td class="text-center">
                                    @if ($product->image != 'product.png')
                                        <img src="{{ $product->imageUrl() }}" width="60" alt="">
                                    @else
                                        <img src="{{ $product->defaultImageUrl() }}" width="60" alt="">
                                    @endif
                                </td>
                                <td>{{ $product->price }} / {{ $product->discount }}</td>
                                <td>{{ $product->views }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->position }}</td>
                                <td>{{ $product->created_at->format('d.m.Y') }}</td>
                                <td></td>
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
