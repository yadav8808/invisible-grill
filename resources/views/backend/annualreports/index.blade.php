@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Annual Reports <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Reports: {{ $annualreports->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('annual-reports.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.annualreports._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Annual Report List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'year']) }}">Year ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-year']) }}">↓</a>
                            </th>
                           
                            <th>File</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($annualreports as $report)
                     
                            <tr>
                                <td>{{ $loop->iteration + ($annualreports->currentPage() - 1) * $annualreports->perPage() }}</td>
                                <td>{{ $report->year }}</td>
                               <td>
                                @if($report->pdf)
                                    <a href="{{ $report->image_url }}" target="_blank" class="btn btn-sm btn-info">View</a>
                                @else
                                    <span class="text-muted">No File</span>
                                @endif
                            </td>
                                <td>
                                    @if ($report->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('annual-reports.edit', $report->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="modal-effect btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldemo8"
                                            data-url="{{ route('annual-reports.destroy', $report->id) }}"
                                            data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No reports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($annualreports->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $annualreports->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    @include('backend.layouts.modol.delete')
@endsection
