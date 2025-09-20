@extends('admin.master.template')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Brands</h1>
    <div class="card-body">
        <a href="{{ route('new-brand') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">New Brand</span>
        </a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of the brands: {{ $brands->count() }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">             
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Meta: Description / Keywords</th>
                            <th>Image</th>
                            <th>Position</th>
                            <th>Active / Promoted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Meta: Description / Keywords</th>
                            <th>Image</th>
                            <th>Position</th>
                            <th>Active / Promoted</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <p class="text-primary">{{ $brand->meta_description }}</p>
                                    <p class="text-success">{{ $brand->meta_keywords }}</p>
                                </td>
                                <td>
                                    @if ($brand->image == 'brand.png')
                                        <img src="{{ $brand->defaultImageUrl() }}" width="60" alt="Brand image">
                                    @else
                                        <img src="{{ $brand->imageUrl() }}" width="60" alt="Brand image">
                                    @endif
                                </td>
                                <td>{{ $brand->position }}</td>
                                <td>
                                    @livewire('admin.section-status',['section' => $brand])
                                </td>
                                <td>
                                    {{-- Edit brand button: --}}
                                    {{-- <a title="Edit brand" href="{{ route('edit-brand', $brand->id) }}" class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a> --}}
                                </td>                                                        
                            </tr>
                        @empty
                            <p>Nu sunt brand-uri!</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection