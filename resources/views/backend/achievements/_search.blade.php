 {{-- Search/Filter Form --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('achievements.index') }}" class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="filter[title]" value="{{ request('filter.title') }}"
                           class="form-control" placeholder="Search by title">
                </div>
                <div class="col-md-3">
                    <input type="text" name="filter[subtitle]" value="{{ request('filter.subtitle') }}"
                           class="form-control" placeholder="Search by subtitle">
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
                    <a href="{{ route('achievements.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
