@extends('layouts.app')
@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">

        <x-nav-profile page="myoffers"></x-nav-profile>

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            @if (session('alert'))
                <div class="mb-4 flex basis-full bg-yellow-100 rounded-lg px-6 py-5 text-base text-yellow-700" role="alert"
                    style="max-height:64px;">
                    {{ session('alert') }}
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert"
                    style="max-height:64px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5 w-full">

                @foreach ($companies as $company)
                    @foreach ($company->offers as $offer)
                        <div class="block rounded-lg bg-white h-80 relative">
                            <a href="{{ route('myoffers.show', ['myoffer' => $offer->id]) }}" class="block h-52">
                                @if ($offer->image == null)
                                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                        src="{{ url('/image/no-image.png') }}" alt="image" />
                                @else
                                    <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                        src="{{ asset('storage/' . $offer->image) }}" alt="image">
                                @endif
                            </a>
                            <div class="px-2">
                                <a href="{{ route('myoffers.show', ['myoffer' => $offer->id]) }}">
                                    <h5
                                        class="mb-3 break-words text-base font-medium leading-tight text-neutral-800 text-ellipsis overflow-hidden text-nowrap">
                                        {{ mb_substr($offer->name, 0, 50, 'UTF-8') }}
                                        @if (mb_strlen($offer->name) > 50)
                                            ...
                                        @endif

                                        ({{ mb_substr($company->name, 0, 50, 'UTF-8') }}
                                        @if (mb_strlen($company->name) > 50)
                                            ...
                                        @endif)
                                    </h5>
                                </a>
                                <div class="absolute top-[18rem] right-[0.3rem]">
                                    <a href="{{ route('myoffers.edit', ['myoffer' => $offer->id]) }}"
                                        class="inline rounded-md p-1 my-1" title="редактировать">
                                        <svg class="inline" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                                            y="0px" width="16" height="16" viewBox="0 0 485.219 485.22"
                                            style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach

                <a href="{{ route('myoffers.create') }}"
                    class="h-80 items-center justify-center flex rounded-lg border-dashed border-2 border-indigo-600 hover:bg-white">
                    <div class="flex flex-col w-full items-center">
                        <div class="text-9xl text-indigo-600 flex mx-auto leading-none">+</div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <script type='text/javascript'>
        $(document).ready(function() {
            const maxSize = 2000000;

            const sections = [{
                    input: '#image',
                    img: '#img',
                    span: '#image_span',
                    remove: '#remove_image',
                    section: '#image-section'
                },
                {
                    input: '#image1',
                    img: '#img1',
                    span: '#image_span1',
                    remove: '#remove_image1',
                    section: '#image1-section'
                },
                {
                    input: '#image2',
                    img: '#img2',
                    span: '#image_span2',
                    remove: '#remove_image2',
                    section: '#image2-section'
                },
                {
                    input: '#image3',
                    img: '#img3',
                    span: '#image_span3',
                    remove: '#remove_image3',
                    section: '#image3-section'
                },
                {
                    input: '#image4',
                    img: '#img4',
                    span: '#image_span4',
                    remove: '#remove_image4',
                    section: '#image4-section'
                },
            ];

            function handleFileInput(file, index) {
                if (!file) return;

                const fileSize = file.size;
                const section = sections[index];
                const nextSection = sections[index + 1];

                if (fileSize > maxSize) {
                    $(section.span).html('Максимальный размер 2 МБ').css({
                        color: "rgb(239 68 68)"
                    });
                    return;
                }

                $(section.span).html(file.name).css({
                    color: "rgb(71 85 105)"
                });
                $(section.section).find('.flex.items-center').hide();

                sections.forEach((s, i) => {
                    if (i !== index) $(s.remove).hide();
                });

                $(section.remove).show();

                if (nextSection) {
                    $(nextSection.section).css({
                        display: "flex",
                        "flex-direction": "row"
                    });
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    $(section.img).attr('src', event.target.result);
                };
                reader.readAsDataURL(file);

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $(section.input)[0].files = dataTransfer.files;
            }

            function resetFileInput(index) {
                const section = sections[index];
                const prevSection = sections[index - 1];
                const nextSection = sections[index + 1];

                $(section.input).val('');
                $(section.img).attr('src', `{{ url('/image/no-image.png') }}`);
                $(section.span).html('Выберите файл или перетащите сюда').css({
                    color: "rgb(71 85 105)"
                });
                $(section.remove).hide();
                $(section.section).find('.flex.items-center').show();


                $(section.section).css({
                    display: "flex",
                    "flex-direction": "row"
                });

                if (nextSection) {
                    for (let i = index + 1; i < sections.length; i++) {
                        $(sections[i].section).hide();
                        $(sections[i].input).val('');
                        $(sections[i].img).attr('src', `{{ url('/image/no-image.png') }}`);
                        $(sections[i].span).html('Выберите файл или перетащите сюда').css({
                            color: "rgb(71 85 105)"
                        });
                        $(sections[i].remove).hide();
                    }
                }

                if (prevSection) {
                    $(prevSection.remove).show();
                }
            }

            function enableDragAndDrop(index) {
                const section = sections[index];

                $(section.section).on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).css('background-color', '#f1f5f9');
                });

                $(section.section).on('dragleave', function() {
                    $(this).css('background-color', '');
                });

                $(section.section).on('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).css('background-color', '');

                    const files = e.originalEvent?.dataTransfer?.files || [];
                    if (files.length > 0) {
                        handleFileInput(files[0], index);
                    }
                });
            }

            sections.forEach((section, index) => {
                $(section.input).on('change', function() {
                    handleFileInput(this.files[0], index);
                });

                $(section.remove).on('click', function() {
                    resetFileInput(index);
                });

                enableDragAndDrop(index);
            });
        });
    </script>
@endsection
