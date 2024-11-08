@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row mx-auto my-10">

    <x-nav-profile page="myprojects"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('myprojects.update', ['myproject' => $project->id]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input name="image_r" type="text" id="image_r" class="hidden" style="z-index:-10;" />

                    <div class="w-full">
                        <h2 class="text-xl">Редактировать проект</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="flex flex-row">
                        <div class="flex relative">
                            @if( $project->image == null)
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ url('/image/no-image.png')}}" alt="image">
                            @else
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ asset('storage/'. $project->image) }}" alt="image">
                            @endif
                            <button type="button" id="remove_image" class="absolute top-5 right-5" @if( $project->image == null)
                                style="display: none;"
                                @else
                                style="display: block;"
                                @endif
                                ><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;">
                            </button>
                        </div>

                        <div class="flex items-center">
                            <label class="input-file relative inline-block">
                                <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $project->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $project->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $project->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="donations_need" :value="__('Нужно средств')" />
                        <x-text-input id="donations_need" name="donations_need" type="number" class="mt-1 block w-full" value="{{ $project->donations_need }}" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('donations_need')" />
                    </div>

                    <div class="my-2">
                        <x-input-label for="donations_have" :value="__('Имеються средств')" />
                        <x-text-input id="donations_have" name="donations_have" type="number" class="mt-1 block w-full" value="{{ $project->donations_have }}" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('donations_have')" />
                    </div>

                    <div class="my-3">
                        <label for="parent" class="text-sm font-medium text-gray-900 block mb-2">Инициатор</label>
                        <select name="parent" id="parent" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option 
                            @if($project->parent_type == 'App\Models\User')
                            value="User|{{ $project->parent->id }}"
                            @elseif ($project->parent_type == 'App\Models\Company')
                            value="Company|{{ $project->parent->id }}"
                            @else ($project->parent_type == 'App\Models\Group')
                            value="Group|{{ $project->parent->id }}"
                            @endif
                            > {{ $project->parent->name ? $project->parent->name : $project->parent->firstname }} {{  $project->parent->lastname }}</option>
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
                        <label for="project_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                        <select name="project_city" class="w-full" style="border-color: rgb(209 213 219)" id="project_city">
                            <option value='{{ $project->city->id }}'>{{ $project->city->name }}</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-5">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>
            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                <form method="post" action="{{ route('myprojects.destroy', ['myproject' => $project->id]) }}" class="w-full text-center">
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
        if ($("#project_city").length > 0) {
            $("#project_city").select2({
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
        $('#image').on('change', function(event) {
            var selectedFile = event.target.files[0];

            // Check file size (in bytes)
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('.input-file input[type=file]').next().html('максимальный размер 2 мб');
                $('.input-file input[type=file]').next().css({
                    "color": "rgb(239 68 68)"
                });
                $('#image').val('');
                $('#image_r').val('');
                $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
                $('#remove_image').css({
                    "display": "none"
                });
                return;
            } else {
                let file = this.files[0];
                $('.input-file input[type=file]').next().html(file.name);
                $(this).next().css({
                    "color": "rgb(71 85 105)"
                });
                $('#remove_image').css({
                    "display": "block"
                });
                $('#image_r').val('');

                // Display file preview
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img').attr('src', event.target.result);

                };
                reader.readAsDataURL(selectedFile);
                return;
            }
        });
        $('#remove_image').on('click', function() {
            $('#image').val('');
            $('#image_r').val('delete');
            $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
            $('.input-file input[type=file]').next().html('Выберите файл');
            $('#remove_image').css({
                "display": "none"
            });
        });
    });
</script>
@endsection