@props(['categories' => $categories])

<div class="flex flex-nowrap gap-x-2 mb-3 overflow-x-scroll scrollhidden">
    <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area" @if($term==0) style="background-color: rgb(59 130 246);color:white" @else style="background-color: white;color:black;" @endif>
        <input class="hidden" type="radio" wire:model="term" value="0" name="select" />
        <p class="inline-block " for="checkboxDefault">
            Все группы
        </p>
    </div>
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("select-area").onclick = function() {
                document.querySelector('input[name="select"][value="0"]').click();
                document.getElementById("select-area").style.backgroundColor = 'rgb(59 130 246)';
                document.getElementById("select-area").scrollIntoView({
                    block: 'nearest',
                    inline: "center"
                });
            };
        });
    </script>
    @foreach($categories as $category)
    <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_{{ $category->id }}" @if($term==$category->id)
        style="background-color: rgb(59 130 246);color:white"
        @else
        style="background-color: white;color:black;"
        @endif
        >
        <input class="hidden" type="radio" wire:model="term" value="{{ $category->id }}" name="select" />
        <p class="inline-block " for="checkboxDefault">
            {{ $category->name }}
        </p>
    </div>
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("select-area_{{ $category->id }}").onclick = function() {
                document.querySelector('input[name="select"][value="{{ $category->id }}"]').click();
                document.getElementById("select-area_{{ $category->id }}").scrollIntoView({
                    block: 'nearest',
                    inline: "center"
                });
            };
        });
    </script>
    @endforeach
</div>