@extends('backend.layouts.master')

@section('content')
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">General Administrations List</h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="d-lg-flex d-block">
                <div class="btn-list">
                    <a href="{{ route('general-administration.create') }}" class="btn btn-primary">
                        <i class="feather feather-plus fs-15 my-auto me-2"></i> Add General Administration
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.general-administration._search')

{{-- Table --}}
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th> Sub -category</th>


                       <th>Title</th>
                         {{-- <th>Designation</th>
                        <th>Mobile</th>
                        <th>Email</th> --}}

                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($general_administrations as $general_administration)
                        <tr>
                            <td>{{ $loop->iteration + ($general_administrations->firstItem() - 1) }}</td>
                              <td>{{ $general_administration->category?->name }}</td>
                                <td>{{ $general_administration->subCategory?->name }}</td>

                            <td>
                                {{ $general_administration->title }}
                                @if($general_administration->title_hindi)
                                    <br><small class="text-muted">{{ $general_administration->title_hindi }}</small>
                                @endif
                            </td>

                            {{-- <td> <td>
                                {{ $general_administration->designation }}
                                @if($general_administration->designation_hindi)
                                    <br><small class="text-muted">{{ $general_administration->designation_hindi }}</small>
                                @endif
                            </td>
                            <td>{{ $general_administration->mobile_no }}</td>
                            <td>{{ $general_administration->email }}</td> --}}

                            <td>
                                @if($general_administration->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                            <a href="{{ route('general-administration.edit', $general_administration->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('general-administration.destroy', $general_administration->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No general administrations found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $general_administrations->appends(request()->query())->links() }}
        </div>
    </div>
</div>
  @include('backend.layouts.modol.delete')
@endsection
