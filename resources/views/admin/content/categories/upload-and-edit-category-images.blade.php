@extends('admin.master.template')
    
@section('content')
    @include('admin.content.upload-and-edit-images')
@endsection

@section('custom-js')
    @include('scripts.upload-and-edit-images-sweet-alert')
@endsection