@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row mx-auto my-10">

    <x-nav-profile page="myworks"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('myvacancies.update', ['myvacancy' => $vacancy->id]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="w-full mb-3">
                        <h2 class="text-xl">Редактировать вакансию</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $vacancy->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $vacancy->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $vacancy->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="price" :value="__('Зарплата')" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $vacancy->price ? $vacancy->price : 0)" min=0 autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <div class="my-3">
                        <label for="parent" class="text-sm font-medium text-gray-900 block mb-2">Инициатор</label>
                        <select name="parent" id="parent" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option 
                            @if($vacancy->parent_type == 'App\Models\User')
                            value="User|{{ $vacancy->parent->id }}"
                            @elseif ($vacancy->parent_type == 'App\Models\Company')
                            value="Company|{{ $vacancy->parent->id }}"
                            @else ($vacancy->parent_type == 'App\Models\Group')
                            value="Group|{{ $vacancy->parent->id }}"
                            @endif
                            > {{ $vacancy->parent->name ? $vacancy->parent->name : $vacancy->parent->firstname }} {{  $vacancy->parent->lastname }}</option>
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
                        <label for="vacancy_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="vacancy_city" class="w-full" style="border-color: rgb(209 213 219)" id="vacancy_city">
                            <option value='{{ $vacancy->city->id }}'>{{ $vacancy->city->name }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-5">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>
            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                <form method="post" action="{{ route('myvacancies.destroy', ['myvacancy' => $vacancy->id]) }}" class="w-full text-center">
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
        if ($("#vacancy_city").length > 0) {
            $("#vacancy_city").select2({
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