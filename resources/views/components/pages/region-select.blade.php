@props(['regions' => $regions])

<div class="flex flex-col basis-full lg:basis-1/5 max-w-56">
    <div class="flex flex-row gap-3">
        <div class="bg-white mt-3 basis-full rounded-md">
            <select name="region" class="w-full border-0 rounded-md" wire:model="region" autocomplete="off">
                @foreach ($regions as $region)
                    <option value='{{ $region->id }}'>{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
