@props(['selectedUser' => null])

<div class="col-span-6" id="user_div" wire:ignore>
    <label for="user" class="text-sm font-medium text-gray-900 block mb-2">Пользователь</label>
    <select name="user" class="w-full" id="user">
        @if (isset($selectedUser))
            <option value="{{ $selectedUser->id }}"> {{ $selectedUser->firstname }} {{ $selectedUser->phone }}</option>
        @else
            <option value=''>- без пользователя -</option>
        @endif
    </select>
</div>

<script type="text/javascript">
    $("#user").select2({
        ajax: {
            url: " {{ route('admin.get-user') }}",
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
</script>
