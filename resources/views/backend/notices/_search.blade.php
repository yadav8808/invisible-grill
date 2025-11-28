<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('notices.index') }}" class="row g-2">

            {{-- Title Filter --}}
            <div class="col-md-3">
                <input type="text" name="filter[title]"
                       value="{{ request('filter.title') }}"
                       class="form-control" placeholder="Search by title">
            </div>


            {{-- Status Filter --}}
            <div class="col-md-3">
                <select name="filter[status]" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="1" {{ request('filter.status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('filter.status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('notices.index') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>
    </div>
</div>
