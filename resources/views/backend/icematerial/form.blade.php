@extends('backend.layouts.master')
@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">
            Icematerial
            <span class="font-weight-normal text-muted ms-2">
                {{ isset($icematerial) ? 'Edit Material' : 'Add Material' }}
            </span>
        </h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <a href="{{ route('icematerials.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($icematerial) ? route('icematerials.update', $icematerial->id) : route('icematerials.store') }}"
                      method="POST" enctype="multipart/form-data" id="icematerial-form">
                    @csrf
                    @if(isset($icematerial))
                        @method('PUT')
                    @endif

                    <div class="row">
                        {{-- Title --}}
                        <div class="col-md-6">
                             <div class="form-group">
                            <label>Title <span class="text-red">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $icematerial->title ?? '') }}" class="form-control">
                            @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                       </div>
                        {{-- Title Hindi --}}
                        <div class="col-md-6">
                             <div class="form-group">
                            <label>Title (Hindi) <span class="text-red">*</span></label>
                            <input type="text" name="title_hindi" value="{{ old('title_hindi', $icematerial->title_hindi ?? '') }}" class="form-control">
                            @error('title_hindi')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-md-6">
                             <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control summernote">{{ old('description', $icematerial->description ?? '') }}</textarea>
                            @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        </div>

                        {{-- Description Hindi --}}
                        <div class="col-md-6">
                             <div class="form-group">
                            <label>Description (Hindi)</label>
                            <textarea name="description_hindi" class="form-control summernote">{{ old('description_hindi', $icematerial->description_hindi ?? '') }}</textarea>
                            @error('description_hindi')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        </div>



                        {{-- Image --}}
                        <div class="col-md-6">
                             <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">
                            @if(isset($icematerial) && $icematerial->image)
                                <img src="{{ asset($icematerial->image_url) }}" height="100" class="mt-2">
                            @endif
                            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                       </div>
                        {{-- PDF --}}
                        <div class="col-md-6">
                             <div class="form-group">
                            <label>PDF</label>
                            <input type="file" name="pdf" class="form-control" accept=".pdf">
                            @if(isset($icematerial) && $icematerial->pdf)
                                <a href="{{ asset($icematerial->pdf_url) }}" target="_blank" class="mt-2 d-block">View PDF</a>
                            @endif
                            @error('pdf')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        </div>
                         {{-- Order --}}
                        <div class="col-md-6 my-2">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="">-- Select Order --</option>
                                @for ($i = 1; $i <= 40; $i++)
                                    <option value="{{ $i }}" {{ old('order', $icematerial->order ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        {{-- Status --}}
                        <div class="col-md-3">
                             <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $icematerial->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $icematerial->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                       </div>
                    </div>

                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-success">{{ isset($icematerial) ? 'Update Material' : 'Save Material' }}</button>
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
