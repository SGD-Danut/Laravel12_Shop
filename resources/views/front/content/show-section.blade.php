@extends('front.master.template')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Section</a>
                    <span class="breadcrumb-item active">{{ $section->name }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Section Details Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <img class="w-100" src="{{ $section->image != 'section.png' ? $section->imageUrl() : $section->defaultImageUrl() }}" alt="Image">
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><i class="{{ $section->icon }}"></i> {{ $section->name }}</h3>
                    <p class="mb-4">{{ $section->description }}</p>
                </div>
            </div>
            <!-- Shop Section Categories Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h3>Categories of this section:</h3>
                        </div>
                    </div>
                    @forelse ($section->categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @if ($category->image != 'category.png')
                                    <img class="img-fluid w-100" src="{{ $category->imageUrl() }}" alt="">
                                @else
                                    <img class="img-fluid w-100" src="{{ $category->defaultImageUrl() }}" alt="">
                                @endif
                                
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('show-category', $category->slug) }}"><i class="fa fa-eye"></i></a>
                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a> --}}
                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> --}}
                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h5 text-decoration-none text-truncate" href="">{{ $category->name }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <h5>This section has no categories.</h5>
                    @endforelse
                </div>
            </div>
            <!-- Shop Section Categories End -->
        </div>
    </div>
    <!-- Section Details End -->
@endsection