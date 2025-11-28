@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Department Detail
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($departmentdetail) ? 'Edit Department Detail' : 'Add Department Detail' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('departmentdetails.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">
                        {{ isset($departmentdetail) ? 'Edit Department Detail' : 'Add Department Detail' }}</h3>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($departmentdetail) ? route('departmentdetails.update', $departmentdetail->id) : route('departmentdetails.store') }}"
                        method="POST" enctype="multipart/form-data" id="departmentdetail-form">
                        @csrf
                        @if (isset($departmentdetail))
                            @method('PUT')
                        @endif

                        <div class="row">

                            {{-- Department Course --}}


                            {{-- Category --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category Name <span class="text-red">*</span></label>
                                    <select name="department_course_id" id="cat_select" class="form-control"
                                        onchange="loadSubcategories(this.value, false)"
                                        {{ isset($departmentdetail) ? 'disabled' : '' }}>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($departments as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('department_course_id', $departmentdetail->department_course_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Hidden input to keep department_course_id value when disabled --}}
                                    @if (isset($departmentdetail))
                                        <input type="hidden" name="department_course_id"
                                            value="{{ old('department_course_id', $departmentdetail->department_course_id ?? '') }}">
                                    @endif

                                    @error('department_course_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sub Category Name<span class="text-red">*</span></label>
                                    <select name="department_category_id" id="subcategory_select" class="form-control"
                                        {{ isset($departmentdetail) ? 'disabled' : '' }}>
                                        <option value="">-- Select Sub Category --</option>
                                    </select>

                                    {{-- Hidden input to keep department_category_id value when disabled --}}
                                    @if (isset($departmentdetail))
                                        <input type="hidden" name="department_category_id"
                                            value="{{ old('department_category_id', $departmentdetail->department_category_id ?? '') }}">
                                    @endif

                                    @error('department_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                        value="{{ old('title', $departmentdetail->title ?? '') }}" class="form-control"
                                        placeholder="Enter title">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title Hindi --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                        value="{{ old('title_hindi', $departmentdetail->title_hindi ?? '') }}"
                                        class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description <span class="text-red">*</span></label>
                                    <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description">{!! old('description', $departmentdetail->description ?? '') !!}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Hindi Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description (Hindi) <span class="text-red">*</span></label>
                                    <textarea name="description_hindi" class="form-control summernote" rows="3" placeholder="विवरण लिखें">{!! old('description_hindi', $departmentdetail->description_hindi ?? '') !!}</textarea>
                                    @error('description_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1"
                                            {{ old('status', $departmentdetail->status ?? 1) == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0"
                                            {{ old('status', $departmentdetail->status ?? 1) == 0 ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($departmentdetail) ? 'Update Department Detail' : 'Save Department Detail' }}
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
        let preselectedSub = "{{ old('department_category_id', $departmentdetail->department_category_id ?? '') }}";
        let initialCatId = "{{ old('department_course_id', $departmentdetail->department_course_id ?? '') }}";

        function loadSubcategories(catId, isInitial = false) {
    let subSelect = document.getElementById('subcategory_select');
    subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';
    if (catId) {
        fetch('/departmentdetails/get-by-category/' + catId) // Or '/api/...' if using api.php
            .then(res => {
                if (!res.ok) {
                    throw new Error(`HTTP ${res.status}: ${res.statusText}`);
                }
                return res.text(); // First get as text to inspect
            })
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    data.forEach(item => {
                        let opt = document.createElement('option');
                        opt.value = item.id;
                        opt.textContent = item.name;
                        if (isInitial && item.id == preselectedSub && catId == initialCatId) {
                            opt.selected = true;
                        }
                        subSelect.appendChild(opt);
                    });
                    if (!isInitial) {
                        subSelect.value = '';
                    }
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    console.error('Response was:', text.substring(0, 200)); // Log first 200 chars for debug
                    subSelect.innerHTML += '<option value="">Error loading subcategories</option>';
                }
            })
            .catch(err => {
                console.error('Fetch Error:', err);
                subSelect.innerHTML += '<option value="">Failed to load (check console)</option>';
            });
    }
}

        // Page load me
        document.addEventListener("DOMContentLoaded", function() {
            let initialCat = document.getElementById('cat_select').value;
            if (initialCat) {
                loadSubcategories(initialCat, true);
            }
        });
    </script>


@endpush
