@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="myoffers"></x-nav-profile>

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
            @foreach($company->offers as $offer)
            <div class="block rounded-lg bg-white h-80">
                <a href="{{ route('myoffers.show', ['myoffer' => $offer->id ]) }}" class="block h-52">
                    @if( $offer->image == null )
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                    @else
                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$offer->image) }}" alt="image">
                    @endif
                </a>
                <div class="px-6">
                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                        {{ $offer->name }} ({{ $company->name }})
                    </h5>
                    <hr class="my-2">
                    <div class="my-4 break-all text-base text-right">
                        <p class="mx-3 inline">{{ $offer->price }} {{ $offer->unit_of_price }}</p>
                        <a href="{{ route('myoffers.edit', ['myoffer' => $offer->id]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
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

            <button id="add_product" class="h-80 items-center justify-center flex rounded-lg border-dashed border-2 border-indigo-600 hover:bg-white">
                <div class="flex flex-col w-full items-center">
                    <div class="text-9xl text-indigo-600 flex mx-auto leading-none">+</div>
                    <div class="text-xl text-indigo-600 flex mx-auto uppercase">Добавить товар</div>
                </div>
            </button>
        </div>
    </div>

    <div id="add_product_form" class="hidden fixed inset-0 px-4 min-h-screen sm:px-0 z-50" focusable>
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        <div class="my-3 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full md:w-10/12 lg:w-8/12 ">
            <form method="post" action="{{ route('myoffers.store') }}" class="px-6 py-3" enctype="multipart/form-data">
                @csrf

                <h2 class="text-lg font-medium text-center text-gray-900">
                    {{ __('Новый товар') }}
                </h2>

                <div class="flex flex-row">

                    <!-- image  -->
                    <div class="flex flex-row" id="image-section">
                        <div class="flex relative">
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ url('/image/no-image.png')}}" alt="image">
                            <button type="button" id="remove_image" class="absolute top-5 right-5 hidden"><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                        </div>
                        <div class="flex items-center" id="title_image">
                            <label class="relative inline-block">
                                <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span id="image_span" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>

                    <!-- image 1 -->
                    <div class="hidden flex-row" id="image1-section">
                        <div class="flex relative">
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img1" src="{{ url('/image/no-image.png')}}" alt="image">
                            <button type="button" id="remove_image1" class="absolute top-5 right-5 hidden"><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                        </div>
                        <div class="flex items-center" id="title_image1">
                            <label class="relative inline-block">
                                <input name="image1" type="file" accept=".jpg,.jpeg,.png" id="image1" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span id="image_span1" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>

                    <!-- image 2 -->
                    <div class="hidden flex-row" id="image2-section">
                        <div class="flex relative">
                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img2" src="{{ url('/image/no-image.png')}}" alt="image">
                            <button type="button" id="remove_image2" class="absolute top-5 right-5 hidden"><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                        </div>
                        <div class="flex items-center" id="title_image2">
                            <label class="relative inline-block">
                                <input name="image2" type="file" accept=".jpg,.jpeg,.png" id="image2" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span id="image_span2" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>

                    <!-- image 3 -->
                    <div class="hidden flex-row" id="image3-section">
                        <div class="flex relative">
                            <img class="preview h-20 w-20 rounded-lg m-4 object-cover" id="img3" src="{{ url('/image/no-image.png')}}" alt="image">
                            <button type="button" id="remove_image3" class="absolute top-5 right-5 hidden"><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                        </div>
                        <div class="flex items-center" id="title_image3">
                            <label class="relative inline-block">
                                <input name="image3" type="file" accept=".jpg,.jpeg,.png" id="image3" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span id="image_span3" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>

                    <!-- image 4 -->
                    <div class="hidden flex-row" id="image4-section">
                        <div class="flex relative">
                            <img class="preview h-20 w-20 rounded-lg m-4 object-cover" id="img4" src="{{ url('/image/no-image.png')}}" alt="image">
                            <button type="button" id="remove_image4" class="absolute top-5 right-5 hidden"><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                        </div>
                        <div class="flex items-center" id="title_image4">
                            <label class="relative inline-block">
                                <input name="image4" type="file" accept=".jpg,.jpeg,.png" id="image4" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                <span id="image_span4" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                            </label>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="my-3">
                    <x-input-label for="name" :value="__('Название*')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="my-3">
                    <x-input-label for="address" :value="__('Адрес')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <div class="my-3">
                    <x-input-label for="description" :value="__('Описание')" />
                    <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div class="my-3">
                    <x-input-label for="price" :value="__('Цена')" />
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price') ? old('price') : 0" min="0" max="999999999" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                </div>

                <div class="my-3">
                    <label for="company" class="text-sm font-medium text-gray-900 block mb-2">Компания</label>
                    <select name="company" id="company" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                        @foreach( $companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="my-3">
                    <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
                    <select name="category" id="category" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                        @foreach( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button id="confirm-user-deletion-close" x-on:click="$dispatch('close')">
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
        $("#add_product").click(function() {
            $("#add_product_form").toggle();
        });
        $("#confirm-user-deletion-close").click(function() {
            $("#add_product_form").toggle();
        });
        $('#image').on('change', function(event) {
            var selectedFile = event.target.files[0];
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('#image_span').html('максимальный размер 2 мб');
                $('#image_span').css({
                    "color": "rgb(239 68 68)"
                });
                $('#image').val('');
                return;
            } else {
                let file = this.files[0];
                $('#image_span').html(file.name);
                $('#image_span').css({
                    "color": "rgb(71 85 105)"
                });
                $('#image1-section').css({
                    "display": "flex",
                    "flex-direction": "row"
                });
                $('#remove_image').css({
                    "display": "block"
                });
                $('#title_image').css({
                    "display": "none"
                });

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
            $('#img').attr('src', `{{ url('/image/no-image.png')}}`);
            $('#image_span').html('Выберите файл');
            $('#image1-section').css({
                "display": "none"
            });
            $('#remove_image').css({
                "display": "none"
            });
            $('#title_image').css({
                "display": "flex"
            });
        })
        $('#image1').on('change', function(event) {
            var selectedFile = event.target.files[0];
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('#image_span1').html('максимальный размер 2 мб');
                $('#image_span1').css({
                    "color": "rgb(239 68 68)"
                });
                $('#image1').val('');
                return;
            } else {
                let file = this.files[0];
                $('#image_span1').html(file.name);
                $('#image_span1').css({
                    "color": "rgb(71 85 105)"
                });
                $('#image2-section').css({
                    "display": "flex",
                    "flex-direction": "row"
                });
                $('#remove_image').css({
                    "display": "none"
                });
                $('#remove_image1').css({
                    "display": "block"
                });
                $('#title_image1').css({
                    "display": "none"
                });

                // Display file preview
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img1').attr('src', event.target.result);
                };
                reader.readAsDataURL(selectedFile);
                return;
            }
        });
        $('#remove_image1').on('click', function() {
            $('#image1').val('');
            $('#img1').attr('src', `{{ url('/image/no-image.png')}}`);
            $('#image_span1').html('Выберите файл');
            $('#image2-section').css({
                "display": "none"
            });
            $('#image1-section').css({
                "display": "flex",
                "flex-direction": "row"
            });
            $('#remove_image1').css({
                "display": "none"
            });
            $('#remove_image').css({
                "display": "block"
            });
            $('#title_image1').css({
                "display": "flex"
            });
        })
        $('#image2').on('change', function(event) {
            var selectedFile = event.target.files[0];
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('#image_span2').html('максимальный размер 2 мб');
                $('#image_span2').css({
                    "color": "rgb(239 68 68)"
                });
                $('#image2').val('');
                return;
            } else {
                let file = this.files[0];
                $('#image_span2').html(file.name);
                $('#image_span2').css({
                    "color": "rgb(71 85 105)"
                });
                $('#image3-section').css({
                    "display": "flex",
                    "flex-direction": "row"
                });
                $('#remove_image1').css({
                    "display": "none"
                });
                $('#remove_image2').css({
                    "display": "block"
                });
                $('#title_image2').css({
                    "display": "none"
                });

                // Display file preview
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img2').attr('src', event.target.result);
                };
                reader.readAsDataURL(selectedFile);
                return;
            }
        });
        $('#remove_image2').on('click', function() {
            $('#image2').val('');
            $('#img2').attr('src', `{{ url('/image/no-image.png')}}`);
            $('#image_span2').html('Выберите файл');
            $('#image3-section').css({
                "display": "none"
            });
            $('#image2-section').css({
                "display": "flex",
                "flex-direction": "row"
            });
            $('#remove_image2').css({
                "display": "none"
            });
            $('#remove_image1').css({
                "display": "block"
            });
            $('#title_image2').css({
                "display": "flex"
            });
        })
        $('#image3').on('change', function(event) {
            var selectedFile = event.target.files[0];
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('#image_span3').html('максимальный размер 2 мб');
                $('#image_span3').css({
                    "color": "rgb(239 68 68)"
                });
                $('#image3').val('');
                return;
            } else {
                let file = this.files[0];
                $('#image_span3').html(file.name);
                $('#image_span3').css({
                    "color": "rgb(71 85 105)"
                });
                $('#image4-section').css({
                    "display": "flex",
                    "flex-direction": "row"
                });
                $('#remove_image2').css({
                    "display": "none"
                });
                $('#remove_image3').css({
                    "display": "block"
                });
                $('#title_image3').css({
                    "display": "none"
                });

                // Display file preview
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img3').attr('src', event.target.result);
                };
                reader.readAsDataURL(selectedFile);
                return;
            }
        });
        $('#remove_image3').on('click', function() {
            $('#image3').val('');
            $('#img3').attr('src', `{{ url('/image/no-image.png')}}`);
            $('#image_span3').html('Выберите файл');
            $('#image4-section').css({
                "display": "none"
            });
            $('#image3-section').css({
                "display": "flex",
                "flex-direction": "row"
            });
            $('#remove_image3').css({
                "display": "none"
            });
            $('#remove_image2').css({
                "display": "block"
            });
            $('#title_image3').css({
                "display": "flex"
            });
        })
        $('#image4').on('change', function(event) {
            var selectedFile = event.target.files[0];
            var fileSize = selectedFile.size;
            var maxSize = 2000000; // 2 mb
            if (fileSize > maxSize) {
                $('#image_span4').html('максимальный размер 2 мб');
                $('#image_span4').css({
                    "color": "rgb(239 68 68)"
                });
                $('#image4').val('');
                return;
            } else {
                let file = this.files[0];
                $('#image_span4').html(file.name);
                $('#image_span4').css({
                    "color": "rgb(71 85 105)"
                });
                $('#remove_image3').css({
                    "display": "none"
                });
                $('#remove_image4').css({
                    "display": "block"
                });

                // Display file preview
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img4').attr('src', event.target.result);
                };
                reader.readAsDataURL(selectedFile);
                return;
            }
        });
        $('#remove_image4').on('click', function() {
            $('#image4').val('');
            $('#img4').attr('src', `{{ url('/image/no-image.png')}}`);
            $('#image_span4').html('Выберите файл');
            $('#image4-section').css({
                "display": "flex",
                "flex-direction": "row"
            });
            $('#remove_image4').css({
                "display": "none"
            });
            $('#remove_image3').css({
                "display": "block"
            });
            $('#title_image4').css({
                "display": "flex"
            });
        })
    });
</script>
@endsection