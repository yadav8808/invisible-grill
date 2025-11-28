<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('directors.index') }}" class="row g-2" id="director-filter-form">
            <div class="col-md-3">
                <input type="text" name="filter[name]" value="{{ request('filter.name') }}"
                       class="form-control" placeholder="Search by name">
            </div>
            <div class="col-md-3">
                <input type="text" name="filter[designation]" value="{{ request('filter.designation') }}"
                       class="form-control" placeholder="Search by designation">
            </div>
            <div class="col-md-3">
                <select name="filter[status]" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="1" {{ request('filter.status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('filter.status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('directors.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
