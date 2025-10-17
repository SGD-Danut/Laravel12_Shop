<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach ($brands as $brand)
                    <a href="{{ route('show-brand', $brand->slug) }}">
                        <div class="bg-light p-4">
                            @if ($brand->image != 'brand.png')
                                <img src="{{ $brand->imageUrl }}" alt="">
                            @else
                                <img src="{{ $brand->defaultImageUrl }}" alt="">
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->