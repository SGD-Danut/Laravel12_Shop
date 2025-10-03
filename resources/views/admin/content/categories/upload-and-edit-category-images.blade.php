@extends('admin.master.template')
    
@section('content')
    @livewire('admin.upload-and-edit-images', ['uploadImagesFor' => $uploadImagesFor, 'model' => $category, 'path' => 'categories'])
@endsection

@section('custom-js')
    @include('scripts.upload-and-edit-images-sweet-alert')
@endsection