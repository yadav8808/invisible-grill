@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title">Department Category <span class="font-weight-normal text-muted ms-2">Lists</span></h4>
            <small class="text-muted">Total Department Categorys: {{ $departmentcategories->total() }}</small>
        </div>
        <div class="page-rightheader ms-md-auto">
            <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                <div class="d-lg-flex d-block">
                    <div class="btn-list">
                        <a href="{{ route('departmentcategorys.create') }}" class="btn btn-primary">
                            <i class="feather feather-plus fs-15 my-auto me-2"></i>Add Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    @include('backend.category._search')

    {{-- Table --}}
    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title">Department Category List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>S.No</th>

                             <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'department_course_id']) }}">Department Course Name ↑</a> |
                                <a href="{{ request()->fullUrlWithQuery(['sort' => '-department_course_id']) }}">↓</a>
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
                        @forelse ($departmentcategories as $category)
                            <tr>
                                <td>{{ $loop->iteration + ($departmentcategories->currentPage() - 1) * $departmentcategories->perPage() }}</td>

                                <td>
                                {{ $category->department?->title }}
                                @if($category->department?->title_hindi)
                                    <br><small class="text-muted">{{ $category->department?->title_hindi}}</small>
                                @endif
                            </td>
                                    <td>
                                {{ $category->name }}
                                @if($category->name_hindi)
                                    <br><small class="text-muted">{{ $category->name_hindi }}</small>
                                @endif
                            </td>
                                <td>
                                    @if ($category->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                            <a href="{{ route('departmentcategorys.edit', $category->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if($category->departmentdeatils?->count() == 0)
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('departmentcategorys.destroy', $category->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                        </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No category found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($departmentcategories->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $departmentcategories->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
     @include('backend.layouts.modol.delete')
@endsection
