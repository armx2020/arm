@extends('layouts.app')
@section('content')

<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="questions"></x-nav-profile>

    <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10">
            <ul class="accordion-list">
                <li>
                    <h3>Вопрос 1</h3>
                    <div class="answer">
                        <p>Ответ 1</p>
                    </div>
                </li>
                <li>
                    <h3>Вопрос 2</h3>
                    <div class="answer">
                        <p>ответ 2</p>
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