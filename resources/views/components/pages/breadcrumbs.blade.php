<nav class="hidden md:block mb-2 mt-3 lg:mt-5 rounded-md mx-auto text-xs sm:text-sm md:text-md px-1">
    <ol class="list-reset flex flex-nowrap overflow-hidden">
        <li class="text-neutral-500">
            <a href="{{ $firstPositionUrl }}" class="truncate">
                {{ $firstPositionName }}
            </a>
        </li>

        @isset($secondPositionUrl)
            <li>
                <a href="{{ $firstPositionUrl }}">
                    <span class="mx-2 text-neutral-500">/</span>
                </a>
            </li>
            <li class="text-neutral-500">
                <a href="{{ route($secondPositionUrl) }}" class="truncate">
                    {{ $secondPositionName }}
                </a>
            </li>
        @endisset

        @isset($thirdPositionUrl)
            <li>
                <span class="mx-2 text-neutral-500">/</span>
            </li>
            <li class="text-neutral-500">
                <a href="{{ $thirdPositionUrl }}" class="truncate">
                    {{ $thirdPositionName }}
                </a>
            </li>
        @endisset

        @isset($fourthPositionUrl)
            <li>
                <span class="mx-2 text-neutral-500">/</span>
            </li>
            <li class="text-neutral-500">
                <a href="{{ $fourthPositionUrl }}" class="truncate">
                    {{ html_entity_decode($fourthPositionName, ENT_QUOTES, 'UTF-8') }}
                </a>
            </li>
        @endisset

    </ol>
</nav>
