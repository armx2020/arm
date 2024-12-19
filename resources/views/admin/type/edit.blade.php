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
                                action="{{ route('admin.type.update', ['type' => $type->id]) }}">
                                @csrf
                                @method('PUT')

                                <input name="image_remove" type="text" id="image_remove" class="hidden"
                                    style="z-index:-10;" />


                                <div class="flex items-start p-5 border-b rounded-t">
                                    <div class="flex items-center mb-4">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $type->name }}</h3>
                                    </div>
                                </div>

                                <div class="p-6 space-y-6">

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label for="name"
                                                class="text-sm font-medium text-gray-900 block mb-2">Название *</label>
                                            <input type="text" name="name" id="firstname"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                required autofocus autocomplete="name" value="{{ $type->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="items-center py-6 border-gray-200 rounded-b">
                                        <button
                                            class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                            type="submit">Сохранить</button>
                                    </div>
                                </div>


                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection