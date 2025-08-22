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
        </div>
    </div>
    <!-- Section Details End -->
@endsection