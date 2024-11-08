@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row mx-auto my-10">

    <x-nav-profile page="myresumes"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10 relative">
                <form method="post" action="{{ route('myresumes.store') }}" class="w-full" enctype="multipart/form-data">
                    @csrf

                    <div class="w-full">
                        <h2 class="text-xl">Добавить резюме</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="my-2">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('description')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="price" :value="__('Ожидаемая зарплата')" />
                        <x-text-input id="price" name="price" min="0" type="number" class="mt-1 block w-full" :value="old('price', 0)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <div class="my-2">
                        <label for="resume_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="resume_city" class="w-full" style="border-color: rgb(209 213 219); width:100%" id="resume_city">
                            <option value='{{ Auth::user()->city->id }}'>{{ Auth::user()->city->name }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-6">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        if ($("#resume_city").length > 0) {
            $("#resume_city").select2({
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