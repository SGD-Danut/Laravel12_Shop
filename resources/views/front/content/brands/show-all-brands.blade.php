@extends('front.master.template')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Brands</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Brands Details Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <!-- Shop Brands Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h3>All Brands:</h3>
                        </div>
                    </div>
                    @forelse ($brands as $brand)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @if ($brand->image != 'brand.png')
                                    <img class="img-fluid w-100" src="{{ $brand->imageUrl() }}" alt="">
                                @else
                                    <img class="img-fluid w-100" src="{{ $brand->defaultImageUrl() }}" alt="">
                                @endif
                                
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('show-brand', $brand->slug) }}"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h5 text-decoration-none text-truncate" href="">{{ $brand->name }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <h5>No brans to show.</h5>
                    @endforelse
                </div>
            </div>
            <!-- Shop Brands End -->
        </div>
    </div>
    <!-- Brands Details End -->
@endsection