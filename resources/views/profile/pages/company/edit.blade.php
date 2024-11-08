@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row mx-auto my-10">

    <x-nav-profile page="mycompanies"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
                <form method="post" action="{{ route('mycompanies.update', ['mycompany' => $company->id]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input name="image_r" type="text" id="image_r" class="hidden" style="z-index:-10;" />

                    <div class="w-full">
                        <h2 class="text-xl">Редактировать компанию</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="flex flex-row">
                        <div class="flex relative">
                            @if( $company->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ url('/image/no-image.png')}}" alt="image">
                            @else
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ asset('storage/'. $company->image) }}" alt="image">
                            @endif
                            <button type="button" id="remove_image" class="absolute top-5 right-5" @if( $company->image == null)
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
                                <span class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <x-input-error :messages="$errors->get('image')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $company->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $company->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $company->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="phone" :value="__('Телефон')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $company->phone)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="whatsapp" :value="__('Whatsapp')" />
                        <x-text-input id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full" :value="old('whatsapp')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="web" :value="__('Веб')" />
                        <x-text-input id="web" name="web" type="text" class="mt-1 block w-full" :value="old('web', $company->web)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('web')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="viber" :value="__('Вайбер')" />
                        <x-text-input id="viber" name="viber" type="text" class="mt-1 block w-full" :value="old('viber', $company->viber)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('viber')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="telegram" :value="__('Телеграм')" />
                        <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full" :value="old('telegram', $company->telegram)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="vkontakte" :value="__('Вконтакте')" />
                        <x-text-input id="vkontakte" name="vkontakte" type="text" class="mt-1 block w-full" :value="old('vkontakte', $company->vkontakte)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="instagram" :value="__('Инстаграм')" />
                        <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full" :value="old('instagram', $company->instagram)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                    </div>

                    <div class="my-3">
                        <label for="company_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="company_city" class="w-full" style="border-color: rgb(209 213 219)" id="company_city">
                            <option value='{{ $company->city->id }}'>{{ $company->city->name }}</option>
                        </select>
                    </div>

                    <div class="my-5">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="flex basis-full bg-gray-200 rounded-md p-5 my-6 text-sm">
                <form method="post" action="{{ route('mycompanies.destroy', ['mycompany' => $company->id]) }}" class="w-full text-center">
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
        if ($("#company_city").length > 0) {
            $("#company_city").select2({
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
        $('#image').on('change', function(event) {
            var selectedFile = event.target.files[0];

            // Check file size (in bytes)
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('.input-file input[type=file]').next().html('максимальный размер 2 мб');
                $('.input-file input[type=file]').next().css({
                    "color": "rgb(239 68 68)"
                });
                $('#image').val('');
                $('#image_r').val('');
                $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
                $('#remove_image').css({
                    "display": "none"
                });
                return;
            } else {
                let file = this.files[0];
                $('.input-file input[type=file]').next().html(file.name);
                $(this).next().css({
                    "color": "rgb(71 85 105)"
                });
                $('#remove_image').css({
                    "display": "block"
                });
                $('#image_r').val('');

                // Display file preview
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img').attr('src', event.target.result);

                };
                reader.readAsDataURL(selectedFile);
                return;
            }
        });
        $('#remove_image').on('click', function() {
            $('#image').val('');
            $('#image_r').val('delete');
            $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
            $('.input-file input[type=file]').next().html('Выберите файл');
            $('#remove_image').css({
                "display": "none"
            });
        });
    });
</script>
@endsection