@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Media
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($media) ? 'Edit Media Item' : 'Add Media Item' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('media.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($medium) ? 'Edit Media Item' : 'Add Media Item' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($medium) ? route('media.update', $medium->id) : route('media.store') }}"
                        method="POST" enctype="multipart/form-data" id="media-form">
                        @csrf
                        @if (isset($medium))
                            @method('PUT')
                        @endif

                        <div class="row">
                             <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category Name <span class="text-red">*</span></label>
                                    <select name="category_id" id="cat_select" class="form-control"
                                        onchange="loadSubcategories(this.value)" {{ isset($history) ? 'disabled' : '' }}>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $history->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Hidden input to keep category_id value when disabled --}}
                                    @if (isset($history))
                                        <input type="hidden" name="category_id"
                                            value="{{ old('category_id', $history->category_id ?? '') }}">
                                    @endif

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sub Category Name<span class="text-red">*</span></label>
                                    <select name="sub_category_id" id="subcategory_select" class="form-control"
                                        {{ isset($history) ? 'disabled' : '' }}>
                                        <option value="">-- Select Sub Category --</option>
                                    </select>

                                    {{-- Hidden input to keep sub_category_id value when disabled --}}
                                    @if (isset($history))
                                        <input type="hidden" name="sub_category_id"
                                            value="{{ old('sub_category_id', $history->sub_category_id ?? '') }}">
                                    @endif

                                    @error('sub_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Document Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Documents Type <span class="text-red">*</span></label>
                                    <select name="type" class="form-control" id="doc_type">
                                        <option value="">-- Select Type --</option>
                                        <option value="PDF" {{ old('type', $medium->type ?? '') == 'PDF' ? 'selected' : '' }}>PDF</option>
                                        <option value="Image" {{ old('type', $medium->type ?? '') == 'Image' ? 'selected' : '' }}>Image</option>
                                    </select>
                                    @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-red">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $medium->title ?? '') }}"
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
                                        value="{{ old('title_hindi', $medium->title_hindi ?? '') }}" class="form-control"
                                        placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Image Upload --}}
                            <div class="col-md-6" id="image_upload_section" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">Image<span class="text-red">*</span></label>
                                    <input type="file" name="image" class="form-control" id="image_path_input"
                                        accept=".jpg,.jpeg,.png">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Preview --}}
                                    <div class="mt-2">
                                        <img id="image_preview" src="{{ isset($medium) && $medium->type == 'image' ? asset($medium->image_url) : '' }}"
                                            alt="Preview" height="100"
                                            style="display: {{ isset($medium) && $medium->type == 'image' ? 'block' : 'none' }};">
                                    </div>
                                </div>
                            </div>

                            {{-- Pdf Upload --}}
                            <div class="col-md-6" id="pdf_upload_section" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">PDF</label>
                                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                                    @error('pdf')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if (isset($medium) && $medium->type == 'pdf' && $medium->pdf)
                                        <div class="mt-2">
                                            <a href="{{ asset($medium->pdf_url) }}" target="_blank" download>
                                                Download PDF
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $medium->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $medium->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                {{ isset($medium) ? 'Update Media' : 'Save Media' }}
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
        function toggleUploadFields() {
            let selectedType = document.getElementById('doc_type').value;
            let imageSection = document.getElementById('image_upload_section');
            let pdfSection = document.getElementById('pdf_upload_section');

            if (selectedType === "Image") {
                imageSection.style.display = 'block';
                pdfSection.style.display = 'none';
            } else if (selectedType === "PDF") {
                pdfSection.style.display = 'block';
                imageSection.style.display = 'none';
            } else {
                imageSection.style.display = 'none';
                pdfSection.style.display = 'none';
            }
        }

        // Trigger on change
        document.getElementById('doc_type').addEventListener('change', toggleUploadFields);


        toggleUploadFields();


        document.getElementById('image_path_input')?.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('image_preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>
     <script>
        function loadSubcategories(catId) {
            let subSelect = document.getElementById('subcategory_select');
            let selectedSub = "{{ old('sub_category_id', $history->sub_category_id ?? '') }}";
            subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';

            if (catId) {
                fetch('/admin/historys/get-by-category/' + catId)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            let opt = document.createElement('option');
                            opt.value = item.id;
                            opt.textContent = item.name;
                            if (item.id == selectedSub) {
                                opt.selected = true;
                            }
                            subSelect.appendChild(opt);
                        });
                    })
                    .catch(err => console.error(err));
            }
        }

        // Page load me
        document.addEventListener("DOMContentLoaded", function() {
            let initialCat = document.getElementById('cat_select').value;
            if (initialCat) {
                loadSubcategories(initialCat);
            }
        });
    </script>
@endpush
