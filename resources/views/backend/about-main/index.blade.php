@extends('backend.layouts.master')
@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">About Main <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
        <small class="text-muted">Total About Main Items: {{ $aboutmains->total() }}</small>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('about-main.create') }}" class="btn btn-primary">
                        <i class="feather feather-plus fs-15 my-auto me-2"></i>Add About Item
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filters --}}
@include('backend.about-main._search') {{-- optional: search partial similar to banners --}}

{{-- Table --}}
<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">About Main List</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                <thead>
                    <tr>
                        <th>#</th>

                         <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Category ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                        </th>
                         <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Sub Category ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Title ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
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
                    @forelse ($aboutmains as $gallery)
                        <tr>
                            <td>{{ $loop->iteration + ($aboutmains->currentPage() - 1) * $aboutmains->perPage() }}</td>
                             <td>{{ $gallery->category?->name }}</td>
                               <td>{{ $gallery->subcategory?->name }}</td>
                            <td>{{ $gallery->title }}</td>

                            <td>
                                @if ($gallery->image)
                                    <img src="{{ asset($gallery->image_url) }}" width="80" height="40" alt="Gallery"
                                         onclick="window.open('{{ asset($gallery->image_url) }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if ($gallery->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                            <a href="{{ route('about-main.edit', $gallery->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('about-main.destroy', $gallery->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No gallery items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@include('backend.layouts.modol.delete') {{-- Delete Modal --}}
    {{-- Pagination --}}
    @if ($aboutmains->hasPages())
        <div class="card-footer d-flex justify-content-end">
            {{ $aboutmains->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
