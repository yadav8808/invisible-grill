@extends('backend.layouts.master')
@section('content')
<div class="page-header">
    <h4 class="page-title">Departments Courses List</h4>
    <a href="{{ route('departments-courses.create') }}" class="btn btn-primary">Add New</a>
</div>

 @include('backend.academics.departments_courses._search')

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
                    <th>Image</th>
                    <th>Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $loop->iteration + ($courses->currentPage()-1)*$courses->perPage() }}</td>
                         <td>{{ $course->category?->name }}</td>
                               <td>{{ $course->subcategory?->name }}</td>

                                <td>
                                {{ $course->title }}
                                @if($course->title_hindi)
                                    <br><small class="text-muted">{{ $course->title_hindi }}</small>
                                @endif
                            </td>
                        <td>
                            @if($course->image)
                                <img src="{{ asset('storage/'.$course->image) }}" width="80" height="40">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            @if($course->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                         <td>
                            <a href="{{ route('departments-courses.edit',$course->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="modal-effect btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modaldemo8"
                                    data-url="{{ route('departments-courses.destroy',$course->id) }}"
                                    data-effect="effect-newspaper">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No courses found</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>
</div>
 @include('backend.layouts.modol.delete')
@endsection
