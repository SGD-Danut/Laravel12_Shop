@extends('admin.master.template')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sections</h1>
    <div class="card-body">
        <a href="{{ route('new-section') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">New Section</span>
        </a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of the sections: {{ $sections->count() }}</h6>
        </div>
        <div class="card-body">
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
                        @forelse ($sections as $section)
                            <tr>
                                <td>
                                    @if (isset($section->icon))
                                        <i class="{{ $section->icon }}"></i>
                                    @else
                                        <i class="fas fa-puzzle-piece"></i>
                                    @endif
                                        {{ $section->name }}
                                </td>
                                <td>{{ $section->description }}</td>
                                <td>
                                    @if ($section->image == 'section.png')
                                        <img src="{{ asset('admin/img/content/sections/' . $section->image) }}" width="60" alt="No staff image">
                                    @else
                                        <img src="{{ $section->imageUrl() }}" width="60" alt="No section image">
                                    @endif
                                </td>
                                <td>{{ $section->position }}</td>
                                <td>
                                    @livewire('admin.section-status',['section' => $section])
                                </td>
                                <td>
                                    
                                </td>                                                        
                            </tr>
                        @empty
                            <p>Nu sunt secțiuni!</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection