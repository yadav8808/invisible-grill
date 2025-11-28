@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Research Publications
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($media) ? 'Edit   Research Publications Item' : 'Add   Research Publications Item' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('research-publication.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($research_publication) ? 'Edit Publication Item' : 'Add Media Item' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($research_publication) ? route('research-publication.update', $research_publication->id) : route('research-publication.store') }}"
                        method="POST" enctype="multipart/form-data" id="publications-form">
                        @csrf
                        @if (isset($research_publication))
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
                                                {{ old('category_id', $research_publication->category_id ?? 15) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="category_id"
                                        value="{{ old('category_id', $research_publication->category_id ?? 15) }}">

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub Category Name <span class="text-red">*</span></label>

                                            <select name="sub_category_id" id="subcategory_select" class="form-control"
                                                {{ isset($research_publication) ? 'disabled' : '' }}>
                                                <option value="">-- Select Sub Category --</option>
                                            </select>

                                            {{-- hidden input to preserve value when disabled --}}
                                            @if(isset($research_publication))
                                                <input type="hidden" name="sub_category_id"
                                                    value="{{ old('sub_category_id', $research_publication->sub_category_id ?? '') }}">
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
                                    <input type="text" name="title" value="{{ old('title', $research_publication->title ?? '') }}"
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
                                        value="{{ old('title_hindi', $research_publication->title_hindi ?? '') }}" class="form-control"
                                        placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            {{-- Pdf Upload --}}
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label class="form-label">PDF</label>
                                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                                    @error('pdf')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if (isset($research_publication) && $research_publication->type == 'pdf' && $research_publication->pdf)
                                        <div class="mt-2">
                                            <a href="{{ asset($research_publication->pdf_url) }}" target="_blank" download>
                                                Download PDF
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                           @if (isset($research_publication))
                        <div class="col-md-6 my-2">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="0" {{ old('order', $research_publication->order ?? 0) == 0 ? 'selected' : '' }}>0</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $research_publication->order ?? 0) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('order') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                         @endif

                            @isset($research_publication)
                            <div class="col-md-3">
                                 <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $research_publication->status ?? 1) == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', $research_publication->status ?? 1) == 0 ? 'selected' : '' }}>
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
                                {{ isset($research_publication) ? 'Update Research Publications' : 'Save Research Publications' }}
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

        let currentCategory = "{{ old('category_id', $research_publication->category_id ?? '') }}";
        let currentSubcategory = "{{ old('sub_category_id', $research_publication->sub_category_id ?? '') }}";


        if (currentCategory) {
            loadSubcategories(currentCategory, currentSubcategory);
        } else {
            let defaultCategoryId = 15;
            $('#cat_select').val(defaultCategoryId);
            loadSubcategories(defaultCategoryId);
        }
    });
</script>
@endpush
