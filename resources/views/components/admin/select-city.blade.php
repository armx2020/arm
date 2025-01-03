<div class="col-span-6" id="select_city_div" wire:ignore>
    <label for="select_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
    <select name="select_city" class="w-full" id="select_city" style="background-color: brown">
        <option value='1'>-- выбор города --</option>
    </select>
</div>

<script type="text/javascript">
    if ($("#select_city").length > 0) {
        $("#select_city").select2({
            ajax: {
                url: " {{ route('admin.get-city') }}",
                type: "get",
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    var query = {
                        query: params.term || '',
                        page: params.page || 1,
                        "_token": "{{ csrf_token() }}",
                    };

                    return query;
                },
                processResults: function(response, params) {
                    params.page = params.page || 1;
                    return {
                        results: response.results,
                        pagination: {
                            more: response.pagination.more
                        }
                    };
                },
                cache: true
            }
        });
    }
</script>

<style>
    .select2-container--default .select2-selection--single {
        background-color: rgb(249 250 251 / var(--tw-bg-opacity));
        border-color: rgb(209 213 219));
        border-radius: 0.5rem;
    }
</style>
