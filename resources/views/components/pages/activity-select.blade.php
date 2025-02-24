@props(['activities' => $activities])

<div class="flex flex-col basis-1/2 lg:basis-1/5 max-w-56 pl-1 md:pl-0">
    <div class="flex flex-row gap-3">

        <div class="bg-white mt-3 basis-full rounded-md p-3 hidden lg:block">
            <h4 class="mb-2 font-semibold text-gray-900">Категория</h4>
            @foreach ($activities as $activity => $value)
                <div class="flex items-center mb-2">
                    <input type="radio" value="{{ $value }}" id="{{ $activity }}" wire:model.live="category"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="{{ $activity }}" class="mx-2 text-sm font-medium text-gray-900">
                        {{ $activity }}</label>
                </div>
            @endforeach
        </div>

        <div class="bg-white mt-3 basis-full rounded-md block lg:hidden">
            <select name="category" class="w-full border-0 rounded-md" wire:model.live="category" autocomplete="off">
                @foreach ($activities as $activity => $value)
                    <option value='{{ $value }}'>{{ $activity }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
