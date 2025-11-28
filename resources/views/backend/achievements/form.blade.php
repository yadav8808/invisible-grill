@extends('backend.layouts.master')
@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">
            Achievement
            <span class="font-weight-normal text-muted ms-2">
                {{ isset($achievement) ? 'Edit Achievement Item' : 'Add Achievement Item' }}
            </span>
        </h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('achievements.index') }}" class="btn btn-primary">
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
                            <h3 class="card-title">{{ isset($achievement) ? 'Edit Achievement Item' : 'Add Achievement Item' }}</h3>
                        </div>
                        <div class="card-body">
                            <form
                                action="{{ isset($achievement) ? route('achievements.update', $achievement->id) : route('achievements.store') }}"
                                method="POST" enctype="multipart/form-data" id="achievement-form">
                                @csrf
                                @if (isset($achievement))
                                    @method('PUT')
                                @endif

                                <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Title <span class="text-red">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $achievement->title ?? '') }}" class="form-control">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Title (Hindi) <span class="text-red">*</span></label>
                        <input type="text" name="title_hindi" value="{{ old('title_hindi', $achievement->title_hindi ?? '') }}" class="form-control">
                        @error('title_hindi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Subtitle <span class="text-red">*</span></label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $achievement->subtitle ?? '') }}" class="form-control">
                        @error('subtitle')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Subtitle (Hindi) <span class="text-red">*</span></label>
                        <input type="text" name="subtitle_hindi" value="{{ old('subtitle_hindi', $achievement->subtitle_hindi ?? '') }}" class="form-control">
                        @error('subtitle_hindi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Image <span class="text-red">*</span></label>
                        <input type="file" name="image" class="form-control" id="achievement_image_input" accept=".jpg, .jpeg, .png">
                        <img id="achievement_image_preview" src="{{ isset($achievement) ? asset($achievement->image_url) : '' }}" height="100"
                            style="display: {{ isset($achievement) && $achievement->image_url ? 'block' : 'none' }};">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>



                <div class="col-sm-6 col-md-6">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="">-- Select Order --</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $achievement->order ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>



                         <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $achievement->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $achievement->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            {{ isset($achievement) ? 'Update Achievement' : 'Save Achievement' }}
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
document.getElementById('achievement_image_input').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('achievement_image_preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endpush
