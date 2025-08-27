<div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($sections as $section)
            <li data-target="#header-carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @forelse ($sections as $section)
            <div class="carousel-item position-relative {{ $loop->index == 0 ? 'active' : '' }}" style="height: 430px;">
                <img class="position-absolute w-100 h-100" src="{{ $section->imageUrl() }}" style="object-fit: cover;" alt="{{ $section->name }}">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><i class="{{ $section->icon }}"></i> {{ $section->name }}</h1>
                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{ $section->description }}</p>
                        <a href="{{ route('show-section', $section->slug) }}" class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
    </div>
</div>