@extends('admin.layouts.app')

@section('content')

<div id="main-content" class="h-full w-full p-3 bg-gray-50 relative overflow-y-auto">
    <main>
        <div class=" mb-4 flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden">
                        <div class="relative w-full px-4 h-full md:h-auto">
                            <div class="bg-white rounded-lg relative">
                                <div class="flex items-start p-5 border-b rounded-t m-1 md:m-3">
                                    <div class="flex items-center mb-4">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">Edit {{ $vacancy->name }}</h3>
                                    </div>

                                </div>

                                <div class="p-6 space-y-6">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.vacancy.update', ['vacancy'=> $vacancy->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Name*</label>
                                                <input type="text" name="name" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required autofocus autocomplete="name" value="{{ $vacancy->name }}">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Address*</label>
                                                <input type="text" name="address" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $vacancy->address }}" required autofocus autocomplete="address">
                                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Description</label>
                                                <input type="text" name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $vacancy->description }}" required autofocus autocomplete="description">
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Price</label>
                                                <input type="number" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $vacancy-> price }}" required autocomplete="price">
                                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="items-center p-6 border-gray-200 rounded-b">
                                            <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save resume</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection