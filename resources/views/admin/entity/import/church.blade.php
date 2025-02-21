@extends('admin.layouts.app')
@section('content')
    <div>
        <div class="py-6 px-4 xl:pl-10 xl:pr-0 max-w-7xl mx-auto rounded-t-lg">
            <x-admin.alert />

            <div class="p-4 bg-white block shadow sm:flex items-center justify-between border-b border-gray-200">
                <div class="my-3 w-full">
                    <div class="mb-4">
                        <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">
                            Добавить сущность
                        </h1>
                    </div>
                    <div class="flex flex-row ">
                        <div class="container w-full justify-between">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.import.church') }}" method="POST" enctype="multipart/form-data" class="w-full">
                                @csrf
                                <div class="flex flex-row w-full justify-between">
                                    <input type="file" name="file" id="file" class="form-control">
                                    <button type="submit"
                                        class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-2 py-1 lg:px-3 lg:py-2 text-center sm:w-auto">Import</button>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
