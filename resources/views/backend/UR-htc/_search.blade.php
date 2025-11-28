<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('urhtc.index') }}" class="row g-2">
            {{-- Search by Title --}}
            <div class="col-md-4">
                <input type="text" 
                       name="filter[title]" 
                       value="{{ request('filter.title') }}" 
                       class="form-control" 
                       placeholder="Search by Title">
            </div>

            {{-- Filter by Content type --}}
            <div class="col-md-4">
                <select name="filter[type]" class="form-control">
                    <option value="">-- Content Page --</option>
                    <option value="UHTC" {{ request('filter.type') == 'UHTC' ? 'selected' : '' }}>UHTC</option>
                    <option value="RHTC" {{ request('filter.type') == 'RHTC' ? 'selected' : '' }}>RHTC</option>
                </select>
            </div>

             {{-- Filter by Content type --}}
            <div class="col-md-4">
                <select name="filter[content_type]" class="form-control">
                    <option value="">-- Content type --</option>
                    <option value="content" {{ request('filter.content_type') == 'content' ? 'selected' : '' }}>Content</option>
                    <option value="sub_cat" {{ request('filter.content_type') == 'sub_cat' ? 'selected' : '' }}>Sub Cat</option>
                </select>
            </div>

            {{-- Filter by Status --}}
            <div class="col-md-4">
                <select name="filter[status]" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="active" {{ request('filter.status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('filter.status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-4 d-flex">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('urhtc.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
