<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
    <div class="navbar-nav w-100">
        {{-- <div class="nav-item dropdown dropright">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                <a href="" class="dropdown-item">Men's Dresses</a>
                <a href="" class="dropdown-item">Women's Dresses</a>
                <a href="" class="dropdown-item">Baby's Dresses</a>
            </div>
        </div> --}}
        @forelse ($sections as $section)
            <a href="{{ route('show-section', $section->slug) }}" class="nav-item nav-link"><i class="{{ $section->icon }}"></i> {{ $section->name }}</a>
        @empty
            <p>No sections in site.</p>
        @endforelse
    </div>
</nav>