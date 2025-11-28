@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Director
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($director) ? 'Edit Director' : 'Add Director' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('directors.index') }}" class="btn btn-primary">
                            <i class="feather feather-arrow-left fs-15 my-auto me-2"></i>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title">{{ isset($director) ? 'Edit Director' : 'Add Director' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($director) ? route('directors.update', $director->id) : route('directors.store') }}"
                          method="POST" enctype="multipart/form-data" id="director-form">
                        @csrf
                        @if(isset($director))
                            @method('PUT')
                        @endif

                        <div class="row">
                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                           value="{{ old('title', $director->title ?? '') }}"
                                           class="form-control" placeholder="Enter title">
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Title Hindi --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                           value="{{ old('title_hindi', $director->title_hindi ?? '') }}"
                                           class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('title_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="text-red">*</span></label>
                                    <input type="text" name="name"
                                           value="{{ old('name', $director->name ?? '') }}"
                                           class="form-control" placeholder="Enter name">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Name Hindi --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="hn_name"
                                           value="{{ old('hn_name', $director->hn_name ?? '') }}"
                                           class="form-control" placeholder="हिंदी नाम">
                                    @error('hn_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Designation --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Designation<span class="text-red">*</span></label>
                                    <input type="text" name="designation"
                                           value="{{ old('designation', $director->designation ?? '') }}"
                                           class="form-control" placeholder="Enter designation">
                                    @error('designation') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Designation Hindi --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Designation (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="hn_designation"
                                           value="{{ old('hn_designation', $director->hn_designation ?? '') }}"
                                           class="form-control" placeholder="हिंदी पद">
                                    @error('hn_designation') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Description<span class="text-red">*</span></label>
                                <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description" >{{ old('description', $director->description ?? '') }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                          {{-- Description Hindi --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Description Hindi<span class="text-red">*</span></label>
                                <textarea name="hn_description" class="form-control summernote" rows="3" placeholder="Enter description_hindi">{{ old('hn_description', $director->hn_description ?? '') }}</textarea>
                                @error('hn_description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $director->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $director->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                                    @if(isset($director) && $director->image)
                                        <div class="mt-2">
                                    <img id="image_preview" src="{{ isset($director) ? $director->image_url : '' }}"
                                         alt="Preview" height="100"
                                         style="display: {{ isset($director) ? 'block' : 'none' }};">
                                </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($director) ? 'Update Director' : 'Save Director' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {!! $validator !!}
@endpush
