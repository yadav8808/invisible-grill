<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('feverwaters.index') }}" class="row g-2">
            {{-- Search by Title --}}
            <div class="col-md-4">
                <input type="text" 
                       name="filter[title]" 
                       value="{{ request('filter.title') }}" 
                       class="form-control" 
                       placeholder="Search by Title">
            </div>

            {{-- Filter by Status --}}
            <div class="col-md-4">
                <select name="filter[status]" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="1" {{ request('filter.status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('filter.status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-4 d-flex">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('feverwaters.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
