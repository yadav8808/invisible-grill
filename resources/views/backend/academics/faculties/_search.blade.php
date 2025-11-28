{{-- Filter/Search form --}}
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('faculty.index') }}" class="row g-2">
           <div class="col-md-2">
                <select name="filter[category_id]" id="filter_category_select" class="form-control">
                    <option value="">-- All Categories --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('filter.category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="filter[sub_category_id]" id="filter_subcategory_select" class="form-control">
                    <option value="">-- All Sub Categories --</option>
                    @if(request('filter.category_id'))
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ request('filter.sub_category_id') == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
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
                <a href="{{ route('faculty.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>


@push('js')
<script>
$(document).ready(function() {
    function loadSubcategories(categoryId, selectedSubcategoryId = null) {
        if (!categoryId) {
            $('#filter_subcategory_select').html('<option value="">-- All Sub Categories --</option>');
            return;
        }

        $.ajax({
            url: "{{ route('historys.byCategory', '') }}/" + categoryId,
            type: 'GET',
            success: function(data) {
                let options = '<option value="">-- All Sub Categories --</option>';
                $.each(data, function(i, item) {
                    let selected = (selectedSubcategoryId == item.id) ? 'selected' : '';
                    options += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });

                $('#filter_subcategory_select').html(options);
            }
        });
    }

    $('#filter_category_select').on('change', function() {
        loadSubcategories(this.value);
    });

    let currentCategory = "{{ request('filter.category_id') }}";
    let currentSubcategory = "{{ request('filter.sub_category_id') }}";

    if (currentCategory) {
        loadSubcategories(currentCategory, currentSubcategory);
    }
});
</script>
@endpush
