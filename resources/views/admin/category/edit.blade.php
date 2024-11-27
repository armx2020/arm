@extends('admin.layouts.app')
@section('content')
    <div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-coll">
        <div class="overflow-x-auto w-full">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden">
                    <div class="relative w-full h-full md:h-auto">

                        @if (session('success'))
                            <div class="my-4 bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="bg-white rounded-lg relative">

                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.category.update', ['category' => $category->id]) }}">
                                @csrf
                                @method('PUT')

                                <input name="image_r" type="text" id="image_r" class="hidden" style="z-index:-10;" />


                                <div class="flex items-start p-5 border-b rounded-t">
                                    <div class="flex items-center mb-4">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $category->name }}</h3>
                                    </div>
                                </div>

                                <div class="flex flex-row border-b" id="upload_area">
                                    <div class="flex relative">

                                        @if ($category->image == null || $category->image == 'group/groups.png')
                                            <img class="h-10 w-10 rounded-lg m-4 object-cover" id="img"
                                                src="{{ url('/image/no-image.png') }}" alt="image">
                                        @else
                                            <img class="h-10 w-10 rounded-lg m-4 object-cover" id="img"
                                                src="{{ asset('storage/' . $category->image) }}" alt="image">
                                        @endif

                                        <button type="button" id="remove_image" class="absolute top-2 right-2 hidden"
                                            @if ($category->image == null || $category->image == 'group/groups.png') style="display: none;" @else style="display: block;" @endif>
                                            <img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                                style="cursor:pointer;"></button>
                                    </div>

                                    <div class="flex items-center">
                                        <label class="input-file relative inline-block">
                                            <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image"
                                                class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                            <span
                                                class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                                style="cursor:pointer;">Выберите файл или перетащите в эту область</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <x-input-error :messages="$errors->get('image')" />
                                </div>

                                <div class="p-6 space-y-6">

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name"
                                                class="text-sm font-medium text-gray-900 block mb-2">Название *</label>
                                            <input type="text" name="name" id="firstname"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                required autofocus autocomplete="name" value="{{ $category->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="sort_id"
                                                class="text-sm font-medium text-gray-900 block mb-2">Сортировка *</label>
                                            <input type="number" name="sort_id" id="sort_id"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $category->sort_id }}" required autofocus>
                                            <x-input-error :messages="$errors->get('sort_id')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6">
                                            <label for="type" class="text-sm font-medium text-gray-900 block mb-2">Тип
                                                *</label>
                                            <select name="type" id="type"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                @switch($category->type)
                                                    @case('group')
                                                        <option value="group" selected>Для групп</option>
                                                        <option value="event">Для событий</option>
                                                        <option value="offer">Для предложений</option>
                                                    @break

                                                    @case('event')
                                                        <option value="group">Для групп</option>
                                                        <option value="event" selected>Для событий</option>
                                                        <option value="offer">Для предложений</option>
                                                    @break

                                                    @case('offer')
                                                        <option value="group">Для групп</option>
                                                        <option value="event">Для событий</option>
                                                        <option value="offer" selected>Для предложений</option>
                                                    @break
                                                @endswitch
                                                <option value="">Не выбрано</option>
                                            </select>
                                        </div>
                                        <div class="col-span-6" id="parent">
                                            <label for="parent"
                                                class="text-sm font-medium text-gray-900 block mb-2">Родительская</label>
                                            <select name="parent"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                @if ($category->category_id)
                                                    <option value="{{ $category->parent->id }}">
                                                    {{ $category->parent->name }} @empty($category->parent->category_id)
                                                        - ГЛАВНАЯ
                                                    @endempty
                                                </option>
                                            @else
                                                <option value="">Не выбрано</option>
                                            @endif
                                            <optgroup label="категории событий" class="event">
                                                @foreach ($categoriesForEvents as $category)
                                                    <option value="{{ $category->id }}" class="event">
                                                        {{ $category->name }} @empty($category->category_id)
                                                            - ГЛАВНАЯ
                                                        @endempty
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="категории групп" class="group">
                                                @foreach ($categoriesForGroups as $category)
                                                    <option value="{{ $category->id }}" class="group">
                                                        {{ $category->name }} @empty($category->category_id)
                                                            - ГЛАВНАЯ
                                                        @endempty
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="категории предложений" class="offer">
                                                @foreach ($categoriesForOffers as $category)
                                                    <option value="{{ $category->id }}" class="offer">
                                                        {{ $category->name }} @empty($category->category_id)
                                                            - ГЛАВНАЯ
                                                        @endempty
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="items-center py-6 border-gray-200 rounded-b">
                                    <button
                                        class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        type="submit">Сохранить</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $('#type').on('change', function() {
            if (this.value == 'event') {
                $('.Event').show();
                $('.Group').hide();
                $('.Offer').hide();
                $('.Categories').hide();
            } else if (this.value == 'group') {
                $('.Event').hide();
                $('.Group').show();
                $('.Offer').hide();
                $('.Categories').hide();
            } else if (this.value == 'offer') {
                $('.Event').hide();
                $('.Group').hide();
                $('.Offer').show();
                $('.Categories').hide();
            } else {
                $('.Event').hide();
                $('.Group').hide();
                $('.Offer').hide();
                $('.Categories').show();
            }
        });

        function previewImage(file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                $('#img').attr('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }

        function handleFile(file) {
            var fileSize = file.size;
            var maxSize = 2000000; // 2 MB

            if (fileSize > maxSize) {
                $('.input-file input[type=file]').next().html('максимальный размер 2 мб');
                $('.input-file input[type=file]').next().css({
                    "color": "rgb(239 68 68)"
                });
                $('#img').attr('src', `{{ url('/image/no-image.png') }}`);
                $('#remove_image').css({
                    "display": "none"
                });
            } else {
                $('.input-file input[type=file]').next().html(file.name);
                $('.input-file input[type=file]').next().css({
                    "color": "rgb(71 85 105)"
                });
                $('#remove_image').css({
                    "display": "block"
                });
                previewImage(file);
            }
        }

        $('#image').on('change', function(event) {
            var selectedFile = event.target.files[0];
            handleFile(selectedFile);
        });

        $('#remove_image').on('click', function() {
            $('#image').val('');
            $('#image_r').val('delete');
            $('#img').attr('src', `{{ url('/image/no-image.png') }}`);
            $('.input-file input[type=file]').next().html('Выберите файл или перетащите сюда');
            $('#remove_image').css({
                "display": "none"
            });
        });

        var uploadArea = $('#upload_area');

        uploadArea.on('dragover', function(event) {
            event.preventDefault();
            event.stopPropagation();
            uploadArea.addClass('bg-gray-200');
        });

        uploadArea.on('dragleave', function(event) {
            event.preventDefault();
            event.stopPropagation();
            uploadArea.removeClass('bg-gray-200');
        });

        uploadArea.on('drop', function(event) {
            event.preventDefault();
            event.stopPropagation();
            uploadArea.removeClass('bg-gray-200');

            var files = event.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                var file = files[0];
                handleFile(file);

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $('#image').prop('files', dataTransfer.files);
            }
        });

        function previewImage(file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                $('#img').attr('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }

        function handleFile(file) {
            var fileSize = file.size;
            var maxSize = 2000000; // 2 MB

            if (fileSize > maxSize) {
                $('.input-file input[type=file]').next().html('максимальный размер 2 мб');
                $('.input-file input[type=file]').next().css({
                    "color": "rgb(239 68 68)"
                });
                $('#img').attr('src', `{{ url('/image/no-image.png') }}`);
                $('#remove_image').css({
                    "display": "none"
                });
            } else {
                $('.input-file input[type=file]').next().html(file.name);
                $('.input-file input[type=file]').next().css({
                    "color": "rgb(71 85 105)"
                });
                $('#remove_image').css({
                    "display": "block"
                });
                previewImage(file);
            }
        }
    });
</script>
@endsection
