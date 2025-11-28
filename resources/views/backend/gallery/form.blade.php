@extends('backend.layouts.master')
@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">
            Gallery
            <span class="font-weight-normal text-muted ms-2">
                {{ isset($gallery) ? 'Edit Gallery Item' : 'Add Gallery Item' }}
            </span>
        </h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('galleries.index') }}" class="btn btn-primary">
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
                <h3 class="card-title">{{ isset($gallery) ? 'Edit Gallery Item' : 'Add Gallery Item' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($gallery) ? route('galleries.update', $gallery->id) : route('galleries.store') }}"
                      method="POST" enctype="multipart/form-data" id="gallery-form">
                    @csrf
                    @if(isset($gallery))
                        @method('PUT')
                    @endif

                    <div class="row">
                        {{-- Title --}}
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-red">*</span></label>
                                <input type="text" name="title"
                                       value="{{ old('title', $gallery->title ?? '') }}"
                                       class="form-control" placeholder="Enter title">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                                        {{-- Title Hindi --}}
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                        <input type="text" name="title_hindi"
                            value="{{ old('title_hindi', $gallery->title_hindi ?? '') }}"
                            class="form-control" placeholder="हिंदी शीर्षक">
                        @error('title_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>



                        {{-- Subtitle --}}
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle"
                                       value="{{ old('subtitle', $gallery->subtitle ?? '') }}"
                                       class="form-control" placeholder="Enter subtitle">
                                @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                    {{-- Subtitle Hindi --}}
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Subtitle (Hindi)</label>
                            <input type="text" name="subtitle_hindi"
                                value="{{ old('subtitle_hindi', $gallery->subtitle_hindi ?? '') }}"
                                class="form-control" placeholder="हिंदी उपशीर्षक">
                            @error('subtitle_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                        {{-- Description --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description">{{ old('description', $gallery->description ?? '') }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Description Hindi --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description (Hindi)</label>
                                    <textarea name="description_hindi" class="form-control summernote" rows="3">{{ old('description_hindi', isset($event) ? $event->description_hindi ?? '' : '') }}</textarea>
                                    @error('description_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        {{-- Image --}}
                                    {{-- Gallery Image --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Gallery Image <span class="text-red">*</span></label>
                        <input type="file" name="image" class="form-control" id="image_path_input" accept=".jpg, .jpeg, .png,">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                        {{-- Preview --}}
                        <div class="mt-2">
                            <img id="image_preview" src="{{ isset($gallery) ? asset($gallery->image_url) : '' }}"
                                alt="Preview" height="100" style="display: {{ isset($gallery) ? 'block' : 'none' }};">
                        </div>
                    </div>
                </div>


                        {{-- Link URL --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Link URL</label>
                                <input type="text" name="link_url"
                                       value="{{ old('link_url', $gallery->link_url ?? '') }}"
                                       class="form-control" placeholder="Optional link to details page">
                                @error('link_url') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $gallery->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $gallery->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            {{ isset($gallery) ? 'Update Gallery' : 'Save Gallery' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{!! $validator ?? '' !!}
<script>
    document.getElementById('image_path_input').addEventListener('change', function(event){
        const [file] = event.target.files;
        if(file){
            const preview = document.getElementById('image_preview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>
@endpush

