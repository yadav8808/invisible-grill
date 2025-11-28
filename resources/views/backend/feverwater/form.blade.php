@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Feverwater
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($feverwater) ? 'Edit Feverwater' : 'Add Feverwater' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('feverwaters.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($feverwater) ? 'Edit Feverwater' : 'Add Feverwater' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($feverwater) ? route('feverwaters.update', $feverwater->id) : route('feverwaters.store') }}"
                          method="POST" enctype="multipart/form-data" id="feverwater-form">
                        @csrf
                        @if(isset($feverwater))
                            @method('PUT')
                        @endif

                        <div class="row">
                            {{-- Page Type --}}
                            <div class="col-sm-6 col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Page Type</label>
                                    <select name="page_type" class="form-control">
                                        <option value="">-- Select Page Type --</option>
                                        <option value="1" {{ old('page_type', $feverwater->page_type ?? '') == 1 ? 'selected' : '' }}>Fever</option>
                                        <option value="2" {{ old('page_type', $feverwater->page_type ?? '') == 2 ? 'selected' : '' }}>Water</option>
                                    </select>
                                    @error('page_type') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                           value="{{ old('title', $feverwater->title ?? '') }}"
                                           class="form-control" placeholder="Enter title">
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                              {{-- Title Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                           value="{{ old('title_hindi', $feverwater->title_hindi ?? '') }}"
                                           class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('title_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>




                            {{-- Description --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="text-red">*</span></label>
                                    <textarea name="description" class="form-controlb summernote" rows="4">{{ old('description', $feverwater->description ?? '') }}</textarea>
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Description Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description (Hindi) <span class="text-red">*</span></label>
                                    <textarea name="description_hindi" class="form-control summernote" rows="4">{{ old('description_hindi', $feverwater->description_hindi ?? '') }}</textarea>
                                    @error('description_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>


  {{-- Status --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $feverwater->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $feverwater->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>


                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($feverwater) ? 'Update Feverwater' : 'Save Feverwater' }}
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
