@extends('admin.layouts.app')
@section('content')
<div class=" mb-4 flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <div class="relative w-full h-full md:h-auto">
                    <div class="bg-white rounded-lg relative">
                        <div class="flex items-start p-5 border-b rounded-t">
                            <div class="flex items-center mb-4">
                                @if( $news->image == null)
                                <img class="h-10 w-10 rounded-full m-4 opacity-50" src="{{ url('/image/no-camera.png')}}" alt="{{ $news->name }}">
                                @else
                                <img class="h-10 w-10 rounded-full m-4" src="{{ asset('storage/'. $news->image) }}" alt="{{ $news->image }}">
                                @endif
                                <h3 class="text-2xl font-bold leading-none text-gray-900">Edit {{ $news->name }}</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.news.update', ['news' => $news->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Name*</label>
                                        <input type="text" name="name" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required autofocus autocomplete="name" value="{{ $news->name }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Description</label>
                                        <input type="text" name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $news->description }}" required autofocus autocomplete="description">
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="date" class="text-sm font-medium text-gray-900 block mb-2">Date*</label>
                                        <input type="date" name="date" id="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $news->date }}" required autofocus>
                                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6">
                                        <label for="city" class="text-sm font-medium text-gray-900 block mb-2">City*</label>
                                        <select name="city" class="w-full" id="dd_city">
                                            <option value='{{ $news->city->id }}'>{{ $news->city->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="my-5">
                                <div class="flex flex-row ">
                                    <label for="image" class="text-center text-sm font-medium text-gray-900 basis-1/6 my-2">image</label>
                                    <input type="file" name="image" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <div class="items-center py-6 border-gray-200 rounded-b">
                                    <button class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save news</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        if ($("#dd_city").length > 0) {
            $("#dd_city").select2({
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