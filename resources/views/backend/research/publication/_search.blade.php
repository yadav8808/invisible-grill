<div class="card mb-3">
    <div class="card-body">
        <form id="media-filter-form" method="GET" action="{{ route('research-publication.index') }}" class="row g-2">
            {{-- Title Filter --}}
            <div class="col-md-3">
                <input type="text" name="filter[title]" id="filter-title" value="{{ request('filter.title') }}"
                       class="form-control" placeholder="Search by title">
            </div>

            {{-- Type Filter --}}


            {{-- Status Filter --}}
            <div class="col-md-3">
                <select name="filter[status]" id="filter-status" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="1" {{ request('filter.status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('filter.status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </form>
    </div>
</div>

<script>
    // Debounce function to prevent too many requests
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const submitFilter = debounce(() => {
        const form = document.getElementById('media-filter-form');
        const url = new URL(form.action);
        const formData = new FormData(form);
        formData.forEach((value, key) => url.searchParams.set(key, value));
        window.location.href = url; // redirect with updated query
    }, 500); // 500ms delay

    document.getElementById('filter-title').addEventListener('keyup', submitFilter);
    document.getElementById('filter-type').addEventListener('change', submitFilter);
    document.getElementById('filter-status').addEventListener('change', submitFilter);
</script>

