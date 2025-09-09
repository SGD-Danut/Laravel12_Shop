@extends('admin.master.template')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categories</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of the categories by sections:</h6>
        </div>
        <div class="card-body">
            @forelse ($sections as $section)
                <div class="card bg-light mb-3" >
                    <div class="card-header bg-primary text-white">{{ $section->name }} <span class="text-white float-right">{{ $section->categories->count() }} categories</span></div>
                    <div class="card-body">
                        <div class="card-header">
                            <a href="{{ route('new-category', $section->id) }}" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">New Category</span>
                            </a>
                        </div>
                        <div class="table-responsive">             
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Position</th>
                                        <th>Active / Promoted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Position</th>
                                        <th>Active / Promoted</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($section->categories as $category)
                                        <tr>
                                            <td>
                                                @if (isset($category->icon))
                                                    <i class="{{ $category->icon }}"></i>
                                                @else
                                                    <i class="fas fa-puzzle-piece"></i>
                                                @endif
                                                    {{ $category->name }}
                                            </td>
                                            <td>{!! $category->description !!}</td>
                                            <td>
                                                @if ($category->image == 'category.png')
                                                    <img src="{{ $category->defaultImageUrl() }}" width="60" alt="category image">
                                                @else
                                                    <img src="{{ $category->imageUrl() }}" width="60" alt="category image">
                                                @endif
                                            </td>
                                            <td>{{ $category->position }}</td>
                                            <td>
                                                @livewire('admin.section-status',['section' => $category])
                                            </td>
                                            <td>
                                                {{-- Edit category button: --}}
                                                <a title="Edit category" href="{{ route('edit-category', $category->id) }}" class="btn btn-success btn-circle">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {{-- Image gallery for category button: --}}
                                                <a title="Image gallery for category" href="{{ route('manage-category-images', $category->id) }}" class="btn btn-primary btn-circle">
                                                    <i class="far fa-images"></i>
                                                </a>
                                            </td>                                                        
                                        </tr>
                                    @empty
                                        <p>Nu sunt categorii!</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nu sunt secțiuni!</p>
            @endforelse
        </div>
    </div>
@endsection