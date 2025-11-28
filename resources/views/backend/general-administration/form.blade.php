@extends('backend.layouts.master')

@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">
            General Administration
            <span class="font-weight-normal text-muted ms-2">
                {{ isset($general_administration) ? 'Edit General Administration' : 'Add General Administration' }}
            </span>
        </h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('general-administration.index') }}" class="btn btn-primary">
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
                <h3 class="card-title">{{ isset($general_administration) ? 'Edit General Administration' : 'Add General Administration' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($general_administration) ? route('general-administration.update', $general_administration->id) : route('general-administration.store') }}"
                      method="POST" enctype="multipart/form-data" id="general-administration-form">
                    @csrf
                    @if(isset($general_administration))
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
                                                {{ old('category_id', $general_administration->category_id ?? 13) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="category_id"
                                        value="{{ old('category_id', $general_administration->category_id ?? 13) }}">

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub Category Name <span class="text-red">*</span></label>

                                            <select name="sub_category_id" id="subcategory_select" class="form-control"
                                                {{ isset($general_administration) ? 'disabled' : '' }}>
                                                <option value="">-- Select Sub Category --</option>
                                            </select>

                                            {{-- hidden input to preserve value when disabled --}}
                                            @if(isset($general_administration))
                                                <input type="hidden" name="sub_category_id"
                                                    value="{{ old('sub_category_id', $general_administration->sub_category_id ?? '') }}">
                                            @endif

                                            @error('sub_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                     <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $general_administration->title ?? '') }}"
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
                                    <input type="text" name="title_hindi"
                                        value="{{ old('title_hindi', $general_administration->title_hindi ?? '') }}" class="form-control"
                                        placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        {{-- Description --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description<span class="text-red">*</span></label>
                                <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description">{{ old('description', $general_administration->description ?? '') }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Description Hindi --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description (Hindi)<span class="text-red">*</span></label>
                                <textarea name="description_hindi" class="form-control summernote" rows="3" placeholder="हिंदी विवरण">{{ old('description_hindi', $general_administration->description_hindi ?? '') }}</textarea>
                                @error('description_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Name <span class="text-red">*</span></label>
                                <input type="text" name="name"
                                       value="{{ old('name', $general_administration->name ?? '') }}"
                                       class="form-control" placeholder="Enter name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Name (Hindi) <span class="text-red">*</span></label>
                                <input type="text" name="name_hindi"
                                       value="{{ old('name_hindi', $general_administration->name_hindi ?? '') }}"
                                       class="form-control" placeholder="हिंदी नाम">
                                @error('name_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Member</label>
                                <input type="text" name="member"
                                       value="{{ old('member', $general_administration->member ?? '') }}"
                                       class="form-control" placeholder="Enter member">
                                @error('member') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Member (Hindi)</label>
                                <input type="text" name="member_hindi"
                                       value="{{ old('member_hindi', $general_administration->member_hindi ?? '') }}"
                                       class="form-control" placeholder="हिंदी सदस्य">
                                @error('member_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Portfolio</label>
                                <input type="text" name="portfolio"
                                       value="{{ old('portfolio', $general_administration->portfolio ?? '') }}"
                                       class="form-control" placeholder="Enter portfolio">
                                @error('portfolio') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Portfolio (Hindi)</label>
                                <input type="text" name="portfolio_hindi"
                                       value="{{ old('portfolio_hindi', $general_administration->portfolio_hindi ?? '') }}"
                                       class="form-control" placeholder="हिंदी पोर्टफोलियो">
                                @error('portfolio_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation"
                                       value="{{ old('designation', $general_administration->designation ?? '') }}"
                                       class="form-control" placeholder="Enter designation">
                                @error('designation') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Designation (Hindi)</label>
                                <input type="text" name="designation_hindi"
                                       value="{{ old('designation_hindi', $general_administration->designation_hindi ?? '') }}"
                                       class="form-control" placeholder="हिंदी पद">
                                @error('designation_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mobile No.</label>
                                <input type="text" name="mobile_no"
                                       value="{{ old('mobile_no', $general_administration->mobile_no ?? '') }}"
                                       class="form-control" placeholder="Enter mobile number">
                                @error('mobile_no') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email"
                                       value="{{ old('email', $general_administration->email ?? '') }}"
                                       class="form-control" placeholder="Enter email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div> --}}

                        @if (isset($general_administration))


                        <div class="col-md-6 my-2">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="0" {{ old('order', $general_administration->order ?? 0) == 0 ? 'selected' : '' }}>0</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $general_administration->order ?? 0) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('order') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                         @endif

                        {{-- Image --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" accept=".jpg, .jpeg, .png," class="form-control" id="image_path_input">
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                <div class="mt-2">
                                    <img id="image_preview"
                                         src="{{ isset($general_administration) && $general_administration->image ? asset($general_administration->image) : '' }}"
                                         alt="Preview" height="100"
                                         style="display: {{ isset($general_administration) && $general_administration->image ? 'block' : 'none' }};">
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $general_administration->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $general_administration->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            {{ isset($general_administration) ? 'Update General Administration' : 'Save General Administration' }}
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

    {{-- Image preview script --}}

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

        let currentCategory = "{{ old('category_id', $general_administration->category_id ?? '') }}";
        let currentSubcategory = "{{ old('sub_category_id', $general_administration->sub_category_id ?? '') }}";


        if (currentCategory) {
            loadSubcategories(currentCategory, currentSubcategory);
        } else {
            let defaultCategoryId = 13;
            $('#cat_select').val(defaultCategoryId);
            loadSubcategories(defaultCategoryId);
        }
    });
</script>


@endpush
