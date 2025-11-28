@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Event <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Events: {{ $events->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Event
            </a>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.event._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Event List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                             <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'events_type']) }}">Event Type ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-events_type']) }}">↓</a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Title ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                            </th>

                            <th>Start Date</th>
                            <th>Image</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}</td>
                                 <td>{{ $event->subcategory?->name ?? '-' }}</td>
                                <td>{{ $event->title }}</td>

                                <td>{{ $event->start_date_time ? $event->start_date_time->format('Y-m-d H:i') : '-' }}</td>
                                <td>
                                    @if ($event->image)
                                        <img src="{{ $event->image_url }}" width="80" height="40" alt="event"
                                             onclick="window.open('{{ $event->image_url }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($event->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="modal-effect btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldemo8"
                                            data-url="{{ route('events.destroy', $event->id) }}"
                                            data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($events->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
