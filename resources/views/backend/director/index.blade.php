@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Director <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Directors: {{ $directors->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('directors.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Director
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.director._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Director List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}">Name ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-name']) }}">↓</a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'designation']) }}">Designation ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-designation']) }}">↓</a>
                            </th>
                            <th>Image</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($directors as $director)
                            <tr>
                                <td>{{ $loop->iteration + ($directors->currentPage() - 1) * $directors->perPage() }}</td>
                                <td>{{ $director->name }}</td>
                                <td>{{ $director->designation ?? '-' }}</td>
                                <td>
                                    @if ($director->image)
                                    <img src="{{ asset($director->image_url) }}" width="80" height="40" alt="director"
                                         onclick="window.open('{{ asset($director->image_url) }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                                </td>
                                <td>
                                    @if ($director->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('directors.edit', $director->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="modal-effect btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldemo8"
                                            data-url="{{ route('directors.destroy', $director->id) }}"
                                            data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No directors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($directors->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $directors->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
