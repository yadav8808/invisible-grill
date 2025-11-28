@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Page
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($page) ? 'Edit Page' : 'Add Page' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('page-management.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($page_management) ? 'Edit Page' : 'Add Page' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($page_management) ? route('page-management.update', $page_management->id) : route('page-management.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($page_management))
                            @method('PUT')
                        @endif

                        <div class="row">
                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title" id="title"
                                           value="{{ old('title', $page_management->title ?? '') }}"
                                           class="form-control" placeholder="Enter title">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                                    <input type="text" name="hn_title" id="hn_title"
                                           value="{{ old('hn_title', $page_management->hn_title ?? '') }}"
                                           class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('hn_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Content Type --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Content Type <span class="text-red">*</span></label>
                                    <select name="content_types" id="content_types" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="1" {{ old('content_types', $page_management->content_types ?? '') == 1 ? 'selected' : '' }}>Manual</option>
                                        <option value="2" {{ old('content_types', $page_management->content_types ?? '') == 2 ? 'selected' : '' }}>URL</option>
                                        <option value="3" {{ old('content_types', $page_management->content_types ?? '') == 3 ? 'selected' : '' }}>PDF</option>
                                    </select>
                                    @error('content_types')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Content Fields (Dynamic) --}}
                            <div class="col-md-12 my-2 d-none" id="manual_fields">
                                <div class="form-group">
                                    <label class="form-label">Content</label>
                                    <textarea class="form-control summernote" name="content">{{ old('content', $page_management->content ?? '') }}</textarea>
                                    @error('content')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Hindi Content</label>
                                    <textarea class="form-control summernote" name="hn_content">{{ old('hn_content', $page_management->hn_content ?? '') }}</textarea>
                                    @error('hn_content')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group mt-2">
                                    <label class="form-label"> Image</label>
                                    <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png,">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                                    @if(isset($page_management) && $page_management->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($page_management->image_url) }}" alt="page_management Image" height="100">
                                        </div>
                                    @endif
                                </div>

                            </div>



                            <div class="col-md-6 my-2 d-none" id="url_field">
                                <div class="form-group">
                                    <label class="form-label">URL</label>
                                    <input type="text" name="url" class="form-control"
                                           value="{{ old('url', $page_management->url ?? '') }}" placeholder="Enter URL..">
                                    @error('url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 my-2 d-none" id="pdf_field">
                                <div class="form-group">
                                    <label class="form-label">Upload PDF</label>
                                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                                    @error('pdf')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if(isset($page_management) && $page_management->pdf)
                                        <div class="mt-2">
                                            <a href="{{ Storage::disk('public')->url($page_management->pdf) }}" target="_blank">View PDF</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Parent --}}
                            <div class="col-md-6 my-2">
                                <label class="form-label">Parent Page</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Select Option</option>
                                    @foreach ($ParentNames as $id => $title)
                                        <option value="{{ $id }}" {{ old('parent_id', $page_management->parent_id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Menus --}}
                            <div class="col-md-4 my-2">
                                <label class="form-label">Top Menu</label>
                                <select name="top_menu" class="form-control">
                                    <option value="0" {{ old('top_menu', $page_management->top_menu ?? 0) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('top_menu', $page_management->top_menu ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            <div class="col-md-4 my-2">
                                <label class="form-label">Left Menu</label>
                                <select name="left_menu" class="form-control">
                                    <option value="0" {{ old('left_menu', $page_management->left_menu ?? 0) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('left_menu', $page_management->left_menu ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            <div class="col-md-4 my-2">
                                <label class="form-label">Footer Menu</label>
                                <select name="footer_menu" class="form-control">
                                    <option value="0" {{ old('footer_menu', $page_management->footer_menu ?? 0) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('footer_menu', $page_management->footer_menu ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            {{-- Order --}}
                           <div class="col-md-6 my-2">
                            <label class="form-label">Position By</label>
                            <select name="postion" class="form-control">
                                <option value="">-- Select Position --</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('postion', $page_management->postion ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                            {{-- Status --}}
                            @if(isset($page_management))
                                <div class="col-md-4 my-2">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0" {{ old('status', $page_management->status ?? 1) == 0 ? 'selected' : '' }}>Suspended</option>
                                        <option value="1" {{ old('status', $page_management->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                    </select>
                                </div>
                            @endif
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($page_management) ? 'Update Page' : 'Save Page' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {

        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });
        function toggleFields() {
            let type = $('#content_types').val();
            $('#manual_fields, #url_field, #pdf_field').addClass('d-none');

            if (type == 1) {
                $('#manual_fields').removeClass('d-none');
            } else if (type == 2) {
                $('#url_field').removeClass('d-none');
            } else if (type == 3) {
                $('#pdf_field').removeClass('d-none');
            }
        }

        $('#content_types').on('change', toggleFields);
        toggleFields();
    });
</script>
@endpush
