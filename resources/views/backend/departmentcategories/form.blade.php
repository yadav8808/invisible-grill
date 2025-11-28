@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Category
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($departmentcategories) ? 'Edit Category' : 'Add Category' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('departmentcategorys.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($departmentcategories) ? 'Edit Category' : 'Add Category' }}</h3>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($departmentcategories) ? route('departmentcategorys.update', $departmentcategories->id) : route('departmentcategorys.store') }}"
                        method="POST" enctype="multipart/form-data" id="category-form">
                        @csrf
                        @if (isset($departmentcategories))
                            @method('PUT')
                        @endif

                        <div class="row">

                              {{-- Category Select --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Department Course Name <span class="text-red">*</span></label>
                                    <select name="department_course_id" id="cat_select" class="form-control">
                                        <option value="">-- Select Category Department --</option>
                                        @foreach($departmentcourses as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('department_course_id', $departmentsubcategory->department_course_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_course_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name <span class="text-red">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $departmentcategories->name ?? '') }}"
                                        class="form-control" placeholder="Enter name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- name Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="name_hindi"
                                        value="{{ old('name_hindi', $departmentcategories->name_hindi ?? '') }}" class="form-control"
                                        placeholder="हिंदी शीर्षक">
                                    @error('name_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>




                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1"
                                            {{ old('status', $departmentcategories->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $departmentcategories->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
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
                                {{ isset($departmentcategories) ? 'Update Category' : 'Save Category' }}
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
