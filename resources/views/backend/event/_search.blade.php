<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('events.index') }}" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="title" value="{{ request('title') }}"
                       class="form-control" placeholder="Search by title">
            </div>
            <div class="col-md-3">
                <input type="number" name="events_type" value="{{ request('events_type') }}"
                       class="form-control" placeholder="Search by type">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
