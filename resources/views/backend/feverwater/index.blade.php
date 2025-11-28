@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Feverwater <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Feverwaters: {{ $feverwaters->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('feverwaters.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Feverwater
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.feverwater._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Feverwater List</h3>
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
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feverwaters as $feverwater)
                            <tr>
                                <td>{{ $loop->iteration + ($feverwaters->currentPage() - 1) * $feverwaters->perPage() }}</td>
                                <td>{{ $feverwater->title }}</td>
                                <td>{{ $feverwater->title_hindi ?? '-' }}</td>
                               <td>
                                    @if($feverwater->page_type == 1)
                                        <span class="badge bg-primary">Fever</span>
                                    @elseif($feverwater->page_type == 2)
                                        <span class="badge bg-info">Water</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                <td>
                                    @if ($feverwater->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('feverwaters.edit', $feverwater->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="modal-effect btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldemo8"
                                            data-url="{{ route('feverwaters.destroy', $feverwater->id) }}"
                                            data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Feverwaters found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($feverwaters->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $feverwaters->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
