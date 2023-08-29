<div class="flex justify-between">
    <div class="bg-white rounded-md mb-3">
        <select name="sort" class="w-full border-0" wire:model="sort">
            <option value="name|asc">по имени: min</option>
            <option value="name|desc">по имени: max</option>
            <option value="created_at|asc">по дате создания: min</option>
            <option value="created_at|desc">по дате создания: max</option>
            <option value="updated_at|asc">по дате изменения: min</option>
            <option value="updated_at|desc">по дате изменения: max</option>
            <!-- <option value="'id', 'asc'">по рейтенгу: max</option>
                            <option value="'id', 'asc'">по рейтингу: max</option> -->
        </select>
    </div>
    <div class="bg-white rounded-md mb-3">
        <select name="view" class="w-full border-0" wire:model="view">
            <option value="1">сетка</option>
            <option value="2">столбик</option>
        </select>
    </div>
</div>