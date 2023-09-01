@extends('layouts.app')
@section('content')
<nav class="w-11/12 mb-2 mt-5 rounded-md mx-auto px-3 lg:px-2 text-sm md:text-md">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Главная</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li>
            <a href="{{ route('company.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Компании</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('company.show', ['id' => $company->id]) }}">
                {{ $company->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10">
            <div class="flex flex-col basis-1/5" @if( $company->image !== null && $company->image1 !== null)
                id="slider"
                @endif
                >
                <ul>
                    @if( $company->image == null )
                    <img src="{{ url('/image/no-image.png')}}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image" />
                    @else
                    <li><img src="{{ asset( 'storage/'.$company->image) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                    @endif

                    @if($company->image1)
                    <li><img src="{{ asset( 'storage/'.$company->image1) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image1"></li>
                    @endif

                    @if($company->image2)
                    <li><img src="{{ asset( 'storage/'.$company->image2) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image2"></li>
                    @endif

                    @if($company->image3)
                    <li><img src="{{ asset( 'storage/'.$company->image3) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image3"></li>
                    @endif

                    @if($company->image4)
                    <li><img src="{{ asset( 'storage/'.$company->image4) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image4"></li>
                    @endif
                </ul>
            </div>
            <div class="flex flex-col px-3 lg:px-10">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $company->name }}</h3>
                <p class="text-left text-md mx-4 my-1 text-gray-600">{{ $company->city->name }} {{ $company->address }}
                </p>
                <p class="text-left text-sm mx-4 my-1 text-gray-500 break-all">{{ $company->description }}</p>

                <hr class="mt-3 mb-3">
                <div class="flow-root mb-3 break-words">

                    @if($company->phone)
                    <div class="inline m-2">
                        <svg class="w-5 h-5 inline my-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.20711 14.7929C11.5251 17.111 13.6781 18.4033 15.2802 19.121C16.6787 19.7475 18.3296 19.2562 19.6167 17.9691L19.9114 17.6744L16.3752 15.4241C15.7026 16.4048 14.4319 16.979 13.1632 16.4434C12.2017 16.0376 10.9302 15.3445 9.7929 14.2071C8.65557 13.0698 7.96243 11.7983 7.55659 10.8369C7.02105 9.56817 7.59528 8.29741 8.57591 7.62479L6.32562 4.08863L6.0309 4.38335C4.74381 5.67044 4.25256 7.32131 4.87905 8.71986C5.59671 10.322 6.88908 12.4749 9.20711 14.7929ZM14.4626 20.9462C12.6479 20.1334 10.2905 18.7047 7.7929 16.2071C5.29532 13.7096 3.86668 11.3521 3.05381 9.53748C1.9781 7.13609 2.95955 4.62627 4.61669 2.96913L4.91141 2.67441C5.81615 1.76967 7.32602 1.93541 8.01294 3.01488L10.8437 7.46315C10.9957 7.70201 11.0393 7.99411 10.9637 8.26696C10.8881 8.53981 10.7005 8.76784 10.4472 8.89446L9.81354 9.2113C9.38171 9.42721 9.2931 9.80786 9.39916 10.0591C9.73804 10.8619 10.3046 11.8904 11.2071 12.7929C12.1097 13.6955 13.1381 14.262 13.9409 14.6009C14.1922 14.7069 14.5728 14.6183 14.7887 14.1865L15.1056 13.5528C15.2322 13.2996 15.4602 13.1119 15.7331 13.0363C16.0059 12.9607 16.298 13.0044 16.5369 13.1564L20.9852 15.9871C22.0646 16.674 22.2304 18.1839 21.3256 19.0886L21.0309 19.3833C19.3738 21.0405 16.8639 22.0219 14.4626 20.9462Z" fill="#000000" />
                        </svg>
                        {{ $company->phone }}
                    </div>
                    @endif

                    @if($company->viber)
                    <div class="inline m-2">
                        <svg class="w-5 h-5 inline my-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 192 210.0428" id="viber" version="1.1" viewBox="0 0 192 210.0428" xml:space="preserve">
                            <g>
                                <path d="M116.004,0H75.996C34.0916,0,0,34.086,0,75.9804v36.0392c0,31.1992,19.172,59.2384,48,70.66v23.3632   c0,1.582,0.9316,3.0156,2.3788,3.6564c0.5196,0.2304,1.0724,0.3436,1.6212,0.3436c0.9728,0,1.9356-0.3552,2.6856-1.0348   L77.8788,188h38.1252C157.9084,188,192,153.914,192,112.0196V75.9804C192,34.086,157.9084,0,116.004,0z M184,112.0196   C184,149.504,153.498,180,116.004,180H76.336c-0.9924,0-1.9492,0.3672-2.6856,1.0352L56,197.0236v-17.1172   c0-1.6956-1.0684-3.2072-2.668-3.7696C26.2188,166.5508,8,140.7852,8,112.0196V75.9804C8,38.496,38.502,8,75.996,8h40.008   C153.498,8,184,38.496,184,75.9804V112.0196z" />
                                <path d="M148.8632,121.9728l-24.586-15.9688c-2.6892-1.746-5.8864-2.34-9.0212-1.6916c-3.1368,0.6604-5.8304,2.512-7.5804,5.2112   l-1.156,1.7772c-10.6408-3.5156-22.3732-8.008-29.3964-28.34l2.908-2.5272h0.002c4.9904-4.34,5.5156-11.9336,1.174-16.9336   L61.9748,41.3748c-1.4496-1.6676-3.9768-1.8396-5.6448-0.3944l-12.074,10.496c-10.594,9.2072-5.6428,22.8284-4.0156,27.3048   c0.072,0.1992,0.16,0.3908,0.2636,0.578c0.42,0.754,10.4492,18.6488,26.6424,35.1448   c16.26,16.5624,45.6172,31.8592,46.5176,32.3044c3.3536,2.176,7.1252,3.2188,10.8556,3.2188   c6.5508,0,12.9764-3.2108,16.8064-9.1016l8.7132-13.4176C151.242,125.6524,150.7148,123.1756,148.8632,121.9728z    M134.6172,136.5664c-3.6056,5.5508-11.0508,7.1288-16.9336,3.336c-0.2928-0.1524-29.4552-15.34-44.828-31   C58.4884,94.2656,48.9492,78.008,47.6464,75.7384c-3.17-8.8828-2.6092-14.344,1.8556-18.2228l9.0584-7.8712L75.168,68.75   c1.4744,1.6952,1.3048,4.1756-0.3848,5.6444l-4.908,4.2656c-1.1956,1.0392-1.6664,2.6836-1.1996,4.1956   c8.3692,27.1912,24.6408,32.5312,36.5216,36.4336l1.7304,0.57c1.7308,0.586,3.6292-0.082,4.6192-1.6132l2.838-4.3672   c0.586-0.9024,1.4804-1.5156,2.5196-1.7344c1.0428-0.2224,2.1092-0.0156,3.0136,0.5704l21.2324,13.7892L134.6172,136.5664z" />
                                <path d="M105.1288,64.9884c-2.1288-0.6136-4.3396,0.6248-4.9432,2.7536c-0.6036,2.1252,0.6288,4.336,2.752,4.9416   c5.9608,1.6952,10.7068,6.4532,12.3884,12.418c0.4964,1.7616,2.1016,2.914,3.848,2.914c0.3592,0,0.7244-0.0468,1.0876-0.1484   c2.1252-0.6016,3.3636-2.8088,2.7636-4.9376C120.5976,74.3124,113.7384,67.4376,105.1288,64.9884z" />
                                <path d="M135.5704,88.8748c0.3592,0,0.7244-0.0468,1.088-0.1484c2.1268-0.6016,3.3632-2.8124,2.7636-4.9372   c-4.7188-16.7308-18.0372-30.0784-34.756-34.836c-2.1248-0.6132-4.338,0.6328-4.9412,2.754   c-0.6036,2.1248,0.6288,4.3356,2.7536,4.9412c14.0664,4,25.2736,15.2344,29.2444,29.3124   C132.2208,87.7228,133.8244,88.8748,135.5704,88.8748z" />
                                <path d="M102.9432,30.328c-2.1288-0.6132-4.3396,0.6252-4.9432,2.754c-0.6036,2.1252,0.6288,4.336,2.752,4.9416   c23.838,6.7812,42.824,25.8124,49.5508,49.664c0.496,1.7616,2.1016,2.914,3.8476,2.914c0.3592,0,0.7248-0.0468,1.088-0.1484   c2.1248-0.6016,3.3632-2.8124,2.7636-4.9376C150.5272,59.0116,129.4296,37.8672,102.9432,30.328z" />
                            </g>
                        </svg>
                        {{ $company->viber }}
                    </div>
                    @endif

                    @if( $company->web )
                    <div class="inline m-2">
                        <svg class="w-5 h-5 inline my-2" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" id="Layer_1" viewBox="0 0 128 128">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: #062b31;
                                    }

                                    .cls-2 {
                                        fill: none;
                                        stroke: #062b31;
                                        stroke-miterlimit: 10;
                                        stroke-width: 6.5px;
                                    }
                                </style>
                            </defs>
                            <title />
                            <path class="cls-1" d="M64,16A47.5,47.5,0,1,1,16.5,63.5,47.55,47.55,0,0,1,64,16m0-6.5a54,54,0,1,0,54,54,54,54,0,0,0-54-54Z" />
                            <path class="cls-1" d="M65.08,16c2.09,0,5.78,3.66,8.93,11.69,3.71,9.46,5.75,22.18,5.75,35.81s-2,26.35-5.75,35.81c-3.15,8-6.83,11.69-8.93,11.69s-5.78-3.66-8.93-11.69C52.45,89.85,50.4,77.13,50.4,63.5s2-26.35,5.75-35.81C59.31,19.65,63,16,65.08,16m0-6.5c-11.7,0-21.18,24.18-21.18,54s9.48,54,21.18,54,21.18-24.18,21.18-54-9.48-54-21.18-54Z" />
                            <line class="cls-2" x1="17.66" x2="112.5" y1="80.37" y2="80.37" />
                            <line class="cls-2" x1="17.66" x2="112.5" y1="46.62" y2="46.62" />
                        </svg>
                        {{ $company->web }}
                    </div>
                    @endif

                    @if( $company->whatsapp )
                    <div class="inline m-2">
                        <svg class="w-5 h-5 inline my-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="56.693px" id="Layer_1" style="enable-background:new 0 0 56.693 56.693;" version="1.1" viewBox="0 0 56.693 56.693" width="56.693px" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill-rule: evenodd;
                                    clip-rule: evenodd;
                                }
                            </style>
                            <g>
                                <path class="st0" d="M46.3802,10.7138c-4.6512-4.6565-10.8365-7.222-17.4266-7.2247c-13.5785,0-24.63,11.0506-24.6353,24.6333   c-0.0019,4.342,1.1325,8.58,3.2884,12.3159l-3.495,12.7657l13.0595-3.4257c3.5982,1.9626,7.6495,2.9971,11.7726,2.9985h0.01   c0.0008,0-0.0006,0,0.0002,0c13.5771,0,24.6293-11.0517,24.635-24.6347C53.5914,21.5595,51.0313,15.3701,46.3802,10.7138z    M28.9537,48.6163h-0.0083c-3.674-0.0014-7.2777-0.9886-10.4215-2.8541l-0.7476-0.4437l-7.7497,2.0328l2.0686-7.5558   l-0.4869-0.7748c-2.0496-3.26-3.1321-7.028-3.1305-10.8969c0.0044-11.2894,9.19-20.474,20.4842-20.474   c5.469,0.0017,10.6101,2.1344,14.476,6.0047c3.8658,3.8703,5.9936,9.0148,5.9914,14.4859   C49.4248,39.4307,40.2395,48.6163,28.9537,48.6163z" />
                                <path class="st0" d="M40.1851,33.281c-0.6155-0.3081-3.6419-1.797-4.2061-2.0026c-0.5642-0.2054-0.9746-0.3081-1.3849,0.3081   c-0.4103,0.6161-1.59,2.0027-1.9491,2.4136c-0.359,0.4106-0.7182,0.4623-1.3336,0.1539c-0.6155-0.3081-2.5989-0.958-4.95-3.0551   c-1.83-1.6323-3.0653-3.6479-3.4245-4.2643c-0.359-0.6161-0.0382-0.9492,0.27-1.2562c0.2769-0.2759,0.6156-0.7189,0.9234-1.0784   c0.3077-0.3593,0.4103-0.6163,0.6155-1.0268c0.2052-0.4109,0.1027-0.7704-0.0513-1.0784   c-0.1539-0.3081-1.3849-3.3379-1.8978-4.5706c-0.4998-1.2001-1.0072-1.0375-1.3851-1.0566   c-0.3585-0.0179-0.7694-0.0216-1.1797-0.0216s-1.0773,0.1541-1.6414,0.7702c-0.5642,0.6163-2.1545,2.1056-2.1545,5.1351   c0,3.0299,2.2057,5.9569,2.5135,6.3676c0.3077,0.411,4.3405,6.6282,10.5153,9.2945c1.4686,0.6343,2.6152,1.013,3.5091,1.2966   c1.4746,0.4686,2.8165,0.4024,3.8771,0.2439c1.1827-0.1767,3.6419-1.489,4.1548-2.9267c0.513-1.438,0.513-2.6706,0.359-2.9272   C41.211,33.7433,40.8006,33.5892,40.1851,33.281z" />
                            </g>
                        </svg>
                        {{ $company->whatsapp }}
                    </div>
                    @endif

                    @if( $company->instagram )
                    <div class="inline m-2">
                        <svg class="w-5 h-5 inline my-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 56.7 56.7" enable-background="new 0 0 56.7 56.7" xml:space="preserve">
                            <g>
                                <path d="M28.2,16.7c-7,0-12.8,5.7-12.8,12.8s5.7,12.8,12.8,12.8S41,36.5,41,29.5S35.2,16.7,28.2,16.7z M28.2,37.7   c-4.5,0-8.2-3.7-8.2-8.2s3.7-8.2,8.2-8.2s8.2,3.7,8.2,8.2S32.7,37.7,28.2,37.7z" />
                                <circle cx="41.5" cy="16.4" r="2.9" />
                                <path d="M49,8.9c-2.6-2.7-6.3-4.1-10.5-4.1H17.9c-8.7,0-14.5,5.8-14.5,14.5v20.5c0,4.3,1.4,8,4.2,10.7c2.7,2.6,6.3,3.9,10.4,3.9   h20.4c4.3,0,7.9-1.4,10.5-3.9c2.7-2.6,4.1-6.3,4.1-10.6V19.3C53,15.1,51.6,11.5,49,8.9z M48.6,39.9c0,3.1-1.1,5.6-2.9,7.3   s-4.3,2.6-7.3,2.6H18c-3,0-5.5-0.9-7.3-2.6C8.9,45.4,8,42.9,8,39.8V19.3c0-3,0.9-5.5,2.7-7.3c1.7-1.7,4.3-2.6,7.3-2.6h20.6   c3,0,5.5,0.9,7.3,2.7c1.7,1.8,2.7,4.3,2.7,7.2V39.9L48.6,39.9z" />
                            </g>
                        </svg>
                        {{ $company->instagram }}
                    </div>
                    @endif

                    @if( $company->vkontakte )
                    <div class="inline m-2">
                        <svg class="w-6 h-6 inline my-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                            <title />
                            <g data-name="vk vkontakte media social" id="vk_vkontakte_media_social">
                                <path d="M28.89,22a30.07,30.07,0,0,0-4.13-5.15.2.2,0,0,1,0-.25,40.66,40.66,0,0,0,3.55-5.81,1.9,1.9,0,0,0-.08-1.86A1.81,1.81,0,0,0,26.65,8h-3a2,2,0,0,0-1.79,1.19,35,35,0,0,1-3.12,5.51V9.8A1.79,1.79,0,0,0,16.94,8H12.56a1.4,1.4,0,0,0-1.12,2.21l.4.56a1.84,1.84,0,0,1,.33,1.05v3.84A26.11,26.11,0,0,1,9.05,9.35,2,2,0,0,0,7.16,8H4.71a1.73,1.73,0,0,0-1.66,2.14c1.35,5.73,4.18,10.48,7.77,13a1,1,0,0,0,1.39-.23,1,1,0,0,0-.23-1.4C8.84,19.31,6.34,15.12,5.07,10l2.1,0a26.12,26.12,0,0,0,4.1,7.75,1.6,1.6,0,0,0,1.8.52,1.64,1.64,0,0,0,1.1-1.57V11.82A3.78,3.78,0,0,0,13.71,10h3v5.43A1.77,1.77,0,0,0,18,17.15a1.74,1.74,0,0,0,2-.69A36.87,36.87,0,0,0,23.62,10h2.8a39.81,39.81,0,0,1-3.29,5.37,2.17,2.17,0,0,0,.2,2.83A32.08,32.08,0,0,1,27.25,23H23.9a14,14,0,0,0-4.07-4.31,1.64,1.64,0,0,0-1.73-.13,1.69,1.69,0,0,0-.92,1.52v2.38a.53.53,0,0,1-.5.55h-.86a1,1,0,0,0,0,2h.86a2.52,2.52,0,0,0,2.5-2.55V20.69a11.78,11.78,0,0,1,3,3.32,2,2,0,0,0,1.69,1h3.38a1.92,1.92,0,0,0,1.69-1A2,2,0,0,0,28.89,22Z" />
                            </g>
                        </svg>
                        {{ $company->vkontakte }}
                    </div>
                    @endif

                    @if( $company->telegram )
                    <div class="inline m-2">
                        <svg class="w-6 h-6 inline my-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g>
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0 2C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-3.11-8.83l-2.498-.779c-.54-.165-.543-.537.121-.804l9.733-3.76c.565-.23.885.061.702.79l-1.657 7.82c-.116.557-.451.69-.916.433l-2.551-1.888-1.189 1.148c-.122.118-.221.219-.409.244-.187.026-.341-.03-.454-.34l-.87-2.871-.012.008z" fill-rule="nonzero" />
                            </g>
                        </svg>
                        {{ $company->telegram }}
                    </div>
                    @endif

                </div>



            </div>
        </div>

        @if(count($company->offers) > 0)
        <div class="flex flex-col basis-full my-5">
            <div class="w-full text-left p-4 mt-8">
                <div class="flex items-center text-left justify-left">
                    <h3 class="text-2xl font-normal">Товары компании</h3>
                </div>
            </div>
            <hr class="w-full mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-3 lg:gap-5">
                @foreach($company->offers as $offer)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('offer.show', ['id' => $offer->id ]) }}" class="block h-52">
                        @if( $offer->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$offer->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <div class="h-12">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $offer->name }}
                            </h5>
                        </div>
                        <hr class="my-2">
                        <div>
                            <p class="text-right font-bold pb-0">
                                {{ $offer->price }} {{ $offer->unit_of_price }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="flex-flex-row py-2 lg:py-10">
            <ul class="mb-4 flex list-none flex-row flex-wrap border-b-0 pl-0">
                <li>
                    <button id="event_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        События
                    </button>
                </li>
                <li>
                    <button id="project_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Проекты
                    </button>
                </li>
                <li>
                    <button id="vacancy_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Работа
                    </button>
                </li>
                <li>
                    <button id="news_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Новости
                    </button>
                </li>
            </ul>
        </div>
        <div class="flex basis-full mt-3 mb-16" id="events">
            @if($company->events->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ПРЕДСТОЯЩИХ МЕРОПРИЯТИЙ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($company->events as $event)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('event.show', ['id' => $event->id ]) }}" class="block h-52">
                        @if( $event->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$event->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <div class="h-12">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $event->name }}
                            </h5>
                        </div>
                        <hr class="my-3">
                        <div>
                            <p class="text-right pb-0">{{ $event->date_to_start }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="basis-full mt-3 mb-16 hidden" id="projects">
            @if($company->projects->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ПРОЕКТОВ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($company->projects as $project)
                <div class="block rounded-lg bg-white h-96">
                    <a href="{{ route('project.show', ['id' => $project->id ]) }}" class="block h-52">
                        @if( $project->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800 h-20">
                            {{ $project->name }}
                        </h5>
                        <hr class="my-2">
                        <div>
                            <div class="my-2 flex flex-row">
                                <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.</div>
                                <div class="basis-1/2 text-right">{!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!} %</div>
                            </div>
                            <div class="w-full bg-gray-200">
                                <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!}%'></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="basis-full mt-3 mb-16 hidden" id="vacancies">
            @if($company->vacancies->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ВАКАНСИЙ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($company->vacancies as $work)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('vacancy.show', ['id' => $work->id ]) }}" class="block h-52">
                        @if( $work->parent == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        @if( $work->parent->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->parent->image) }}" alt="image">
                        @endif
                        @endif
                    </a>
                    <div class="px-6">
                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                            {{$work->name }}
                        </h5>
                        <hr class="my-2">
                        <div class="my-4 break-all text-base text-right">
                            <p class="mx-3 inline text-md font-bold">
                                @if($work->price !== null && $work->price !== 0)
                                {{ $work->price }} RUB.
                                @else
                                no price
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="basis-full mt-3 mb-16 hidden" id="news">
            @if($company->news->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ НОВОСТЕЙ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($company->news as $new)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('news.show', ['id' => $new->id ]) }}" class="block h-52">
                        @if( $new->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <div class="h-12">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $new->name }}
                            </h5>
                        </div>
                        <hr class="my-3">
                        <div>
                            <p class="text-right pb-0">{{ $new->date }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>
</section>
<script>
    $(document).ready(function() {
        $('#event_button').css('color', '#0043ff');
        $('#event_button').css('border-bottom-color', '#0043ff');
        $('#event_button').on('click', function() {
            $('#events').show();
            $('#projects').hide();
            $('#vacancies').hide();
            $('#news').hide();
            $('#event_button').css('color', '#0043ff');
            $('#event_button').css('border-bottom-color', '#0043ff');
            $('#project_button').css('color', '');
            $('#project_button').css('border-bottom-color', '');
            $('#vacancy_button').css('color', '');
            $('#vacancy_button').css('border-bottom-color', '');
            $('#news_button').css('color', '');
            $('#news_button').css('border-bottom-color', '');
        });
        $('#project_button').on('click', function() {
            $('#events').hide();
            $('#projects').show();
            $('#vacancies').hide();
            $('#news').hide();
            $('#event_button').css('color', '');
            $('#event_button').css('border-bottom-color', '');
            $('#project_button').css('color', '#0043ff');
            $('#project_button').css('border-bottom-color', '#0043ff');
            $('#vacancy_button').css('color', '');
            $('#vacancy_button').css('border-bottom-color', '');
            $('#news_button').css('color', '');
            $('#news_button').css('border-bottom-color', '');
        });
        $('#vacancy_button').on('click', function() {
            $('#events').hide();
            $('#projects').hide();
            $('#vacancies').show();
            $('#news').hide();
            $('#event_button').css('color', '');
            $('#event_button').css('border-bottom-color', '');
            $('#project_button').css('color', '');
            $('#project_button').css('border-bottom-color', '');
            $('#vacancy_button').css('color', '#0043ff');
            $('#vacancy_button').css('border-bottom-color', '#0043ff');
            $('#news_button').css('color', '');
            $('#news_button').css('border-bottom-color', '');
        });
        $('#news_button').on('click', function() {
            $('#events').hide();
            $('#projects').hide();
            $('#vacancies').hide();
            $('#news').show();
            $('#event_button').css('color', '');
            $('#event_button').css('border-bottom-color', '');
            $('#project_button').css('color', '');
            $('#project_button').css('border-bottom-color', '');
            $('#vacancy_button').css('color', '');
            $('#vacancy_button').css('border-bottom-color', '');
            $('#news_button').css('color', '#0043ff');
            $('#news_button').css('border-bottom-color', '#0043ff');
        });
        $('#slider ul').bxSlider({
            pager: true,
            controls: true,
            auto: true,
            mode: 'fade',
            pause: 10000,
            minSlides: 1,
            maxSlides: 1
        });
    });
</script>
@endsection