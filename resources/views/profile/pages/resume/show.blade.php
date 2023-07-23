@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="myresumes"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        @if(session('success'))
        <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert" style="max-height:64px;">
            {{ session('success')}}
        </div>
        @endif
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                <div class="flex flex-col basis-1/4">
                    @if( $resume->user->image == null )
                    <img class="h-40 lg:h-48 rounded-lg mx-auto p-14 flex object-cover" src="{{ url('/image/user.png')}}" alt="image" />
                    @else
                    <img src="{{ asset( 'storage/'.$resume->user->image) }}" alt="" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover">
                    @endif
                    <div class="m-5">
                        <div class="my-2 flex flex-col">
                        <div class="basis-full text-left">Ожидаемая зарплата:</div>
                            <div class="basis-full text-left font-bold">{{ $resume->price ? $resume->price. ' руб.' : 'не указана'}}</div>
                            
                        </div>
                     </div>
                </div>
                <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                    <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $resume->user->firstname }} {{ $resume->user->lastname }} ({{ $resume->name }})</h1>
                        <p class="text-left text-md lg:text-lg mx-4 my-1 text-gray-500">город: {{ $resume->city->name }} ({{$resume->region->name }})</p>
                        <p class="text-left text-md lg:text-lg mx-4 my-1 text-gray-500">адрес: {{ $resume->address }}</p>
                        <p class="text-left text-sm mx-4 my-1 text-gray-600">{{ $resume->description }}</p>

                        <hr class="mt-3 mb-3">
                        <div class="flow-root mb-3">
                            <h4 class="text-left text-lg lg:text-xl my-2 mx-3">Социальные сети</h4>
                            <div class="grid grid-cols-2 justify-center gap-2 mx-3">
                                <div class="text-sm font-normal text-gray-600">
                                    телефон: {{ $resume->user->phone ? $resume->user->phone : 'не указан' }}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    vkontakte: {{ $resume->user->vkontakte ? $resume->user->vkontakte : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    watsapp: {{ $resume->user->whatsapp ? $resume->user->vwhatsapp : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    telegram: {{ $resume->user->telegram ? $resume->user->telegram  : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    instagram: {{ $resume->user->instagram ? $resume->user->instagram : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    viber: {{ $resume->user->viber ? $resume->user->viber : 'не указан'}}
                                </div>

                            </div>
                        </div>
                </div>
                <div class="absolute right-3 top-3">
                    <div class="my-3 break-all text-base text-right">
                        <a href="{{ route('myresume.edit', ['id' => $resume->id]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                        <form method="post" action="{{ route('myresume.destroy', ['id' => $resume->id]) }}" class="inline">
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
        </div>
    </div>
</div>
@endsection