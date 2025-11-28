@extends('backend.layouts.master')
@section('content')
    <div class="page-header d-flex justify-content-between">
        <h4 class="page-title">Research Committee List</h4>
        <a href="{{ route('research-committees.create') }}" class="btn btn-primary">Add New</a>
    </div>
    @include('backend.research.committees._search')
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
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
                        <th>
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => request('sort') == 'title' ? '-title' : 'title']) }}">
                                Title
                                @if (request('sort') == 'title')
                                    ↑
                                @elseif(request('sort') == '-title')
                                    ↓
                                @endif
                            </a>
                        </th>

                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($committees as $committee)
                        <tr>
                            <td>{{ $loop->iteration + ($committees->currentPage() - 1) * $committees->perPage() }}</td>
                              <td>{{ $committee->category?->name }}</td>
                               <td>{{ $committee->subCategory?->name }}</td>

                                <td>
                                {{ $committee->title }}
                                @if($committee->title_hindi)
                                    <br><small class="text-muted">{{ $committee->title_hindi }}</small>
                                @endif
                            </td>



                            <td>
                                @if ($committee->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                            <a href="{{ route('research-committees.edit', $committee) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('research-committees.destroy', $committee) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No committees found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $committees->links('pagination::bootstrap-5') }}
        </div>
    </div>
     @include('backend.layouts.modol.delete')
@endsection
