<div class="flex items-center">

    <div class="flex flex-col gap-1 w-full p-2">

        @foreach ($filters as $name => $type)
            <div class="flex flex-row gap-2 ">
                @switch($type)
                    @case('date')
                    <div class="basis-1/5 content-center self-center px-4">
                        {{ __('column.' . $name) }}
                    </div>

                    <div class="flex basis-2/5">
                        <input type="date" wire:model.live="selectedFilters.{{ $name }}.>="
                               name="$name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                    </div>
                    <div class="flex basis-2/5">
                        <input type="date" wire:model.live="selectedFilters.{{ $name }}.<="
                               name="$name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                    </div>
                    @break

                    @case('bool')
                    <div class="basis-1/5 content-center self-center px-4">
                        {{ __('column.' . $name) }}
                    </div>

                    <div class="flex basis-4/5">
                        <select name="$name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                wire:model.live="selectedFilters.{{ $name }}.=">
                            <option value="">- все -</option>
                            <option value="1">да</option>
                            <option value="0">нет</option>
                        </select>
                    </div>
                    @break

                    @case('select')
                    @if ($name == 'region_id')
                        <div class="basis-1/5 content-center self-center px-4">
                            {{ __('column.' . $name) }}
                        </div>

                        <div class="flex basis-4/5">
                            <select name="$name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                    wire:model.live="selectedFilters.{{ $name }}.=">
                                <option value=""> - все регионы -</option>
                                @foreach (\App\Models\Region::all() as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if ($name == 'double')
                        <div class="basis-1/5 content-center self-center px-4">
                            {{ __('column.' . $name) }}
                        </div>

                        <div class="flex basis-4/5">
                            <select name="$name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                    wire:model.live="selectedFilters.{{ $name }}.=">
                                <option value=""> - Все -</option>
                                @foreach (\App\Models\Region::all() as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if ($name == 'region_top' || $name == 'city_top')
                        <div class="basis-1/5 content-center self-center px-4">
                            {{ __('column.' . $name) }}
                        </div>

                        <div class="flex basis-4/5">
                            <select name="$name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                    wire:model.live="selectedFilters.{{ $name }}.=">
                                <option value=""> - Все -</option>
                                <option value="1">1 место</option>
                                <option value="2">2 место</option>
                                <option value="3">3 место</option>
                            </select>
                        </div>
                    @endif

                    @if ($name == 'city_id')
                        <div class="basis-1/5 content-center self-center px-4">
                            {{ __('column.' . $name) }}
                        </div>

                        <div class="flex basis-4/5">
                            <select name="$name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                    wire:model.live="selectedFilters.{{ $name }}.=">
                                <option value=""> - все города - </option>
                                @foreach (\App\Models\City::all() as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if ($name == 'type')
                        <div class="basis-1/5 content-center self-center px-4">
                            {{ __('column.' . $name) }}
                        </div>

                        <div class="flex basis-4/5">
                            <select name="{{ $name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                    wire:model.live="selectedFilters.{{ $name }}.=">
                                <option value="">Все</option>
                                <option value="vacancy">Вакансии</option>
                                <option value="resume">Резюмэ</option>
                            </select>
                        </div>
                    @endif

                    @if ($name == 'entity_type_id')
                        <div class="basis-1/5 content-center self-center px-4">
                            {{ __('column.' . $name) }}
                        </div>

                        <div class="flex basis-4/5">
                            <select name="$name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-1/2 p-2.5"
                                    wire:model.live="selectedFilters.{{ $name }}.=">
                                <option value="">- выберите тип -</option>
                                @foreach (\App\Models\EntityType::all() as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @break
                @endswitch

            </div>
        @endforeach


    </div>

</div>
