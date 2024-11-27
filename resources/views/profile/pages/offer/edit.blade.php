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
                                    <span id="image_span" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл или перетащите сюда</span>
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
                                    <span id="image_span1" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл или перетащите сюда</span>
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
                                    <span id="image_span2" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл или перетащите сюда</span>
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
                                    <span id="image_span3" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл или перетащите сюда</span>
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
                                    <span id="image_span4" class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600" style="cursor:pointer;">Выберите файл или перетащите сюда</span>
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
                        <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
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
        const maxSize = 2000000; // 2 MB

        function updatePreview(input, imgSelector, spanSelector, sectionSelector, removeBtnSelectorShow, removeBtnSelectorHide, nextSectionSelector) {
            const file = input.files[0];
            if (file.size > maxSize) {
                $(spanSelector).html('Максимальный размер 2 МБ').css("color", "rgb(239 68 68)");
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                $(imgSelector).attr('src', e.target.result);
            };
            reader.readAsDataURL(file);

            $(spanSelector).html(file.name).css("color", "rgb(71 85 105)");
            $(sectionSelector).css("display", "none");
            $(removeBtnSelectorHide).css("display", "none");
            $(removeBtnSelectorShow).css("display", "block");
            $(nextSectionSelector).css({ "display": "flex", "flex-direction": "row" });
        }

        function removeFile(inputSelector, imgSelector, spanSelector, sectionSelector, removeBtnSelectorShow, removeBtnSelectorHide, prevSectionSelector, imageDelete) {
            $(inputSelector).val('');
            $(imgSelector).attr('src', `{{ url('/image/no-image.png')}}`);
            $(spanSelector).html('Выберите файл или перетащите сюда').css("color", "rgb(71 85 105)");
            $(sectionSelector).css("display", "none");
            $(removeBtnSelectorHide).css("display", "none");
            $(imageDelete).val('delete');
            if(removeBtnSelectorShow){
                $(removeBtnSelectorShow).css("display", "block");
            }

            if (prevSectionSelector) {
                $(prevSectionSelector).css({ "display": "flex", "flex-direction": "row" });
            }
        }


        $('#image').on('change', function () {
            updatePreview(this, '#img', '#image_span', '#title_image', '#remove_image', null, '#image1-section');
        });

        $('#remove_image').on('click', function () {
            removeFile('#image', '#img', '#image_span', '#image1-section', null, '#remove_image', '#image-section, #title_image', '#image_r');
        });

        $('#image1').on('change', function () {
            updatePreview(this, '#img1', '#image_span1', '#title_image1', '#remove_image1', '#remove_image', '#image2-section');
        });
        $('#remove_image1').on('click', function () {
            removeFile('#image1', '#img1', '#image_span1', '#image2-section', '#remove_image', '#remove_image1', '#image1-section, #title_image1', '#image_r1');
        });

        $('#image2').on('change', function () {
            updatePreview(this, '#img2', '#image_span2', '#title_image2', '#remove_image2', '#remove_image1', '#image3-section');
        });
        $('#remove_image2').on('click', function () {
            removeFile('#image2', '#img2', '#image_span2', '#image3-section', '#remove_image1', '#remove_image2', '#image2-section, #title_image2', '#image_r2');
        });

        $('#image3').on('change', function () {
            updatePreview(this, '#img3', '#image_span3', '#title_image3', '#remove_image3', '#remove_image2', '#image4-section');
        });
        $('#remove_image3').on('click', function () {
            removeFile('#image3', '#img3', '#image_span3', '#image4-section', '#remove_image2', '#remove_image3', '#image3-section, #title_image3', '#image_r3');
        });

        $('#image4').on('change', function () {
            updatePreview(this, '#img4', '#image_span4', '#title_image4', '#remove_image4', '#remove_image3', null);
        });
        $('#remove_image4').on('click', function () {
            removeFile('#image4', '#img4', '#image_span4', null, '#remove_image3', '#remove_image4', '#image4-section, #title_image4', '#image_r4');
        });


        ['#image-section', '#image1-section', '#image2-section', '#image3-section', '#image4-section'].forEach(function (sectionId) {
            const dropArea = $(sectionId);

            dropArea.on('dragover', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('bg-slate-100');
            });

            dropArea.on('dragleave', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('bg-slate-100');
            });

            dropArea.on('drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('bg-slate-100');

                const files = e.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    const currentInput = $(this).find('input[type="file"]:visible').get(0);
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(files[0]);
                    currentInput.files = dataTransfer.files;
                    $(currentInput).trigger('change');
                }
            });
        });
    });
</script>
@endsection
