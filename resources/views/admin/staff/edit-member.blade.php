@extends('admin.master.template')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Member: <span class="text-info">{{ $staffMember->name }}</span></h1>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- New Member Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit member details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-staff', $staffMember->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputName">Name</label>
                          <input name="name" value="{{ old('name', $staffMember->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName">
                          @error('name')
                            <div id="inputNameFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Email address</label>
                          <input name="email" value="{{ old('email', $staffMember->email) }}" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('email')
                            <div id="inputEmailFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPhone">Phone</label>
                          <input name="phone" value="{{ old('phone', $staffMember->phone) }}" type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhone">
                          @error('phone')
                            <div id="inputPhoneFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Member type</label>
                            <select name="type" value="{{ old('type', $staffMember->type) }}" class="form-control @error('type') is-invalid @enderror" id="exampleFormControlSelect1">
                              <option value="editor" {{ $staffMember->type == 'editor' ? 'selected' : '' }}>Editor</option>
                              <option value="asistent" {{ $staffMember->type == 'asistent' ? 'selected' : '' }}>Asistent</option>
                              <option value="manager" {{ $staffMember->type == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            @error('type')
                              <div id="inputTypeFeedback" class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        <div class="form-group col-md-6">
                          <label for="inputPhoto">Photo</label>
                          <div class="mb-3 rounded mx-auto d-block" id="image-preview">
                            @if ($staffMember->photo == 'staff-member.png')
                                <img src="{{ asset('admin/img/staff/' . $staffMember->photo) }}" width="60" alt="No staff image">
                            @else
                                <img src="{{ $staffMember->photoUrl() }}" width="120" alt="Staff member photo">
                            @endif
                          </div>
                          <input name="photo" value="{{ old('photo') }}" type="file" accept="image/*" class="form-control-file @error('photo') is-invalid @enderror" id="inputPhoto">
                          @error('photo')
                            <div id="inputPhotoFeedback" class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                        <button type="submit" class="btn btn-primary">Update member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    @include('scripts.image-preview')
@endsection
