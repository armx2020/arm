@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="myoffers"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('myoffers.update', ['myoffer' => $offer->id ]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="w-full">
                        <h2 class="text-xl">Редактировать товар</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="flex flex-row">
                        <div class="flex">
                            @if( $offer->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 p-4 object-cover" src="{{ url('/image/no-image.png')}}" alt="{{ $offer->name }}">
                            @else
                            <img class="h-20 w-20 rounded-lg m-4 p-4 object-cover" src="{{ asset('storage/'. $offer->image) }}" alt="{{ $offer->image }}">
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input name="image" type="file" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5" />
                        </div>
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $offer->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $offer->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $offer->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="price" :value="__('Цена')" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $offer->price)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <div class="my-3">
                        <label for="company" class="text-sm font-medium text-gray-900 block mb-2">Компания</label>
                        <select name="company" id="company" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="{{ $offer->company->id }}"> {{ $offer->company->name }}
                            @foreach( $companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="cstegory" class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
                        <select name="category" id="category" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="{{ $offer->category->id }}">{{ $offer->category->name }}</option>
                            @foreach( $categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                  <div class="flex items-center gap-4 my-6">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                <form method="post" action="{{ route('myoffers.destroy', ['myoffer' => $offer->id]) }}" class="w-full text-center">
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
@endsection