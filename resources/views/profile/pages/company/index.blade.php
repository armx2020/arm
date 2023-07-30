@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="mycompanies"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        @if(session('alert'))
        <div class="mb-4 flex basis-full bg-yellow-100 rounded-lg px-6 py-5 text-base text-yellow-700" role="alert" style="max-height:64px;">
            {{ session('alert')}}
        </div>
        @endif
        @if(session('success'))
        <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert" style="max-height:64px;">
            {{ session('success')}}
        </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5 w-full">

            @foreach($companies as $company)
            <div class="block rounded-lg bg-white h-80">
                <a href="{{ route('mycompany.show', ['id' => $company->id ]) }}" class="block h-52">
                    @if( $company->image == null )
                    <img class="h-48 rounded-lg mx-auto p-16" src="{{ url('/image/no-image.png')}}" alt="image" />
                    @else
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$company->image) }}" alt="image">
                    @endif
                </a>
                <div class="px-6">
                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                        {{ $company->name }}
                    </h5>
                    <hr class="my-2">
                    <div class="my-1 break-all text-base text-right">
                        <a href="{{ route('mycompany.edit', ['id' => $company->id]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                        <form method="post" action="{{ route('mycompany.destroy', ['id' => $company->id]) }}" class="inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-100 hover:bg-red-400 rounded-md py-2 pl-2 pr-2 m-1" title="удалить">
                                <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 140.172 140.172" style="enable-background:new 0 0 140.172 140.172;" xml:space="preserve">
                                    <g>
                                        <g id="_x36_4._Trash">
                                            <g>
                                                <path d="M70.086,112.138c3.867,0,7.009-3.142,7.009-7.009V49.06c0-3.869-3.142-7.008-7.009-7.008     c-3.869,0-7.008,3.14-7.008,7.008v56.069C63.078,108.996,66.217,112.138,70.086,112.138z M126.155,14.017h-21.026V7.009     C105.129,3.14,101.987,0,98.12,0H42.052c-3.869,0-7.008,3.14-7.008,7.009v7.008H14.018c-3.872,0-7.009,3.14-7.009,7.009     s3.137,7.008,7.009,7.008v98.12c0,7.741,6.276,14.018,14.017,14.018h84.103c7.741,0,14.018-6.276,14.018-14.018v-98.12     c3.867,0,7.008-3.14,7.008-7.008S130.022,14.017,126.155,14.017z M112.138,126.154H28.035v-98.12h84.103V126.154z      M49.061,112.138c3.869,0,7.008-3.142,7.008-7.009V49.06c0-3.869-3.14-7.008-7.008-7.008s-7.009,3.14-7.009,7.008v56.069     C42.052,108.996,45.192,112.138,49.061,112.138z M91.112,112.138c3.867,0,7.008-3.142,7.008-7.009V49.06     c0-3.869-3.141-7.008-7.008-7.008s-7.009,3.14-7.009,7.008v56.069C84.104,108.996,87.245,112.138,91.112,112.138z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <button id="add_company" class="h-80 block rounded-lg border-dashed border-2 border-indigo-600 hover:bg-white">
                <div class="flex flex-col">
                    <div class="text-9xl text-indigo-600 flex mx-auto leading-none">+</div>
                    <div class="text-xl text-indigo-600 flex mx-auto uppercase">Добавить компанию</div>
                </div>
            </button>
        </div>
    </div>

    <div id="add_company_form" class="hidden fixed inset-0 px-4 min-h-screen sm:px-0 z-50" focusable>
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        <div class="my-16 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full md:max-w-md lg:max-w-lg ">
            <form method="post" action="{{ route('mycompany.store') }}" class="p-6" enctype="multipart/form-data">
                @csrf

                <h2 class="text-lg font-medium text-center text-gray-900">
                    {{ __('Новая компания') }}
                </h2>

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
                    <x-input-label for="phone" :value="__('Телефон')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <div class="my-2">
                    <label for="image" class="text-center text-sm font-medium text-gray-900 basis-1/6 my-2">Изображение</label>
                    <input type="file" name="image" id="image" class="shadow-sm sm:text-sm focus:ring-cyan-600 focus:border-cyan-600 block basis-full">
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="my-2">
                    <label for="company_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                    <select name="company_city" class="w-full" style="border-color: rgb(209 213 219); width:100%" id="company_city">
                        <option value='{{ Auth::user()->city->id }}'>{{ Auth::user()->city->name }}</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button id="confirm-user-deletion-close">
                        {{ __('Отменить') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Добавить') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>

</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $("#add_company").click(function() {
            $("#add_company_form").toggle();
        });
        $("#confirm-user-deletion-close").click(function() {
            $("#add_company_form").toggle();
        });
        if ($("#company_city").length > 0) {
            $("#company_city").select2({
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