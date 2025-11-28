@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Media <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Media Items: {{ $medias->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('media.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Media Item
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}

    @include('backend.media._search')
    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Media List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Type ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">Title ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-status']) }}">↓</a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'subtitle']) }}">Pdf Path /Image path ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-subtitle']) }}">↓</a>
                            </th>
                            <th>Status</th>

                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medias as $media)
                            <tr>
                                <td>{{ $loop->iteration + ($medias->currentPage() - 1) * $medias->perPage() }}</td>
                                  <td>{{ $media->category?->name }}</td>
                                    <td>{{ $media->subCategory?->name }}</td>
                                <td>{{ $media->type }}</td>
                                <td>{{ $media->title }}</td>

                                <td>
                                    @if ($media->type == 'PDF')
                                        @if ($media->pdf)
                                            <a href="{{ asset($media->pdf_url) }}" target="_blank">View PDF</a>
                                            <div class="mt-1 d-flex align-items-center">
                                                <input type="text" id="pdf_path_{{ $media->id }}" readonly
                                                    value="{{ asset($media->pdf_url) }}"
                                                    class="form-control form-control-sm me-2"
                                                    style="width:100%; background:#f5f5f5; border:none;">
                                                <button class="btn btn-light btn-sm"
                                                    onclick="copyToClipboard('pdf_path_{{ $media->id }}')"
                                                    title="Copy">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted">No PDF</span>
                                        @endif
                                    @else
                                        @if ($media->image)
                                            <img src="{{ asset($media->image_url) }}" width="80" height="40"
                                                alt="media" style="cursor:pointer;"
                                                onclick="window.open('{{ asset($media->image_url) }}', '', 'scrollbars=yes,resizable=yes,width=550,height=450,top=150,left=200'); return false;">
                                            <div class="mt-1 d-flex align-items-center">
                                                <input type="text" id="image_path_{{ $media->id }}" readonly
                                                    value="{{ asset($media->image_url) }}"
                                                    class="form-control form-control-sm me-2"
                                                    style="width:100%; background:#f5f5f5; border:none;">
                                                <button class="btn btn-light btn-sm"
                                                    onclick="copyToClipboard('image_path_{{ $media->id }}')"
                                                    title="Copy">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($media->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('media.edit', $media->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="modal-effect btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modaldemo8" data-url="{{ route('media.destroy', $media->id) }}"
                                        data-effect="effect-newspaper">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No media items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($medias->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $medias->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
     @include('backend.layouts.modol.delete')
@endsection
@push('js')
    <script>
        function copyToClipboard(id) {
            const input = document.getElementById(id);
            input.select();
            input.setSelectionRange(0, 99999); // for mobile
            navigator.clipboard.writeText(input.value).catch(err => console.error('Failed to copy: ', err));
        }
    </script>

@endpush
