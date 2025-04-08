  <div class="mb-8">

    <div id="geolocation-status"
        class="mb-4 flex basis-full bg-yellow-100 rounded-lg px-6 py-2 text-xs lg:text-base text-green-700 w-full text-center"
        role="alert" style="max-height:64px;">
    </div>

    <div id="map" style="height: 200px; width: 100%;"></div>

    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex.geocoder_key') }}&lang=ru_RU"></script>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            // Создаем карту с центром по умолчанию (Москва)
            var map = new ymaps.Map('map', {
                center: [55.755864, 37.617698], // Координаты Москвы
                zoom: 4
            });

            // Проверяем поддержку геолокации браузером
            if (!navigator.geolocation) {
                showError('Ваш браузер не поддерживает геолокацию');
                return;
            }

            // Параметры для геолокации
            var geoOptions = {
                enableHighAccuracy: true, // Высокая точность
                timeout: 10000, // Максимальное время ожидания (10 сек)
                maximumAge: 60000 // Кеширование результата (60 сек)
            };

            // Запрашиваем текущее положение
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    // Успешное получение координат
                    var userCoords = [position.coords.latitude, position.coords.longitude];

                    // Центрируем карту на пользователе
                    map.setCenter(userCoords, 15);

                    // Добавляем метку пользователя
                    var userPlacemark = new ymaps.Placemark(
                        userCoords, {
                            hintContent: 'Ваше местоположение',
                            balloonContent: 'Точность: ±' + Math.round(position.coords.accuracy) + ' метров'
                        }, {
                            preset: 'islands#blueCircleDotIcon',
                            iconColor: '#0088ff'
                        }
                    );
                    map.geoObjects.add(userPlacemark);

                    // Выводим информацию о точности
                    if (position.coords.accuracy > 1000) {
                        showWarning('Низкая точность определения (' + Math.round(position.coords.accuracy) + ' м)');
                    }
                },
                function(error) {
                    // Обработка ошибок
                    var errorMessage;
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage =
                                "Для корректного отображения разрешите доступ к геолокации в настройках браузера";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "Информация о местоположении недоступна";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "Время ожидания истекло";
                            break;
                        case error.UNKNOWN_ERROR:
                            errorMessage = "Произошла неизвестная ошибка";
                            break;
                    }
                    showError(errorMessage);
                },
                geoOptions
            );
        }

        function showError(message) {
            document.getElementById('geolocation-status').textContent = message;
            console.error('Geolocation Error:', message);
        }

        function showWarning(message) {
            var statusEl = document.getElementById('geolocation-status');
            statusEl.textContent = '⚠ ' + message;
            statusEl.style.color = 'orange';
        }
    </script>
</div>