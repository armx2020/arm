@extends('layouts.app')

@section('title')
    <title>Армянский справочник для армян России и мира -  Политика конфидициальности</title>
@endsection

@section('meta')
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Армянский справочник для армян России и мира - Политика конфидициальности">
@endsection

@section('content')
<nav class="mb-2 mt-5 rounded-md mx-auto px-3 lg:px-2 text-sm md:text-md">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700">Главная</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500">/</span>
        </li>
        <li class="text-neutral-500">
            <a href="{{ route('privacy-policy') }}">
                Политика конфидициальности</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col mx-auto my-6 lg:my-8">
        <div class="flex basis-full bg-white rounded-md p-3 md:p-6 lg:p-10 ">
            <div class="text-justify">
                <span class="font-bold text-lg">Политика конфиденциальности веб-сайта "Армянские Общины по России"</span>
                <br><br><br>
                1. Сбор и использование информации<br>
                <p class="m-0 md:mx-7 mt-3 text-neutral-600">
                    1.1. Мы собираем определенную информацию, когда вы посещаете наш веб-сайт. Эта информация может включать в себя:
                    Персональные данные, которые вы добровольно предоставляете, такие как имя, адрес электронной почты и контактные данные.
                    Информацию о вашем использовании сайта, включая данные о просмотренных страницах, действиях на сайте и другие подобные данные.
                    <br>
                    1.2. Мы используем собранную информацию для следующих целей:
                    Предоставление вам информации о деятельности армянских общин в России и связанных с ней событиях.
                    Обратная связь и ответы на ваши запросы.
                    Улучшение работы нашего веб-сайта и адаптация его под ваши потребности.
                </p><br>
                2. Раскрытие информации третьим лицам<br>
                <p class="m-0 md:mx-7 mt-3 text-neutral-600">
                2.1. Мы не продаем, не обмениваем и не передаем вашу личную информацию третьим лицам без вашего явного согласия, за исключением случаев, предусмотренных законодательством.<br>
                2.2. Мы можем разглашать агрегированные и анонимизированные данные о посетителях нашего сайта для анализа и статистики, но эти данные не содержат личной информации.<br>
                </p><br>
                3. Защита информации<br>
                <p class="m-0 md:mx-7 mt-3 text-neutral-600">
                3.1. Мы предпринимаем разумные меры для защиты вашей личной информации от несанкционированного доступа, использования или разглашения.
                3.2. Несмотря на наши усилия по обеспечению безопасности, мы не можем гарантировать абсолютную безопасность информации передаваемой через интернет. Вы передаете информацию на свой страх и риск.
                </p><br>
                4. Использование файлов cookie<br>
                <p class="m-0 md:mx-7 mt-3 text-neutral-600">
                4.1. Наш веб-сайт может использовать файлы cookie для улучшения опыта пользователей. Файлы cookie - это небольшие текстовые файлы, которые сохраняются на вашем устройстве при посещении сайта.
                4.2. Вы можете настроить свой браузер так, чтобы отказаться от файлов cookie, если вы не хотите их использовать. Однако, это может повлиять на функциональность нашего сайта.
                </p><br>
                5. Изменения в политике конфиденциальности<br>
                <p class="m-0 md:mx-7 mt-3 text-neutral-600">
                5.1. Мы оставляем за собой право вносить изменения в нашу политику конфиденциальности. Любые изменения будут размещены на этой странице, и дата последнего обновления будет указана вверху страницы.
                5.2. После внесения изменений, ваше использование сайта означает ваше согласие с обновленной политикой конфиденциальности.
                </p><br>
            </div>
        </div>
    </div>
</section>
@endsection