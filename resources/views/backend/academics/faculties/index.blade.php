@extends('backend.layouts.master')

@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Faculties List</h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('faculty.create') }}" class="btn btn-primary">
                        <i class="feather feather-plus fs-15 my-auto me-2"></i> Add Faculty
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.academics.faculties._search')

{{-- Table --}}
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                         <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'category_id']) }}">Category ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-category_id']) }}">↓</a>
                        </th>
                         <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'sub_category_id']) }}">Sub Category ↑</a> |
                            <a href="{{ request()->fullUrlWithQuery(['sort' => '-sub_category_id']) }}">↓</a>
                        </th>

                        <th>Title</th>

                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faculties as $faculty)
                        <tr>
                            <td>{{ $loop->iteration + ($faculties->firstItem() - 1) }}</td>

                             <td>{{ $faculty->category?->name }}</td>
                               <td>{{ $faculty->subCategory?->name }}</td>

                                <td>
                                {{ $faculty->title }}
                                @if($faculty->title_hindi)
                                    <br><small class="text-muted">{{ $faculty->title_hindi }}</small>
                                @endif
                            </td>


                            <td>
                                @if($faculty->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                            <a href="{{ route('faculty.edit', $faculty->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('faculty.destroy', $faculty->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No faculties found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
              {{ $faculties->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
 @include('backend.layouts.modol.delete')
@endsection
