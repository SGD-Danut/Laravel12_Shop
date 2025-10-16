<div class="col-lg-4">
    @foreach ($brands as $brand)
    <div class="product-offer mb-30" style="height: 200px;">
        <img class="img-fluid" src="{{ $brand->imageUrl() }}" alt="">
        <div class="offer-text">
            <h6 class="text-white text-uppercase">{!! $brand->description !!}</h6>
            <h3 class="text-white mb-3">{{ $brand->name }}</h3>
            <a href="" class="btn btn-primary">Shop Now</a>
        </div>
    </div>
    @endforeach
</div>