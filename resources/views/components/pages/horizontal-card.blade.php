<div class="flex flex-col sm:flex-row rounded-lg bg-white h-auto sm:h-64">
    <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}" class="w-full sm:basis-1/3">
        @if ($entity->image == null)
            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png') }}"
                alt="image" />
        @else
            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset('storage/' . $entity->image) }}"
                alt="image">
        @endif
    </a>
    <div class="p-6 flex flex-col w-full sm:basis-2/3">
        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
            {{ $entity->name }}
        </h5>

        @isset($entity->description)
            <div>
                <p class="mb-2 break-words text-xs  font-medium leading-tight text-neutral-600 line-clamp-3">
                    {{ $entity->description }}
                </p>
            </div>
        @endisset

        @isset($entity->categories)
            <div class="mb-3">
                @foreach ($entity->categories as $categories)
                    <p class="break-words text-sm leading-tight text-neutral-600 line-clamp-3">
                        {{ $categories->name }}
                    </p>
                @endforeach
            </div>
        @endisset

    </div>
</div>
