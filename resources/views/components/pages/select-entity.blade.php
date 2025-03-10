<div class="w-full mt-3">
    <select name="entity" style="border-color: rgb(209 213 219); width: 20rem" id="entity">
        <option value=''>Поиск по номеру лота или слова</option>
    </select>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        if ($("#entity").length > 0) {
            $("#entity").select2({
                language: {
                    noResults: function() {
                        return "Ничего не найдено"; // Ваш кастомный текст
                    },
                    searching: function() {
                        return "Идет поиск...";
                    }
                },
                ajax: {
                    url: "{{ route('entities') }}",
                    type: "GET",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term || '',
                            page: params.page || 1,
                        };
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

        $('#entity').on('select2:select', function(e) {
            var data = e.params.data;
            window.location.href = data.url; // Переход по ссылке
        });
    });
</script>
