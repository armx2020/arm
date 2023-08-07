@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="mycompanies"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('mycompanies.update', ['mycompany' => $company->id]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="flex flex-row">
                        <div class="flex">
                            @if( $company->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 p-4 object-cover" src="{{ url('/image/no-image.png')}}" alt="{{ $company->name }}">
                            @else
                            <img class="h-20 w-20 rounded-full m-4 object-cover" src="{{ asset('storage/'. $company->image) }}" alt="{{ $company->image }}">
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input name="image" type="file" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5" />
                        </div>
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

            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6 text-sm">
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
    });
</script>
@endsection