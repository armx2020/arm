@props(['entity' => $entity])

<div
    class="flex flex-col @if ($entity == 'news' || $entity == 'places') basis-full @else basis-1/2 pr-2 lg:pr-0 @endif lg:basis-1/5 max-w-56">
    <div class="flex flex-row gap-3">
        <div class="bg-white mt-3 basis-full rounded-md">
            <select name="entity" class="w-full border-0 rounded-md" wire:model="entity" autocomplete="off">
                <option value='projects'>Проекты</option>
                <option value='companies'>Бизнес справочиник</option>
                <option value='news'>Новости</option>
                <option value='groups'>Сообщества</option>
                <option value='places'>Интересные места</option>
                <option value='communities'>Кружки и секции</option>
                <option value='works'>Работа</option>
            </select>
        </div>
    </div>
</div>
