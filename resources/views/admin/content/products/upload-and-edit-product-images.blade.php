@extends('admin.master.template')
    
@section('content')
    @livewire('admin.upload-and-edit-images', ['uploadImagesFor' => $uploadImagesFor, 'model' => $product, 'path' => 'products'])
@endsection

@section('custom-js')
    @include('scripts.upload-and-edit-images-sweet-alert')
@endsection