@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Notice <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Notices: {{ $notices->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('notices.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Notice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters (optional, can create _search blade like Banner) --}}
    @include('backend.notices._search')

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Notice List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Title ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                            </th>
                            <th>URL</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'order']) }}">Order ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-order']) }}">↓</a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notices as $notice)
                            <tr>
                                <td>{{ $loop->iteration + ($notices->currentPage() - 1) * $notices->perPage() }}</td>
                                <td>{{ $notice->title }}</td>
                                <td>
                                    @if($notice->url)
                                        <a href="{{ $notice->url }}" target="_blank">{{ $notice->url }}</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $notice->order ?? '-' }}</td>
                                <td>
                                    @if ($notice->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                            <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('notices.destroy', $notice->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No notices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($notices->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $notices->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
