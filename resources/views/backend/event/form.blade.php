@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Event
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($event) ? 'Edit Event' : 'Add Event' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('events.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($event) ? 'Edit Event' : 'Add Event' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}"
                        method="POST" enctype="multipart/form-data" id="event-form">
                        @csrf
                        @if (isset($event))
                            @method('PUT')
                        @endif

                        <div class="row">
                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category Name <span class="text-red">*</span></label>

                                    <!-- Disabled select -->
                                    <select class="form-control" disabled>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $event->category_id ?? 7) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- Hidden input to submit the actual value -->
                                    <input type="hidden" name="category_id"
                                        value="{{ old('category_id', $event->category_id ?? 7) }}">

                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Event Type Category Name<span class="text-red">*</span></label>

                                    <select name="sub_category_id" id="subcategory_select" class="form-control">
                                        <option value="">-- Select Sub Category --</option>
                                    </select>
                                    @error('sub_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                        value="{{ old('title', isset($event) ? $event->title ?? '' : '') }}"
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
                                        value="{{ old('title_hindi', isset($event) ? $event->title_hindi ?? '' : '') }}"
                                        class="form-control" placeholder="हिंदी शीर्षक">
                                    @error('title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Sub Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title"
                                        value="{{ old('sub_title', isset($event) ? $event->sub_title ?? '' : '') }}"
                                        class="form-control" placeholder="Enter sub title">
                                    @error('sub_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Sub Title Hindi --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sub Title (Hindi)</label>
                                    <input type="text" name="sub_title_hindi"
                                        value="{{ old('sub_title_hindi', isset($event) ? $event->sub_title_hindi ?? '' : '') }}"
                                        class="form-control" placeholder="हिंदी उपशीर्षक">
                                    @error('sub_title_hindi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>






                            {{-- Start Date Time --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Start Date Time<span class="text-red">*</span></label>
                                    <input type="datetime-local" name="start_date_time"
                                        value="{{ old('start_date_time', isset($event) && $event->start_date_time ? $event->start_date_time->format('Y-m-d\TH:i') : '') }}"
                                        class="form-control">
                                    @error('start_date_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- End Date Time --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">End Date Time<span class="text-red">*</span></label>
                                    <input type="datetime-local" name="end_date_time"
                                        value="{{ old('end_date_time', isset($event) && $event->end_date_time ? $event->end_date_time->format('Y-m-d\TH:i') : '') }}"
                                        class="form-control">
                                    @error('end_date_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Day --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Day</label>
                                    <input type="text" name="day"
                                        value="{{ old('day', isset($event) ? $event->day ?? '' : '') }}"
                                        class="form-control" placeholder="Enter day">
                                    @error('day')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control summernote" rows="3">{{ old('description', isset($event) ? $event->description ?? '' : '') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description Hindi --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description (Hindi)</label>
                                    <textarea name="description_hn" class="form-control summernote" rows="3">{{ old('description_hn', isset($event) ? $event->description_hn ?? '' : '') }}</textarea>
                                    @error('description_hn')
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
                                            {{ old('status', isset($event) ? $event->status ?? 1 : 1) == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0"
                                            {{ old('status', isset($event) ? $event->status ?? 1 : 1) == 0 ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control"
                                        accept=".jpg, .jpeg, .png,">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if (isset($event) && $event->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($event->image_url) }}" alt="Event Image" height="100">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Pdf --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">PDF</label>
                                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                                    @error('pdf')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if (isset($event) && $event->pdf)
                                        <div class="mt-2">
                                            <a href="{{ asset($event->pdf_url) }}" target="_blank" download>
                                                Download PDF
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($event) ? 'Update Event' : 'Save Event' }}
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
                            options +=
                                `<option value="${item.id}" ${selected}>${item.name}</option>`;
                        });

                        $('#subcategory_select').html(options);
                    }
                });
            }

            $('#cat_select').on('change', function() {
                loadSubcategories(this.value);
            });

            let currentCategory = "{{ old('category_id', $event->category_id ?? '') }}";
            let currentSubcategory = "{{ old('sub_category_id', $event->sub_category_id ?? '') }}";

            if (currentCategory) {
                loadSubcategories(currentCategory, currentSubcategory);
            } else {

                loadSubcategories(7);
                $('#cat_select').val(7);
            }
        });
    </script>
@endpush
