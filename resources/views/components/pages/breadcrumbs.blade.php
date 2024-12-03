<nav class="mb-2 mt-5 rounded-md mx-auto text-xs sm:text-sm md:text-md">
    <ol class="list-reset flex">
        <li class="hidden sm:flex">
            <a href="{{ $firstPositionUrl }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">
                {{ $firstPositionName }}
            </a>
        </li>

        @isset($secondPositionUrl)
            <li>
                <a href="{{ $firstPositionUrl }}">
                    <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                </a>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">
                <a href="{{ $secondPositionUrl }}">
                    {{ mb_substr($secondPositionName, 0, 50, 'UTF-8') }}
                    @if (mb_strlen($secondPositionName) > 50)
                        ...
                    @endif
                </a>
            </li>
        @endisset

        @isset($thirdPositionUrl)
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">
                <a href="{{ $thirdPositionUrl }}">
                    {{ mb_substr($thirdPositionName, 0, 30, 'UTF-8') }}
                    @if (mb_strlen($thirdPositionName) > 30)
                        ...
                    @endif
                </a>
            </li>
        @endisset

        @isset($fourthPositionUrl)
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">
                <a href="{{ $fourthPositionUrl }}">
                    {{ mb_substr($fourthPositionName, 0, 30, 'UTF-8') }}
                    @if (mb_strlen($fourthPositionName) > 30)
                        ...
                    @endif
                </a>
            </li>
        @endisset

    </ol>
</nav>
