@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-flex justify-content-between">
        <h4 class="page-title">{{ isset($committee) ? 'Edit Research Committee' : 'Add Research Committee' }}</h4>
        <a href="{{ route('research-committees.index') }}" class="btn btn-primary">
            <i class="feather feather-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="card">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title">{{ isset($research_committee) ? 'Edit Research Committee' : 'Add Research Committee' }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" id="committee-form"
                        action="{{ isset($research_committee) ? route('research-committees.update', $research_committee) : route('research-committees.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($research_committee))
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
                                                {{ old('category_id', $research_committee->category_id ?? 14) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="category_id"
                                        value="{{ old('category_id', $research_committee->category_id ?? 14) }}">

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub Category Name <span class="text-red">*</span></label>

                                            <select name="sub_category_id" id="subcategory_select" class="form-control"
                                                {{ isset($research_committee) ? 'disabled' : '' }}>
                                                <option value="">-- Select Sub Category --</option>
                                            </select>

                                            {{-- hidden input to preserve value when disabled --}}
                                            @if(isset($research_committee))
                                                <input type="hidden" name="sub_category_id"
                                                    value="{{ old('sub_category_id', $research_committee->sub_category_id ?? '') }}">
                                            @endif

                                            @error('sub_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-red">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $research_committee->title ?? '') }}"
                                class="form-control" placeholder="Enter Title">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Title (Hindi) <span class="text-red">*</span></label>
                            <input type="text" name="title_hindi"
                                value="{{ old('title_hindi', $research_committee->title_hindi ?? '') }}" class="form-control"
                                placeholder="शीर्षक दर्ज करें">
                            @error('title_hindi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>





                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="text-red">*</span></label>
                                    <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description"> {!! old('description', $research_committee->description ?? '') !!}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description Hindi --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description Hindi<span class="text-red">*</span></label>
                                    <textarea name="description_hindi" class="form-control summernote" rows="3" placeholder="Enter description_hindi"> {!! old('description_hindi', $research_committee->description_hindi ?? '') !!}</textarea>
                                    @error('description_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            @if (isset($research_committee))


                        <div class="col-md-6 my-2">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="0" {{ old('order', $research_committee->order ?? 0) == 0 ? 'selected' : '' }}>0</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $research_committee->order ?? 0) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('order') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                         @endif

                            @isset($research_committee)
                            <div class="col-md-3">
                                 <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $research_committee->status ?? 1) == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', $research_committee->status ?? 1) == 0 ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                         @endisset
                        </div>
                        <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            {{ isset($research_committee) ? 'Update Research Committee' : 'Save Research-committee' }}
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
{!! $validator->selector('#committee-form') !!}
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

        let currentCategory = "{{ old('category_id', $research_committee->category_id ?? '') }}";
        let currentSubcategory = "{{ old('sub_category_id', $research_committee->sub_category_id ?? '') }}";


        if (currentCategory) {
            loadSubcategories(currentCategory, currentSubcategory);
        } else {
            let defaultCategoryId = 14;
            $('#cat_select').val(defaultCategoryId);
            loadSubcategories(defaultCategoryId);
        }
    });
</script>
@endpush
