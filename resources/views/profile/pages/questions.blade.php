@extends('layouts.app')
@section('content')

<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="questions"></x-nav-profile>

    <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10">
            <ul class="accordion-list">
                <li>
                    <h3>Что это за веб-сайт?</h3>
                    <div class="answer">
                        <p>Этот веб-сайт посвящен армянским общинам в России. Мы предоставляем информацию о культурных событиях, истории, активностях и новостях, связанных с армянскими общинами.</p>
                    </div>
                </li>
                <li>
                    <h3>Какие армянские общины в России упоминаются на сайте?</h3>
                    <div class="answer">
                        <p>На нашем сайте вы найдете информацию о различных армянских общинах, активных в России. Мы стараемся охватить как можно больше общин и предоставить актуальную информацию о них.</p>
                    </div>
                </li>
                <li>
                    <h3>Какие события и мероприятия организуются армянскими общинами в России?</h3>
                    <div class="answer">
                        <p>Мы публикуем информацию о различных мероприятиях, таких как фестивали, концерты, выставки и другие культурные события, организуемые армянскими общинами в России.</p>
                    </div>
                </li>
                <li>
                    <h3>Как могу участвовать или поддержать армянские общины в России?</h3>
                    <div class="answer">
                        <p>Если вы хотите участвовать в активностях армянских общин или оказать им поддержку, наш сайт предоставляет контактную информацию и информацию о способах волонтерства или финансовой поддержки.</p>
                    </div>
                </li>
                <li>
                    <h3>Где я могу найти новости и обновления о деятельности армянских общин в России??</h3>
                    <div class="answer">
                        <p>Мы регулярно обновляем наш сайт с последними новостями и событиями, связанными с армянскими общинами в России. Вы можете найти их на нашей главной странице.</p>
                    </div>
                </li>
                <li>
                    <h3>Есть ли на сайте ресурсы для изучения армянской культуры и истории?</h3>
                    <div class="answer">
                        <p>Да, мы предоставляем ресурсы, которые помогут вам узнать больше о армянской культуре, истории и традициях.</p>
                    </div>
                </li>
                <li>
                    <h3>Могу ли я предложить свою информацию или событие для размещения на вашем сайте?</h3>
                    <div class="answer">
                        <p>Конечно, мы приветствуем вклад от армянских общин и отдельных лиц. Вы можете связаться с нами для предложения информации или события для размещения на сайте.</p>
                    </div>
                </li>
                <li>
                    <h3>Есть ли на сайте информация о контактах армянских общин в разных регионах России?</h3>
                    <div class="answer">
                        <p>Да, мы стараемся предоставить контактную информацию армянских общин в разных регионах России, чтобы помочь вам связаться с ними.</p>
                    </div>
                </li>
                <li>
                    <h3>Как часто обновляется информация на сайте?</h3>
                    <div class="answer">
                        <p>Мы стараемся регулярно обновлять информацию на сайте, особенно в разделе новостей и событий, чтобы держать вас в курсе событий, связанных с армянскими общинами.</p>
                    </div>
                </li>
                <li>
                    <h3>Как могу подписаться на рассылку или социальные медиа вашего сайта, чтобы быть в курсе последних обновлений?</h3>
                    <div class="answer">
                        <p>Вы можете найти ссылки на наши социальные медиа и информацию о подписке на рассылку на нашем сайте, обычно на главной странице или в нижней части страницы.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $('.accordion-list > li > .answer').hide();

        $('.accordion-list > li').click(function() {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active").find(".answer").slideUp();
            } else {
                $(".accordion-list > li.active .answer").slideUp();
                $(".accordion-list > li.active").removeClass("active");
                $(this).addClass("active").find(".answer").slideDown();
            }
            return false;
        });

    });
</script>
@endsection