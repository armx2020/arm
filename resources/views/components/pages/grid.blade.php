<div class="grid grid-cols-1 gap-3 lg:gap-5">
    @foreach ($entities as $entity)
        <x-pages.card :entity="$entity" :$entityShowRout />
    @endforeach
</div>
