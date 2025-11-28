@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Icematerials <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Materials: {{ $icematerials->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('icematerials.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Material
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.icematerial._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Icematerial List</h3>
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
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'description']) }}">Description ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-description']) }}">↓</a>
                            </th>
                            <th>Image</th>
                            <th>PDF</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($icematerials as $material)
                            <tr>
                                <td>{{ $loop->iteration + ($icematerials->currentPage() - 1) * $icematerials->perPage() }}</td>
                                <td>{{ $material->title }}</td>
                                 <td>{{ $material->description }}</td>
                                <td>
                                    @if ($material->image)
                                        <img src="{{ $material->image_url }}" width="80" height="40" alt="image"
                                        onclick="window.open('{{ $material->image_url }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($material->pdf)
                                        <a href="{{ $material->pdf_url }}" target="_blank">View PDF</a>
                                    @else
                                        <span class="text-muted">No PDF</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($material->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('icematerials.edit', $material->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="modal-effect btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldemo8"
                                            data-url="{{ route('icematerials.destroy', $material->id) }}"
                                            data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No materials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($icematerials->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $icematerials->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
