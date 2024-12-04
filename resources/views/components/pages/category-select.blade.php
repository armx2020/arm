@props(['categories' => $categories])

<div class="flex flex-col basis-full lg:basis-1/5 max-w-56">
    <div class="flex flex-row gap-3">
        <div class="bg-white mt-3 basis-full rounded-md p-3">
            <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">Категория</h4>
            <div class="flex items-center mb-2">
                <input type="radio" value="Все" id="all_categories" wire:model="category"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="all_categories" class="mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Все</label>
            </div>
            @foreach ($categories as $category)
                <div class="flex items-center mb-2">
                    <input type="radio" value="{{ $category->id }}" id="{{ $category->name }}" wire:model="category"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $category->name }}"
                        class="mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ $category->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>

