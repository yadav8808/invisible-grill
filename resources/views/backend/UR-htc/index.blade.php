@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">UR-htc <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total htc: {{ $urhtc->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('urhtc.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add UR-htc
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.UR-htc._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">UHTC/ RHTC List</h3>
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
                            <th>Title Hindi</th>
                            <th>Page Type</th>
                            <th>Content Type</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'type']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($urhtc as $data)
                            <tr>
                                <td>{{ $loop->iteration + ($urhtc->currentPage() - 1) * $urhtc->perPage() }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->hn_title ?? '-' }}</td>
                                 <td>
                                    @if($data->type == 'UHTC')
                                     <span class="badge bg-primary-subtle text-primary shadow px-3 py-2 rounded-pill fw-bold border border-2 border-primary" style="border-style: dashed;">UHTC</span>

                                    @elseif($data->type == 'RHTC')
                                        <span class="badge bg-info-subtle text-danger shadow px-3 py-2 rounded-pill fw-bold border border-2 border-danger" style="border-style: dashed;">RHTC</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                               <td>
                                    @if($data->content_type == 'content')
                                        <span class="badge bg-primary">Content</span>
                                    @elseif($data->content_type == 'sub_cat')
                                        <span class="badge bg-info">Sub Cat</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                <td>
                                    @if ($data->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('urhtc.edit', $data->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if($data->content_type == 'sub_cat')
                                    <a href="{{ route('urhtc.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                       <i class="fa fa-th-list"></i> 
                                    </a>
                                    @endif
                                    <button type="button"
                                            class="modal-effect btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldemo8"
                                            data-url="{{ route('urhtc.destroy', $data->id) }}"
                                            data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($urhtc->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $urhtc->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
