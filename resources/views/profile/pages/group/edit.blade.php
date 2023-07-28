@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="mygroups"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('mygroup.update', ['id' => $group->id]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="flex flex-row">
                        <div class="flex">
                            @if( $group->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 p-4 object-cover" src="{{ url('/image/no-image.png')}}" alt="{{ $group->name }}">
                            @else
                            <img class="h-20 w-20 rounded-full m-4 object-cover" src="{{ asset('storage/'. $group->image) }}" alt="{{ $group->image }}">
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input name="image" type="file" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5" />
                        </div>
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $group->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $group->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $group->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="phone" :value="__('Телефон')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $group->phone)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="web" :value="__('Веб')" />
                        <x-text-input id="web" name="web" type="text" class="mt-1 block w-full" :value="old('web', $group->web)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('web')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="viber" :value="__('Вайбер')" />
                        <x-text-input id="viber" name="viber" type="text" class="mt-1 block w-full" :value="old('viber', $group->viber)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('viber')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="telegram" :value="__('Телеграм')" />
                        <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full" :value="old('telegram', $group->telegram)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="vkontakte" :value="__('Вконтакте')" />
                        <x-text-input id="vkontakte" name="vkontakte" type="text" class="mt-1 block w-full" :value="old('vkontakte', $group->vkontakte)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="instagram" :value="__('Инстаграм')" />
                        <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full" :value="old('instagram', $group->instagram)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                    </div>

                    <div class="my-3">
                        <label for="cstegory" class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
                        <select name="category" id="category" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="{{ $group->category->id }}">{{ $group->category->name }}</option>
                            @foreach( $categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="group_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="group_city" class="w-full" style="border-color: rgb(209 213 219)" id="group_city">
                            <option value='{{ $group->city->id }}'>{{ $group->city->name }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-3">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        if ($("#group_city").length > 0) {
            $("#group_city").select2({
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