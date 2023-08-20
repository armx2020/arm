@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="myworks"></x-nav-profile>

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

        <div class="w-full my-3">
            <h2 class="text-xl">МОИ РЕЗЮМЕ</h2>
            <hr class="w-full h-2 my-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5 w-full">

            @foreach($resumes as $resume)
            <div class="block rounded-lg bg-white h-80">
                <a href="{{ route('myresume.show', ['myresume' => $resume->id ]) }}" class="block h-52">
                    @if( $resume->user->image == null )
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/user.png')}}" alt="image" />
                    @else
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$resume->user->image) }}" alt="image">
                    @endif
                </a>
                <div class="px-6">
                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                        {{ $resume->name }}
                    </h5>
                    <hr class="my-2">
                    <div class="my-4 break-all text-base text-right">
                        <p class="mx-3 inline text-md font-bold">
                            @if($resume->price !== 0)
                            {{ $resume->price }} RUB.
                            @else
                            no price
                            @endif
                        </p>
                        <a href="{{ route('myresume.edit', ['myresume' => $resume->id ]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <button id="add_resume" class="h-80 block rounded-lg border-dashed border-2 border-indigo-600 hover:bg-white">
                <div class="flex flex-col">
                    <div class="text-9xl text-indigo-600 flex mx-auto leading-none">+</div>
                    <div class="text-xl text-indigo-600 flex mx-auto uppercase">Добавить резюме</div>
                </div>
            </button>

        </div>

        <div id="add_resume_form" class="hidden fixed inset-0 px-4 min-h-screen sm:px-0 z-50" focusable>
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="my-16 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full md:max-w-md lg:max-w-lg ">
                <form method="post" action="{{ route('myresume.store') }}" class="p-6" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-lg font-medium text-center text-gray-900">
                        {{ __('Новое резюме') }}
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

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button id="confirm-resume-deletion-close">
                            {{ __('Отменить') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('Добавить') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full my-3 mt-10">
            <h2 class="text-xl">МОИ ВАКАНСИИ</h2>
            <hr class="w-full h-2 my-2">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5 w-full">

            @foreach($companies as $company)
            @foreach($company->vacancies as $vacancy)
            <div class="block rounded-lg bg-white h-80">
                <a href="{{ route('myvacancy.show', ['myvacancy' => $vacancy->id ]) }}" class="block h-52">
                    @if( $vacancy->parent->image == null )
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                    @else
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$vacancy->parent->image) }}" alt="image">
                    @endif
                </a>
                <div class="px-6">
                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                        {{$vacancy->name }} ({{ $company->name }})
                    </h5>
                    <hr class="my-2">
                    <div class="my-4 break-all text-base text-right">
                    <p class="mx-3 inline text-md font-bold">
                            @if($vacancy->price !== null && $vacancy->price !== 0)
                            {{ $vacancy->price }} RUB.
                            @else
                            no price
                            @endif
                        </p>
                        <a href="{{ route('myvacancy.edit', ['myvacancy' => $vacancy->id ]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach

            @foreach($groups as $group)
            @foreach($group->vacancies as $vacancy)
            <div class="block rounded-lg bg-white h-80">
                <a href="{{ route('myvacancy.show', ['myvacancy' => $vacancy->id ]) }}" class="block h-52">
                    @if( $vacancy->parent->image == null )
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                    @else
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$vacancy->parent->image) }}" alt="image">
                    @endif
                </a>
                <div class="px-6">
                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                        {{$vacancy->name }} ({{ $group->name }})
                    </h5>
                    <hr class="my-2">
                    <div class="my-4 break-all text-base text-right">
                    <p class="mx-3 inline text-md font-bold">
                            @if($vacancy->price !== null && $vacancy->price !== 0)
                            {{ $vacancy->price }} RUB.
                            @else
                            no price
                            @endif
                        </p>
                        <a href="{{ route('myvacancy.edit', ['myvacancy' => $vacancy->id ]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach

            @foreach($vacancies as $vacancy)
            <div class="block rounded-lg bg-white h-80">
                <a href="{{ route('myvacancy.show', ['myvacancy' => $vacancy->id ]) }}" class="block h-52">
                    @if( $vacancy->parent->image == null )
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                    @else
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$vacancy->parent->image) }}" alt="image">
                    @endif
                </a>
                <div class="px-6">
                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                        {{$vacancy->name }}
                    </h5>
                    <hr class="my-2">
                    <div class="my-4 break-all text-base text-right">
                    <p class="mx-3 inline text-md font-bold">
                            @if($vacancy->price !== null && $vacancy->price !== 0)
                            {{ $vacancy->price }} RUB.
                            @else
                            no price
                            @endif
                        </p>
                        <a href="{{ route('myvacancy.edit', ['myvacancy' => $vacancy->id ]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <button id="add_vacancy" class="h-80 block rounded-lg border-dashed border-2 border-indigo-600 hover:bg-white">
                <div class="flex flex-col">
                    <div class="text-9xl text-indigo-600 flex mx-auto leading-none">+</div>
                    <div class="text-xl text-indigo-600 flex mx-auto uppercase">Добавить вакансию</div>
                </div>
            </button>

        </div>

        <div id="add_vacancy_form" class="hidden fixed inset-0 px-4 min-h-screen sm:px-0 z-50" focusable>
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="my-16 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full md:max-w-md lg:max-w-lg ">
                <form method="post" action="{{ route('myvacancy.store') }}" class="p-6" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-lg font-medium text-center text-gray-900">
                        {{ __('Новоя вакансия') }}
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
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('description')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="price" :value="__('Зарплата')" />
                        <x-text-input id="price" name="price" min="0" type="number" class="mt-1 block w-full" :value="old('price', 0)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    
                    <div class="my-2">
                        <label for="parent" class="text-sm font-medium text-gray-900 block mb-2">Инициатор</label>
                        <select name="parent" id="oarent" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
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

                    <div class="my-2">
                        <label for="vacancy_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="vacancy_city" class="w-full" style="border-color: rgb(209 213 219); width:100%" id="vacancy_city">
                            <option value='{{ Auth::user()->city->id }}'>{{ Auth::user()->city->name }}</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button id="confirm-vacancy-deletion-close">
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

</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $("#add_resume").click(function() {
            $("#add_resume_form").toggle();
        });
        $("#confirm-resume-deletion-close").click(function() {
            $("#add_resume_form").toggle();
        });
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
        $("#add_vacancy").click(function() {
            $("#add_vacancy_form").toggle();
        });
        $("#confirm-vacancy-deletion-close").click(function() {
            $("#add_vacancy_form").toggle();
        });
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