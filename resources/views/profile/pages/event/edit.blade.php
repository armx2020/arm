@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row mx-auto my-10">

    <x-nav-profile page="myevents"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('myevents.update', ['myevent' => $event->id ]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input name="image_remove" type="text" id="image_remove" class="hidden" style="z-index:-10;" />

                    <div class="w-full">
                        <h2 class="text-xl">Редактировать мероприятие</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="flex flex-row" id="upload_area">
                        <div class="flex relative">
                            @if( $event->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ url('/image/no-image.png')}}" alt="image">
                            @else
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ asset('storage/'. $event->image) }}" alt="image">
                            @endif
                            <button type="button" id="remove_image" class="absolute top-5 right-5" @if( $event->image == null)
                                style="display: none;"
                                @else
                                style="display: block;"
                                @endif
                                ><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;">
                            </button>
                        </div>

                        <div class="flex items-center">
                            <label class="input-file relative inline-block">
                                <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <x-input-error :messages="$errors->get('image')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $event->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <label for="date" class="text-sm font-medium text-gray-900 block mb-2">Дата*</label>
                        <input type="date" name="date_to_start" id="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $event->date_to_start }}" max="{{ date('Y-m-d') }}" required>
                        <x-input-error :messages="$errors->get('date_to_start')" class="mt-2" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $event->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $event->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-3">
                        <label for="parent" class="text-sm font-medium text-gray-900 block mb-2">Инициатор</label>
                        <select name="parent" id="parent" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option
                            @if($event->parent_type == 'App\Models\User')
                            value="User|{{ $event->parent->id }}"
                            @elseif ($event->parent_type == 'App\Models\Company')
                            value="Company|{{ $event->parent->id }}"
                            @else ($event->parent_type == 'App\Models\Group')
                            value="Group|{{ $event->parent->id }}"
                            @endif
                            > {{ $event->parent->name ? $event->parent->name : $event->parent->firstname }} {{  $event->parent->lastname }}</option>
                            <option disabled>-выберите инициатора-</option>
                            <option value="User|{{ Auth::user()->id }}">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</option>
                            <option disabled>-группы-</option>
                            @foreach( $groups as $group)
                            <option value="Group|{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                            <option disabled>-компании-</option>
                            @foreach( $companies as $company)
                            <option value="Company|{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
                        <select name="category" id="category" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="{{ $event->category->id }}">{{ $event->category->name }}</option>
                            @foreach( $categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="event_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="event_city" class="w-full" style="border-color: rgb(209 213 219)" id="event_city">
                            <option value='{{ $event->city->id }}'>{{ $event->city->name }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-6">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                <form method="post" action="{{ route('myevents.destroy', ['myevent' => $event->id]) }}" class="w-full text-center">
                    @csrf
                    @method('delete')

                    <div class="m-2 flex flex-row justify-between basis-full">
                        <div class="text-lg font-medium text-gray-900 flex">
                            {{ __('Чтобы удалить, нажмите') }}
                        </div>
                        <x-danger-button class="flex">
                            {{ __('Удалить') }}
                        </x-danger-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        if ($("#event_city").length > 0) {
            $("#event_city").select2({
                ajax: {
                    url: " {{ route('cities') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
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
                $('.input-file input[type=file]').next().css({ "color": "rgb(239 68 68)" });
                $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
                $('#remove_image').css({ "display": "none" });
            } else {
                $('.input-file input[type=file]').next().html(file.name);
                $('.input-file input[type=file]').next().css({ "color": "rgb(71 85 105)" });
                $('#remove_image').css({ "display": "block" });
                previewImage(file);
            }
        }

        $('#image').on('change', function(event) {
            var selectedFile = event.target.files[0];
            handleFile(selectedFile);
        });

        $('#remove_image').on('click', function() {
            $('#image').val('');
            $('#image_remove').val('delete');
            $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
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
    });
</script>
@endsection
