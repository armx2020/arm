<div class="col-span-6" id="select_entity_div" wire:ignore>
    <label for="select_entity" class="text-sm font-medium text-gray-900 block mb-2">Сущность</label>
    <select name="select_entity" class="w-full" id="select_entity" wire:model="selectedType" required>
        <option value='1'>-- выбор сушности --</option>
    </select>
</div>

<script type="text/javascript">
    if ($("#select_entity").length > 0) {
        $("#select_entity").select2({
            ajax: {
                url: " {{ route('admin.get-entity') }}",
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
