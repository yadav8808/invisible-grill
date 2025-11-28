@extends('backend.layouts.master')
@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Department Details <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
        <small class="text-muted">Total Department Details: {{ $departmentdetails->total() }}</small>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('departmentdetails.create') }}" class="btn btn-primary">
                        <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Department Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filters --}}
@include('backend.departmentdetails._search')

{{-- Table --}}
<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">Department Details List</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'category_id']) }}">Category ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-category_id']) }}">↓</a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'sub_category_id']) }}">Subcategory ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-sub_category_id']) }}">↓</a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Title ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                        </th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departmentdetails as $departmentdetail)
                        <tr>
                            <td>{{ $loop->iteration + ($departmentdetails->currentPage() - 1) * $departmentdetails->perPage() }}</td>
                            <td>{{ $departmentdetail->category?->name }}</td>
                            <td>{{ $departmentdetail->department?->title }}</td>
                            <td>{{ $departmentdetail->title }}</td>
                            <td>
                                @if ($departmentdetail->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('departmentdetails.edit', $departmentdetail->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('departmentdetails.destroy', $departmentdetail->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No department details found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($departmentdetails->hasPages())
        <div class="card-footer d-flex justify-content-end">
            {{ $departmentdetails->links('pagination::bootstrap-5') }}
        </div>
    @endif

    @include('backend.layouts.modol.delete')
</div>
@endsection
