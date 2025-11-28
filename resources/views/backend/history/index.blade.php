@extends('backend.layouts.master')
@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">History <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
        <small class="text-muted">Total History Items: {{ $histories->total() }}</small>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('historys.create') }}" class="btn btn-primary">
                        <i class="feather feather-plus fs-15 my-auto me-2"></i>Add History Item
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filters --}}
@include('backend.history._search')

{{-- Table --}}
<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title">History List</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>
                            <a href="">Category ↑</a> |
                            <a href="">↓</a>
                        </th>
                        <th>
                            <a href="">Sub Category ↑</a> |
                            <a href="">↓</a>
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
                    @forelse ($histories as $history)
                        <tr>
                            <td>{{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}</td>

                              <td>{{ $history->category?->name }}</td>
                            <td>{{ $history->subcategory?->name }}</td>
                              <td>{{ $history->title }}</td>
                            <td>
                                @if ($history->image)
                                    <img src="{{ asset($history->image_url) }}" width="80" height="40" alt="history"
                                         onclick="window.open('{{ asset($history->image_url) }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if ($history->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('historys.edit', $history->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('historys.destroy', $history->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No history items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($histories->hasPages())
        <div class="card-footer d-flex justify-content-end">
            {{ $histories->links('pagination::bootstrap-5') }}
        </div>
    @endif
     @include('backend.layouts.modol.delete')
</div>
@endsection
