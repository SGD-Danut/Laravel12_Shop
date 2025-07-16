@extends('front.master.template')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a href="{{ route('my-account-page') }}" class="nav-item nav-link text-dark {{ request()->routeIs('my-account-page') ? 'active' : '' }}">Description</a>
                        <a href="{{ route('my-account-change-password') }}" class="nav-item nav-link text-dark {{ request()->routeIs('my-account-change-password') ? 'active' : '' }}">Change Password</a>
                    </div>
                    <div class="tab-content">
                        @if (request()->routeIs('my-account-page'))
                            <div class="tab-pane active">
                                <h4 class="mb-3">Description</h4>
                                <p>Here is your personal menu where you can do actions about your account.</p>
                                <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                            </div>    
                        @endif
                        @yield('my-account-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection