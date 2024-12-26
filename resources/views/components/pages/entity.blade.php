@props(['entityTypies' => $entityTypies])

<div class="flex flex-col basis-1/2 lg:basis-1/5 max-w-56">
    <div class="flex flex-row gap-3">
        <div class="bg-white mt-3 basis-full rounded-md">
            <select name="type" class="w-full border-0 rounded-md" wire:model="type" autocomplete="off" wire:click="resetCategory()">
                @foreach ($entityTypies as $type)
                    <option value='{{ $type->id }}'>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
