@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="mynews"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('mynews.update', ['mynews' => $news->id ]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="w-full">
                        <h2 class="text-xl">Редактировать новость</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="flex flex-row">
                        <div class="flex">
                            @if( $news->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 p-4 object-cover" src="{{ url('/image/no-image.png')}}" alt="{{ $news->name }}">
                            @else
                            <img class="h-20 w-20 rounded-lg m-4 p-4 object-cover" src="{{ asset('storage/'. $news->image) }}" alt="{{ $news->image }}">
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input name="image" type="file" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5" />
                        </div>
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $news->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <label for="date" class="text-sm font-medium text-gray-900 block mb-2">Дата*</label>
                        <input type="date" name="date" id="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $news->date }}" max="{{ date('Y-m-d') }}" required>
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $news->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-3">
                        <label for="news_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="news_city" class="w-full" style="border-color: rgb(209 213 219)" id="news_city">
                            <option value='{{ $news->city->id }}'>{{ $news->city->name }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-6">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                <form method="post" action="{{ route('mynews.destroy', ['mynews' => $news->id]) }}" class="w-full text-center">
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
        if ($("#news_city").length > 0) {
            $("#news_city").select2({
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