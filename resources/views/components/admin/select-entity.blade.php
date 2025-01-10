@props(['selectedEntity' => null])

<div class="col-span-6" id="select_entity_div" wire:ignore>
    <label for="select_entity" class="text-sm font-medium text-gray-900 block mb-2">Сущность</label>
    <select name="select_entity" class="w-full" id="select_entity" wire:model.live="selectedType" required>
        @if (isset($selectedUser))
            <option value="{{ $selectedUser->id }}"> {{ $selectedUser->firstname }} {{ $selectedUser->phone }}</option>
        @else
            <option value=''>-- выбор сущности --</option>
        @endif
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
        $('#select_entity').on('change', function(e) {
            // let elementName = $(this).attr('id');
            // var data = $(this).select2("val");
            @this.set('selectedType', e.target.value);
        });
    }
</script>
