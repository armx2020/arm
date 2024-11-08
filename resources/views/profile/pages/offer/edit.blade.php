@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row mx-auto my-10">

    <x-nav-profile page="myoffers"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <form method="post" action="{{ route('myoffers.update', ['myoffer' => $offer->id ]) }}" class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input name="image_r" type="text" id="image_r" class="hidden" style="z-index:-10;" />
                    <input name="image_r1" type="text" id="image_r1" class="hidden" style="z-index:-10;" />
                    <input name="image_r2" type="text" id="image_r2" class="hidden" style="z-index:-10;" />
                    <input name="image_r3" type="text" id="image_r3" class="hidden" style="z-index:-10;" />
                    <input name="image_r4" type="text" id="image_r4" class="hidden" style="z-index:-10;" />

                    <div class="w-full">
                        <h2 class="text-xl">Редактировать товар</h2>
                        <hr class="w-full h-2 my-2">
                    </div>

                    <div class="flex flex-row">

                        <!-- image  -->
                        <div class="flex flex-row" id="image-section">
                            <div class="flex relative">
                                @if( $offer->image == null)
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ url('/image/no-image.png')}}" alt="image">
                                @else
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" src="{{ asset('storage/'. $offer->image) }}" alt="image">
                                @endif
                                <button type="button" id="remove_image" class="absolute top-5 right-5" @if( $offer->image !== null && $offer->image1 == null )
                                    style="display: block;"
                                    @else
                                    style="display: none;"
                                    @endif><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                            </div>
                            <div class="items-center" id="title_image" @if( $offer->image == null)
                                style="display: flex;"
                                @else
                                style="display: none;"
                                @endif>
                                <label class="relative inline-block">
                                    <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span id="image_span" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 1 -->
                        <div class="flex-row" id="image1-section" @if( $offer->image == null)
                            style="display: none;"
                            @else
                            style="display: flex;"
                            @endif>
                            <div class="flex relative">
                                @if( $offer->image1 == null)
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img1" src="{{ url('/image/no-image.png')}}" alt="image">
                                @else
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img1" src="{{ asset('storage/'. $offer->image1) }}" alt="image">
                                @endif
                                <button type="button" id="remove_image1" class="absolute top-5 right-5" @if( $offer->image1 !== null && $offer->image2 == null )
                                    style="display: block;"
                                    @else
                                    style="display: none;"
                                    @endif><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                            </div>
                            <div class="items-center" id="title_image1" @if( $offer->image1 == null)
                                style="display: flex;"
                                @else
                                style="display: none;"
                                @endif>
                                <label class="relative inline-block">
                                    <input name="image1" type="file" accept=".jpg,.jpeg,.png" id="image1" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span id="image_span1" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 2 -->
                        <div class="flex-row" id="image2-section" @if( $offer->image1 == null)
                            style="display: none;"
                            @else
                            style="display: flex;"
                            @endif>
                            <div class="flex relative">
                                @if( $offer->image2 == null)
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img2" src="{{ url('/image/no-image.png')}}" alt="image">
                                @else
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img2" src="{{ asset('storage/'. $offer->image2) }}" alt="image">
                                @endif
                                <button type="button" id="remove_image2" class="absolute top-5 right-5" @if( $offer->image2 !== null && $offer->image3 == null )
                                    style="display: block;"
                                    @else
                                    style="display: none;"
                                    @endif><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                            </div>
                            <div class="items-center" id="title_image2" @if( $offer->image2 == null)
                                style="display: flex;"
                                @else
                                style="display: none;"
                                @endif>
                                <label class="relative inline-block">
                                    <input name="image2" type="file" accept=".jpg,.jpeg,.png" id="image2" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span id="image_span2" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 3 -->
                        <div class="flex-row" id="image3-section" @if( $offer->image2 == null)
                            style="display: none;"
                            @else
                            style="display: flex;"
                            @endif>
                            <div class="flex relative">
                                @if( $offer->image3 == null)
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img3" src="{{ url('/image/no-image.png')}}" alt="image">
                                @else
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img3" src="{{ asset('storage/'. $offer->image3) }}" alt="image">
                                @endif
                                <button type="button" id="remove_image3" class="absolute top-5 right-5" @if( $offer->image3 !== null && $offer->image4 == null )
                                    style="display: block;"
                                    @else
                                    style="display: none;"
                                    @endif><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                            </div>
                            <div class="items-center" id="title_image3" @if( $offer->image3 == null)
                                style="display: flex;"
                                @else
                                style="display: none;"
                                @endif>
                                <label class="relative inline-block">
                                    <input name="image3" type="file" accept=".jpg,.jpeg,.png" id="image3" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span id="image_span3" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 4 -->
                        <div class="flex-row" id="image4-section" @if( $offer->image3 == null)
                            style="display: none;"
                            @else
                            style="display: flex;"
                            @endif>
                            <div class="flex relative">
                                @if( $offer->image4 == null)
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img4" src="{{ url('/image/no-image.png')}}" alt="image">
                                @else
                                <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img4" src="{{ asset('storage/'. $offer->image4) }}" alt="image">
                                @endif
                                <button type="button" id="remove_image4" class="absolute top-5 right-5" @if( $offer->image4 !== null)
                                    style="display: block;"
                                    @else
                                    style="display: none;"
                                    @endif><img src="{{ url('/image/remove.png')}}" class="w-5 h-5" style="cursor:pointer;"></button>
                            </div>
                            <div class="flex items-center" id="title_image4">
                                <label class="relative inline-block">
                                    <input name="image4" type="file" accept=".jpg,.jpeg,.png" id="image4" class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span id="image_span4" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="my-3">
                        <x-input-label for="name" :value="__('Название*')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $offer->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="address" :value="__('Адрес')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $offer->address)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $offer->description)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="my-3">
                        <x-input-label for="price" :value="__('Цена')" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $offer->price)" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <div class="my-3">
                        <label for="company" class="text-sm font-medium text-gray-900 block mb-2">Компания</label>
                        <select name="company" id="company" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="{{ $offer->company->id }}"> {{ $offer->company->name }}
                                @foreach( $companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="cstegory" class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
                        <select name="category" id="category" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="{{ $offer->category->id }}">{{ $offer->category->name }}</option>
                            @foreach( $categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-4 my-6">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                <form method="post" action="{{ route('myoffers.destroy', ['myoffer' => $offer->id]) }}" class="w-full text-center">
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
                $('#image_r').val('delete');
                return;
            } else {
                let file = this.files[0];
                $('#image_span').html(file.name);
                $('#image_r').val('');
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
            $('#image_r').val('delete');
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
                $('#image_r1').val('delete');
                return;
            } else {
                let file = this.files[0];
                $('#image_span1').html(file.name);
                $('#image_r4').val('');
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
            $('#image_r1').val('delete');
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
                $('#image_r2').val('delete');
                return;
            } else {
                let file = this.files[0];
                $('#image_span2').html(file.name);
                $('#image_r2').val('delete');
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
            $('#image_r2').val('delete');
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
                $('#image_r3').val('delete');
                return;
            } else {
                let file = this.files[0];
                $('#image_span3').html(file.name);
                $('#image_r3').val('');
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
            $('#image_r3').val('delete');
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
                $('#image_r4').val('delete');
                return;
            } else {
                let file = this.files[0];
                $('#image_span4').html(file.name);
                $('#image_r4').val('');
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
            $('#image_r4').val('delete');
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