@extends('backend.layouts.master')

@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Pages <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Pages: {{ $pages->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('page-management.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.page-management._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Pages List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Parent Name ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}">Page Name ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-title']) }}">↓</a>
                            </th>
                           <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'content_types']) }}">Content Types ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-content_types']) }}">↓</a>
                            </th>

                              <th>
                              Menu Types

                            </th>

                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Status ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $page)
                            <tr>
                                <td>{{ $loop->iteration + ($pages->currentPage() - 1) * $pages->perPage() }}</td>
                                <td>
                                    @if($page->parent)
                                        <span class="text-success">{{ $page->parent->title }}</span>
                                    @else
                                        <span class="text-danger">No Parent</span>
                                    @endif
                                </td>

                                <td>{{ $page->title }}</td>

                            <td>
                                    {{ $page->content_types == 1 ? 'Manual' : ($page->content_types == 2 ? 'URL' : ($page->content_types == 3 ? 'PDF' : 'Unknown')) }}
                                </td>
                                  <td>
                                    @if ($page->top_menu == 1)
                                        <button class="btn btn-sm btn-primary">TOP MENU</button>
                                    @elseif ($page->left_menu == 1)
                                        <button class="btn btn-sm btn-warning">LEFT MENU</button>
                                    @elseif ($page->footer_menu == 1)
                                        <button class="btn btn-sm btn-success">FOOTER MENU</button>
                                    @else
                                        <button class="btn btn-sm btn-secondary">Unknown</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($page->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                            <a href="{{ route('page-management.edit', $page->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('page-management.destroy', $page->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No pages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($pages->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $pages->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @include('backend.layouts.modol.delete')
@endsection
