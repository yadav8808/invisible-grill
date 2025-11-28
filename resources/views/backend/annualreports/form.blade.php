@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">
                Annual Report
                <span class="font-weight-normal text-muted ms-2">
                    {{ isset($annual_report) ? 'Edit Annual Report' : 'Add Annual Report' }}
                </span>
            </h4>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('annual-reports.index') }}" class="btn btn-primary">
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
                    <h3 class="card-title">{{ isset($annual_report) ? 'Edit Annual Report' : 'Add Annual Report' }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($annual_report) ? route('annual-reports.update', $annual_report->id) : route('annual-reports.store') }}"
                          method="POST" enctype="multipart/form-data" id="annual_report-form">
                        @csrf
                        @if(isset($annual_report))
                            @method('PUT')
                        @endif


                        <div class="row">

                            {{-- Title --}}
                          <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Year <span class="text-red">*</span></label>
                                    <select name="year" class="form-control" required>
                                        <option value="">-- Select Year --</option>
                                        @for ($y = date('Y'); $y >= 2000; $y--)
                                            <option value="{{ $y }}" 
                                                {{ old('year', $annual_report->year ?? '') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                           {{-- PDF Upload --}}
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Report File (PDF)<span class="text-red">*</span></label>
                                    <input type="file" name="pdf" class="form-control" accept="application/pdf">
                                    @error('pdf')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    @if(isset($annual_report) && $annual_report->pdf)
                                        <div class="mt-2">
                                            <a href="{{ $annual_report->image_url }}" target="_blank" class="btn btn-sm btn-info">
                                                View Current File
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
                                        <option value="1" @selected(old('status', $annual_report->status ?? 1) == 1)>Active</option>
                                        <option value="0" @selected(old('status', $annual_report->status ?? 1) == 0)>Inactive</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                {{ isset($annual_report) ? 'Update Report' : 'Save Report' }}
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
@endpush
