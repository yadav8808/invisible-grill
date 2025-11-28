@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Notice
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($notice) ? 'Edit Notice' : 'Add Notice' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('notices.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($notice) ? 'Edit Notice' : 'Add Notice' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($notice) ? route('notices.update', $notice->id) : route('notices.store') }}"
                          method="POST">
                        @csrf
                        @if(isset($notice))
                            @method('PUT')
                        @endif

                        <div class="row">
                            {{-- Title --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Notice Title <span class="text-red">*</span></label>
                                    <input type="text" name="title"
                                           value="{{ old('title', $notice->title ?? '') }}"
                                           class="form-control" placeholder="Enter Notice Title" required>
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                                                        {{-- Title Hindi--}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Notice Title  Hindi<span class="text-red">*</span></label>
                                    <input type="text" name="title_hindi"
                                           value="{{ old('title_hindi', $notice->title_hindi ?? '') }}"
                                           class="form-control" placeholder="Enter Notice  title_hindi" required>
                                    @error('title_hindi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- URL --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Notice URL (Optional)</label>
                                    <input type="url" name="url"
                                           value="{{ old('url', $notice->url ?? '') }}"
                                           class="form-control" placeholder="https://example.com">
                                    @error('url') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Order --}}
                           <div class="col-md-6 my-2">
                            <label class="form-label">Order By</label>
                            <select name="order" class="form-control">
                                <option value="">-- Select Order --</option>
                                @for ($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ old('order', $notice->order ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                            {{-- Status --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $notice->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $notice->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                {{ isset($notice) ? 'Update Notice' : 'Save Notice' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endpush
