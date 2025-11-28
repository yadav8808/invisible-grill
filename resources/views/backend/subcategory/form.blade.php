@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Category
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($subcategory) ? 'Edit Subcategory' : 'Add Subcategory' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('subcategorys.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($subcategory) ? 'Edit Sub category' : 'Add Sub category' }}</h3>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($subcategory) ? route('subcategorys.update', $subcategory->id) : route('subcategorys.store') }}"
                        method="POST" enctype="multipart/form-data" id="category-form">
                        @csrf
                        @if (isset($subcategory))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category Name <span class="text-red">*</span></label>
                                    <select name="category_id" id="cat_select" class="form-control">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $subcategory->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title --}}
                             <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sub Category Name <span class="text-red">*</span></label>
                                    <input type="text" name="name"
                                        value="{{ old('name', $subcategory->name ?? '') }}"
                                        class="form-control" placeholder="Sub Category Name">
                                    @error('name_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            {{-- name Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sub Category Name (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="name_hindi"
                                        value="{{ old('name_hindi', $subcategory->name_hindi ?? '') }}"
                                        class="form-control" placeholder="हिंदी शीर्षक">
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
                                            {{ old('status', $subcategory->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $subcategory->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
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
                                {{ isset($subcategory) ? 'Update Category' : 'Save Category' }}
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
    <script>
        function loadSubcategories(catId) {
            let subSelect = document.getElementById('subcategory_select');
            subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';

            if (catId) {
                fetch('/subcategorys/get-by-category/' + catId)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            let opt = document.createElement('option');
                            opt.value = item.id;
                            opt.textContent = item.name;
                            subSelect.appendChild(opt);
                        });
                    })
                    .catch(err => console.error(err));
            }
        }

        document.getElementById('cat_select').addEventListener('change', function() {
            loadSubcategories(this.value);
        });

        document.addEventListener('DOMContentLoaded', function() {
            let catId = document.getElementById('cat_select').value;
            if (catId) loadSubcategories(catId);
        });
    </script>
@endpush
