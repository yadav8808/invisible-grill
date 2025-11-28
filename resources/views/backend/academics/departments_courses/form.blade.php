@extends('backend.layouts.master')
@section('content')

<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">
          Departments Course
            <span class="font-weight-normal text-muted ms-2">
               {{ isset($departments_course) ? 'Edit Departments Course' : 'Add Departments Course' }}
            </span>
        </h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('departments-courses.index') }}" class="btn btn-primary">
                        <i class="feather feather-arrow-left fs-15 my-auto me-2"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="departments-course-form"
                      action="{{ isset($departments_course) ? route('departments-courses.update',$departments_course->id) : route('departments-courses.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($departments_course))
                        @method('PUT')
                    @endif

                    <div class="row">
                         {{-- Category ID --}}
                     <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category Name <span class="text-red">*</span></label>
                                    <select class="form-control" disabled>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $departments_course->category_id ?? 10) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="category_id"
                                        value="{{ old('category_id', $departments_course->category_id ?? 10) }}">

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub Category Name <span class="text-red">*</span></label>

                                            <select name="sub_category_id" id="subcategory_select" class="form-control"
                                                {{ isset($departments_course) ? 'disabled' : '' }}>
                                                <option value="">-- Select Sub Category --</option>
                                            </select>

                                            {{-- hidden input to preserve value when disabled --}}
                                            @if(isset($departments_course))
                                                <input type="hidden" name="sub_category_id"
                                                    value="{{ old('sub_category_id', $departments_course->sub_category_id ?? '') }}">
                                            @endif

                                            @error('sub_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Title (English) <span class="text-red">*</span></label>
                                <input type="text" name="title"
                                       value="{{ old('title', $departments_course->title ?? '') }}"
                                       class="form-control" placeholder="Enter title">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                                <input type="text" name="title_hindi"
                                       value="{{ old('title_hindi', $departments_course->title_hindi ?? '') }}"
                                       class="form-control" placeholder="हिंदी शीर्षक">
                                @error('title_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle"
                                       value="{{ old('subtitle', $departments_course->subtitle ?? '') }}"
                                       class="form-control" placeholder="Enter subtitle">
                                @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Subtitle (Hindi)</label>
                                <input type="text" name="subtitle_hindi"
                                       value="{{ old('subtitle_hindi', $departments_course->subtitle_hindi ?? '') }}"
                                       class="form-control" placeholder="Enter subtitle hindi">
                                @error('subtitle_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Image <span class="text-red">*</span></label>
                                <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png," id="image_path_input">
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                <div class="mt-2">
                                    <img id="image_preview"
                                         src="{{ isset($departments_course) && $departments_course->image ? asset($departments_course->image_url) : '' }}"
                                         alt="Preview" height="100"
                                         style="display: {{ isset($departments_course) && $departments_course->image ? 'block' : 'none' }};">
                                </div>
                            </div>
                        </div>
                        @isset($departments_course)
                         <div class="col-md-6 my-2">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="">-- Select Order --</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $departments_course->order ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $departments_course->status ?? 1)==1?'selected':'' }}>Active</option>
                                    <option value="0" {{ old('status', $departments_course->status ?? 1)==0?'selected':'' }}>Inactive</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                         @endisset

                    </div>

                     <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            {{ isset($departments_course) ? 'Update Departments Course' : 'Save Departments Course' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
{!! $validator->selector('#departments-course-form') !!}
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

        let currentCategory = "{{ old('category_id', $departments_course->category_id ?? '') }}";
        let currentSubcategory = "{{ old('sub_category_id', $departments_course->sub_category_id ?? '') }}";


        if (currentCategory) {
            loadSubcategories(currentCategory, currentSubcategory);
        } else {
            let defaultCategoryId = 10;
            $('#cat_select').val(defaultCategoryId);
            loadSubcategories(defaultCategoryId);
        }
    });
</script>
@endpush
