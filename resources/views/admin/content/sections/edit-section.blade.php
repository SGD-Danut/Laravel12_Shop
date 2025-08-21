@extends('admin.master.template')
  
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Section : <span class="text-info">{{ $section->name }} </span><span class="text-danger">Id: {{ $section->id }}</span></h1>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-11">
            <!-- New Section Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Section</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-section', $section->id) }}" method="POST" enctype="multipart/form-data">
                      @method('put')
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputName">Name</label>
                          <input onblur="setSlug()" name="name" value="{{ old('name', $section->name) }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName">
                          @error('name')
                            <div id="inputNameFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputSlug">Slug</label>
                          <input name="slug" value="{{ old('slug', $section->slug) }}" id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="inputSlug" aria-describedby="slugHelp">
                          @error('slug')
                            <div id="inputSlugFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                          <small id="slugHelp" class="form-text text-muted">When viewing the section, the slug will be displayed at the top of the address bar.</small>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputDescription">Description</label>
                          <input name="description" value="{{ old('description', $section->description) }}" type="text" class="form-control @error('description') is-invalid @enderror" id="inputDescription">
                          @error('description')
                            <div id="inputDescriptionFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPosition">Position</label>
                            <input name="position" value="{{ old('position', $section->position) }}" type="number" class="form-control @error('position') is-invalid @enderror" id="inputPosition">
                            @error('position')
                              <div id="inputPositionFeedback" class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputIcon"><i class="{{ isset($section->icon) ? $section->icon : 'fas fa-puzzle-piece' }}"></i>Icon (font-awesome)</label>
                            <input name="icon" value="{{ old('icon', $section->icon) }}" type="text" class="form-control @error('icon') is-invalid @enderror" id="inputIcon">
                            @error('icon')
                              <div id="inputIconFeedback" class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label>Visibility</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active" id="active1" value="1" {{ old('active', $section->active) == 1 ? 'checked' : '' }} @if (is_null(old('active', $section->active))) checked @endif>
                                <label class="form-check-label" for="active1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active" id="active2" value="0" {{ old('active', $section->active) === 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="active2">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>State</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="promoted" id="promoted1" value="0" {{ old('promoted', $section->promoted) === 0 ? 'checked' : '' }} @if (is_null(old('promoted', $section->promoted))) checked @endif>
                                <label class="form-check-label" for="promoted1">
                                    Standard
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="promoted" id="promoted2" value="1" {{ old('promoted', $section->promoted) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="promoted2">
                                    Promoted
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPhoto">Photo</label>
                          <div class="mb-3 rounded mx-auto d-block" id="image-preview">
                            <img src="{{ $section->imageUrl() }}" width="120" alt="Section image">
                          </div>
                          <input name="image" value="{{ old('image') }}" type="file" accept="image/*" class="form-control-file @error('image') is-invalid @enderror" id="inputPhoto">
                          @error('image')
                            <div id="inputPhotoFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputMetaTitle">Meta title</label>
                          <input name="meta_title" value="{{ old('meta_title', $section->meta_title) }}" type="text" class="form-control @error('meta_title') is-invalid @enderror" id="inputMetaTitle">
                          @error('meta_title')
                            <div id="inputMetaTitleFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputMetaDescription">Meta description</label>
                          <input name="meta_description" value="{{ old('meta_description', $section->meta_description) }}" type="text" class="form-control @error('meta_description') is-invalid @enderror" id="inputMetaDescription">
                          @error('meta_description')
                            <div id="inputMetaDescriptionFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputMetaKeywords">Meta keywords</label>
                          <input name="meta_keywords" value="{{ old('meta_keywords', $section->meta_keywords) }}" type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="inputMetaKeywords">
                          @error('meta_keywords')
                            <div id="inputMetaKeywordsFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('custom-js')
    @include('scripts.image-preview');
    @include('scripts.transform-to-slug')
@endsection