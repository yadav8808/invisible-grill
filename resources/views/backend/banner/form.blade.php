@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Banner
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($banner) ? 'Edit Banner' : 'Add Banner' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('banners.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($banner) ? 'Edit Banner' : 'Add Banner' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($banner) ? route('banners.update', $banner->id) : route('banners.store') }}"
                          method="POST" enctype="multipart/form-data" id="banner-form">
                        @csrf
                        @if(isset($banner))
                            @method('PUT')
                        @endif

                        <div class="row">
                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                           value="{{ old('title', $banner->title ?? '') }}"
                                           class="form-control" placeholder="Enter title">
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Title Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                           value="{{ old('title_hindi', $banner->title_hindi ?? '') }}"
                                           class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('title_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Subtitle --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="subtitle"
                                           value="{{ old('subtitle', $banner->subtitle ?? '') }}"
                                           class="form-control" placeholder="Enter subtitle">
                                    @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>


                        {{-- Subtitle Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Subtitle Hindi</label>
                                    <input type="text" name="subtitle_hindi"
                                           value="{{ old('subtitle_hindi', $banner->subtitle_hindi ?? '') }}"
                                           class="form-control" placeholder="Enter subtitle Hindi">
                                    @error('subtitle_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Description --}}


                            {{-- Position --}}
                           <div class="col-md-6 my-2">
                            <label class="form-label">Position By</label>
                            <select name="postion" class="form-control">
                                <option value="">-- Select Position --</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('postion', $page_management->postion ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                            {{-- Order --}}
                           <div class="col-sm-6 col-md-6">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="">-- Select Order --</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $banner->order ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>



                            {{-- Status --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $banner->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $banner->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Background Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Background Image <span class="text-red">*</span></label>
                                    <input type="file" name="background_image" class="form-control" accept=".jpg, .jpeg, .png,">
                                    @error('background_image') <small class="text-danger">{{ $message }}</small> @enderror

                                    @if(isset($banner) && $banner->background_image)
                                        <div class="mt-2">
                                            <img src="{{ asset($banner->background_image_url) }}" alt="Background" height="100">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Foreground Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Foreground Image</label>
                                    <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png,">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                                    @if(isset($banner) && $banner->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($banner->image_url) }}" alt="Banner Image" height="100">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                {{ isset($banner) ? 'Update Banner' : 'Save Banner' }}
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



