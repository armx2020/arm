<div class="mx-auto py-5 lg:pt-10 text-left">
    <div class="bg-[#dbe6fb] rounded-xl row-span-1">
        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-col text-left basis-2/3 lg:basis-1/2 p-5 xl:p-8">
                <div class="my-1 lg:my-2 text-md md:text-lg lg:text-2xl font-extrabold uppercase">Добавить информацию
                </div>
                <div class="my-1 text-sm md:text-md lg:text-lg xl:text-xl font-normal">
                    Добавить услуги, сообщить о проблеме или просто написать нам</div>
                <button
                    class="my-2 lg:my-4 rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-9 py-2 items-center font-normal inform-us-button">
                    Перейти к форме
                </button>
            </div>
            <div class="hidden lg:flex basis-1/2 p-1 flex place-content-end lg:place-content-center">
                <img class="flex self-end h-20 md:h-32 lg:h-64 object-cover rounded-xl object-right-bottom"
                    src="{{ url('/image/messages.png') }}" alt="messages">
            </div>
        </div>
    </div>
</div>

<div id="inform-us" class="hidden fixed inset-0 px-4 min-h-full overlow-hidden sm:px-0 z-50" focusable>

    <div class="my-5 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-auto shadow-xl transform transition-all sm:w-11/12 lg:w-1/2 h-5/6"
        style="max-width:50rem">

        <div class="m-7">
            <x-secondary-button class="inform-us-close absolute right-4 top-4">
                {{ __('Закрыть') }}
            </x-secondary-button>
            <div class="flex flex-col">

                <div id="select-inform">
                    <h4 class="text-xl font-semibold mt-6">Выберите, один из вариантов</h4>
                    <hr class="mb-4 mt-2">
                    <button type="button" id="select-form-button"
                        class="uppercas w-full rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50">
                        Добавьте информацию для справочника без регистрации
                    </button>

                    <a href="{{ route('register') }}"
                        class="block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-2">
                        Добавьте свою компанию, сообщество или событие
                    </a>

                    <a href="{{ route('inform-us.appeal') }}"
                        class="block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-2">
                        Написать нам, сообщить об ошибки, запросить помощь
                    </a>
                </div>

                <div id="select-form" class="hidden">
                    <h4 class="text-xl font-semibold mt-6">Выберите, что добавить</h4>
                    <hr class="mb-4 mt-2">

                    <a href="{{ route('inform-us.company') }}"
                        class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                        Компанию
                    </a>

                    <a href="{{ route('inform-us.place') }}"
                        class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                        Интересное место
                    </a>

                    <a href="{{ route('inform-us.group') }}"
                        class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                        Кружок, сообщество
                    </a>

                    <a href="{{ route('inform-us.community') }}"
                        class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                        Община
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $(".inform-us-button").click(function() {
            $("#inform-us").toggle();
            $("#select-inform").show();
            $("#select-form").hide();
            $('body, html').css('overflow', 'hidden')
        });
        $(".inform-us-close").click(function() {
            $("#inform-us").toggle();
            $("#select-inform").show();
            $("#select-form").hide();
            $('body, html').css('overflow', 'visible');
        });
        $("#select-form-button").click(function() {
            $("#select-form").show();
            $("#select-inform").hide();
        });
    });
</script>
