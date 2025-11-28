<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('annual-reports.index') }}" class="row g-2">
            
            {{-- Filter by Year --}}
            <div class="col-md-3">
                <select name="filter[year]" class="form-control">
                    <option value="">-- Select Year --</option>
                    @for ($y = date('Y'); $y >= 2000; $y--)
                        <option value="{{ $y }}" {{ request('filter.year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- Filter by Status --}}
            <div class="col-md-3">
                <select name="filter[status]" class="form-control">
                    <option value="">-- Select Status --</option>
                    <option value="1" {{ request('filter.status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('filter.status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('annual-reports.index') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>
    </div>
</div>
