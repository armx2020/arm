@extends('layouts.app')

@section('title')
    <title>Армянский справочник для армян России и мира - Мои общины</title>
@endsection

@section('meta')
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Армянский справочник для армян России и мира - Мои общины">
@endsection

@section('scripts')
@endsection

@section('content')
    <div class="w-full sm:max-w-lg p-4 bg-white overflow-hidden sm:rounded-lg z-50 mx-auto my-10 md:my-20">
        <div class="items-center justify-between">
            <a href="callto:78005008275" class="text-lg text-gray-900">
                Для завершения регистрации, пожалуйста позвоните по этому номеру <span
                    class="font-bold">{{ $phoneForeVerification }}</span> в течении <span id="timer"
                    class="font-bold">{{ $timeForeVerification }}</span>
            </a>
            <p class="text-lg text-gray-900 font-bold">
                (звонок абсолютно бесплатный)
            </p>
        </div>

        <hr class="my-4">

        <div class="flex items-center justify-between mt-4">
            <a href=""
                class="popup-close underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                обновить
            </a>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            const initialTime = `{!! $timeForeVerification !!}`;
            let [minutes, seconds] = initialTime.split(":").map(Number);
            const timerElement = $('#timer');

            function updateTimer() {
                const displayMinutes = minutes.toString().padStart(2, '0');
                const displaySeconds = seconds.toString().padStart(2, '0');
                timerElement.text(displayMinutes + ':' + displaySeconds);

                if (minutes === 0 && seconds === 0) {
                    clearInterval(timerInterval);
                        setTimeout(() => location.reload(), 1000);
                    return;
                }

                 if (seconds === 0) {
                    minutes--;
                    seconds = 59;
                } else {
                    seconds--;
                }

            }

            const timerInterval = setInterval(updateTimer, 1000);
            updateTimer();
        });
    </script>
@endsection

@section('body')
@endsection
