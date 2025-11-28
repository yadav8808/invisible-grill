@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                About Main
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($about_main) ? 'Edit About Main Item' : 'Add About Main Item' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('about-main.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($about_main) ? 'Edit About Mains Item' : 'Add About Mains Item' }}</h3>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($about_main) ? route('about-main.update', $about_main->id) : route('about-main.store') }}"
                        method="POST" enctype="multipart/form-data" id="about-main-form">
                        @csrf
                        @if (isset($about_main))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category Name <span class="text-red">*</span></label>
                                    <select class="form-control" disabled>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $about_main->category_id ?? 1) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="category_id"
                                        value="{{ old('category_id', $about_main->category_id ?? 1) }}">

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub Category Name <span class="text-red">*</span></label>

                                            <select name="sub_category_id" id="subcategory_select" class="form-control"
                                                {{ isset($about_main) ? 'disabled' : '' }}>
                                                <option value="">-- Select Sub Category --</option>
                                            </select>

                                            {{-- hidden input to preserve value when disabled --}}
                                            @if(isset($about_main))
                                                <input type="hidden" name="sub_category_id"
                                                    value="{{ old('sub_category_id', $about_main->sub_category_id ?? '') }}">
                                            @endif

                                            @error('sub_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>






                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                        value="{{ old('title', $about_main->title ?? '') }}" class="form-control"
                                        placeholder="Enter title">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                        value="{{ old('title_hindi', $about_main->title_hindi ?? '') }}"
                                        class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            {{-- Subtitle --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="subtitle"
                                        value="{{ old('subtitle', $about_main->subtitle ?? '') }}" class="form-control"
                                        placeholder="Enter subtitle">
                                    @error('subtitle')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            {{-- Subtitle Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Subtitle (Hindi)</label>
                                    <input type="text" name="subtitle_hindi"
                                        value="{{ old('subtitle_hindi', $about_main->subtitle_hindi ?? '') }}"
                                        class="form-control" placeholder="हिंदी उपशीर्षक">
                                    @error('subtitle_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description"> {!! old('description', $about_main->description ?? '') !!}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description Hindi --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description Hindi</label>
                                    <textarea name="description_hindi" class="form-control summernote" rows="3" placeholder="Enter description_hindi"> {!! old('description_hindi', $about_main->description_hindi ?? '') !!}</textarea>
                                    @error('description_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Image --}}
                            {{-- about_main Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> Image </label>
                                    <input type="file" name="image" class="form-control" id="image_path_input"
                                        accept=".jpg, .jpeg, .png,">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Preview --}}
                                    <div class="mt-2">
                                        <img id="image_preview"
                                            src="{{ isset($about_main) ? asset($about_main->image_url) : '' }}"
                                            alt="Preview" height="100"
                                            style="display: {{ isset($about_main) ? 'block' : 'none' }};">
                                    </div>
                                </div>
                            </div>


                            {{-- Link URL --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Link URL</label>
                                    <input type="text" name="link_url"
                                        value="{{ old('link_url', $about_main->link_url ?? '') }}" class="form-control"
                                        placeholder="Optional link to details page">
                                    @error('link_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1"
                                            {{ old('status', $about_main->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $about_main->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                {{ isset($about_main) ? 'Update About Main' : 'Save About Main' }}
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
        document.getElementById('image_path_input').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('image_preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>

    <script>
    $(document).ready(function() {
        function loadSubcategories(categoryId, selectedSubcategoryId = null) {
            if (!categoryId) {
                $('#subcategory_select').html('<option value="">-- Select Sub Category --</option>');
                return;
            }

            $.ajax({
                url: "{{ route('historys.byCategory', '') }}/" + categoryId,
                type: 'GET',
                success: function(data) {
                    let options = '<option value="">-- Select Sub Category --</option>';
                    $.each(data, function(i, item) {
                        let selected = (selectedSubcategoryId == item.id) ? 'selected' : '';
                        options += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                    });

                    $('#subcategory_select').html(options);
                }
            });
        }

        $('#cat_select').on('change', function() {
            loadSubcategories(this.value);
        });

        let currentCategory = "{{ old('category_id', $about_main->category_id ?? '') }}";
        let currentSubcategory = "{{ old('sub_category_id', $about_main->sub_category_id ?? '') }}";


        if (currentCategory) {
            loadSubcategories(currentCategory, currentSubcategory);
        } else {
            let defaultCategoryId = 1;
            $('#cat_select').val(defaultCategoryId);
            loadSubcategories(defaultCategoryId);
        }
    });
</script>

@endpush
