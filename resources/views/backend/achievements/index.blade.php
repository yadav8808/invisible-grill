@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Achievements <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Achievements: {{ $achievements->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('achievements.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Achievement
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- Filters --}}
@include('backend.achievements._search') {{-- optional: search partial similar to banners --}}

    {{-- Achievements Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Achievements List</h3>
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
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'subtitle']) }}">Subtitle ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-subtitle']) }}">↓</a>
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
                        @forelse ($achievements as $achievement)
                            <tr>
                                <td>{{ $loop->iteration + ($achievements->currentPage() - 1) * $achievements->perPage() }}</td>
                                <td>{{ $achievement->title }}</td>
                                <td>{{ $achievement->subtitle ?? '-' }}</td>
                                <td>
                                    @if ($achievement->image)
                                        <img src="{{ $achievement->image_url }}" width="80" height="40" alt="achievement"
                                        onclick="window.open('{{ $achievement->image_url }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($achievement->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                            <a href="{{ route('achievements.edit', $achievement->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('achievements.destroy', $achievement->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No achievements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($achievements->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $achievements->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
     @include('backend.layouts.modol.delete')
@endsection
