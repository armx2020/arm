@props(['categories' => $categories])

<div class="flex flex-col basis-1/2 lg:basis-1/5 max-w-56 pl-1 md:pl-0">
    <div class="flex flex-row gap-3">

        <div class="bg-white mt-3 basis-full rounded-md p-3 hidden lg:block">
            <h4 class="mb-2 font-semibold text-gray-900">Специализация</h4>
            <div class="flex items-center mb-2">
                <input type="radio" value="Все" id="all_categories" wire:model.live="subCategory"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="all_categories" class="mx-2 text-sm font-medium text-gray-900">
                    Все</label>
            </div>
            @foreach ($categories as $category)
                <div class="flex items-center mb-2">
                    <input type="radio" value="{{ $category->id }}" id="{{ $category->name }}"
                        wire:model.live="subCategory"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="{{ $category->name }}"
                        class="mx-2 text-sm font-medium text-gray-900">
                        {{ $category->name }}</label>
                </div>
            @endforeach
        </div>

        @if ($this->category == '19' || $this->category == '78')
            <div class="bg-white mt-3 basis-full rounded-md block lg:hidden">
                <select name="subCategory" class="w-full border-0 rounded-md" wire:model.live="subCategory"
                    autocomplete="off">
                    <option value='Все'>Все специализации</option>
                    @foreach ($categories as $category)
                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

    </div>
</div>
