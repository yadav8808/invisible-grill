@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                History
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($history) ? 'Edit Historys Item' : 'Add Historys Item' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('historys.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($history) ? 'Edit History Item' : 'Add History Item' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($history) ? route('historys.update', $history->id) : route('historys.store') }}"
                        method="POST" enctype="multipart/form-data" id="history-form">
                        @csrf
                        @if (isset($history))
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

                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<span class="text-red">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $history->title ?? '') }}"
                                        class="form-control" placeholder="Enter title">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title (Hindi)<span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                        value="{{ old('title_hindi', $history->title_hindi ?? '') }}" class="form-control"
                                        placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="text-red">*</span></label>
                                    <textarea name="description" class="form-control summernote" rows="3" placeholder="Enter description">{!! old('description', $history->description ?? '') !!}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Hindi Description --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description (Hindi)<span class="text-red">*</span></label>
                                    <textarea name="hn_description" class="form-control summernote" rows="3" placeholder="विवरण लिखें">{!! old('hn_description', $history->hn_description ?? '') !!}</textarea>
                                    @error('hn_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description 1 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description 1</label>
                                    <textarea name="description1" class="form-control summernote" rows="3" placeholder="Enter description 1">{!! old('description1', $history->description1 ?? '') !!} </textarea>
                                    @error('description1')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Hindi Description 1 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description 1 (Hindi)</label>
                                    <textarea name="hn_description1" class="form-control summernote" rows="3" placeholder="विवरण 1 लिखें">{!! old('hn_description1', $history->hn_description1 ?? '') !!} </textarea>
                                    @error('hn_description1')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description 2 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description 2</label>
                                    <textarea name="description2" class="form-control summernote" rows="3" placeholder="Enter description 2">{!! old('description2', $history->description2 ?? '') !!} </textarea>
                                    @error('description2')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Hindi Description 2 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description 2 (Hindi)</label>
                                    <textarea name="hn_description2" class="form-control summernote" rows="3" placeholder="विवरण 2 लिखें">{!! old('hn_description2', $history->hn_description2 ?? '') !!}  </textarea>
                                    @error('hn_description2')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" id="image_input"
                                        accept=".jpg, .jpeg, .png,">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Preview --}}
                                    <div class="mt-2">
                                        <img id="image_preview" src="{{ isset($history) ? $history->image_url : '' }}"
                                            alt="Preview" height="100"
                                            style="display: {{ isset($history) ? 'block' : 'none' }};">
                                    </div>
                                </div>
                            </div>

                            {{-- Image 1 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Image 1</label>
                                    <input type="file" name="image1" class="form-control" id="image1_input"
                                        accept=".jpg, .jpeg, .png,">
                                    @error('image1')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Preview --}}
                                    <div class="mt-2">
                                        @if (isset($history) && $history->image1)
                                            <img id="image1_preview" src="{{ Storage::url($history->image1) }}"
                                                alt="Preview" height="100">
                                        @else
                                            <img id="image1_preview" src="" alt="Preview" height="100"
                                                style="display:none;">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1"
                                            {{ old('status', $history->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $history->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
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
                                {{ isset($history) ? 'Update History' : 'Save History' }}
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

    <script>
        $(document).ready(function() {


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
