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
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">Edit {{ $experience->name }}</h3>
                                    </div>

                                </div>

                                <div class="p-6 space-y-6">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.experience.update', ['experience'=> $experience->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                                <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Name*</label>
                                                <input type="text" name="name" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required autofocus autocomplete="name" value="{{ $experience->name }}">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Description*</label>
                                                <input type="text" name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $experience->description }}" required autofocus autocomplete="description">
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="start_worktime" class="text-sm font-medium text-gray-900 block mb-2">Start worktime*</label>
                                                <input type="date" name="start_worktime" id="start_worktime" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $experience->start_worktime }}" required autofocus>
                                                <x-input-error :messages="$errors->get('start_worktime')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="end_worktime" class="text-sm font-medium text-gray-900 block mb-2">End worktime*</label>
                                                <input type="date" name="end_worktime" id="end_worktime" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $experience->end_worktime }}" required autofocus>
                                                <x-input-error :messages="$errors->get('end_worktime')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="resume_id" class="text-sm font-medium text-gray-900 block mb-2">Resume*</label>
                                                <select name="resume_id" id="resume_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                    @foreach( $resumes as $resume)
                                                    <option value="{{ $resume->id }}">{{ $resume->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="items-center p-6 border-gray-200 rounded-b">
                                            <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save experience</button>
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