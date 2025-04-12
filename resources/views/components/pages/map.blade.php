  <div class="mb-8">

      @php
          if (!isset($lat) && !isset($lon)) {
              $lat = 55.755819;
              $lon = 37.617644;
          }
      @endphp

      <div id="geolocation-status"
          class="mb-4 flex basis-full bg-yellow-100 rounded-lg px-6 py-2 text-xs lg:text-base text-green-700 w-full hidden"
          role="alert" style="max-height:64px;">
      </div>

      <div id="map" style="height: 200px; width: 100%;"></div>
      <style>
          .ymaps-2-1-79-gototech {
              display: none !important;
          }

          .ymaps-2-1-79-copyrights-promo {
              display: none !important;
          }
      </style>

      <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex.geocoder_key') }}&lang=ru_RU"></script>
      <script type="text/javascript">
          $(document).ready(function() {

              ymaps.ready(init);

              function init() {
                  var geolocation = ymaps.geolocation,
                      myMap = new ymaps.Map('map', {
                          center: [{{ $lat }}, {{ $lon }}],
                          zoom: 9,
                          controls: ['zoomControl', 'geolocationControl', 'fullscreenControl'],
                      }, {
                          searchControlProvider: 'yandex#search'
                      }),
                      objectManager = new ymaps.ObjectManager({
                          clusterize: true,
                          gridSize: 32,
                          clusterDisableClickZoom: true
                      });

                  // Добавляем ObjectManager на карту
                  objectManager.objects.options.set('preset', 'islands#greenDotIcon');
                  objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
                  myMap.geoObjects.add(objectManager);

                  loadNearbyObjects({{ $lat }}, {{ $lon }}, objectManager, myMap);
              }

              function loadNearbyObjects(latitude, longitude, objectManager, map) {
                  // AJAX-запрос для получения ближайших объектов
                  $.ajax({
                      url: "{{ route('nearby-entities') }}",
                      method: 'GET',
                      data: {
                          lat: latitude,
                          lon: longitude,
                          radius: 100000 // радиус в метрах
                      },
                      success: function(response) {
                          // Очищаем предыдущие объекты
                          objectManager.removeAll();

                          // Добавляем новые объекты
                          objectManager.add(response);

                          const userPlacemark = new ymaps.Placemark(
                              [latitude, longitude], {
                                  hintContent: 'Я здесь'
                              }, {
                                  preset: 'islands#redDotIcon'
                              }
                          );


                          map.geoObjects.add(userPlacemark);

                          setTimeout(() => {
                              // Получаем все координаты объектов
                              const allCoords = [];

                              // 1. Получаем координаты через features из response
                              if (response.features && response.features.length > 0) {
                                  response.features.forEach(feature => {
                                      if (feature.geometry && feature.geometry
                                          .coordinates) {
                                          // Координаты в GeoJSON: [lon, lat]
                                          allCoords.push(feature.geometry.coordinates);
                                      }
                                  });
                              }

                              // 2. Добавляем координаты пользователя (преобразуем в [lon, lat])
                              allCoords.push([latitude, longitude]);

                              if (allCoords.length > 1) {
                                  // 3. Создаем bounds вручную
                                  const bounds = ymaps.util.bounds.fromPoints(allCoords);

                                  // 4. Центрируем карту
                                  map.setBounds(bounds, {
                                      checkZoomRange: true,
                                      zoomMargin: 50
                                  });

                              } else {
                                  // Если объектов нет - центрируем только на пользователе
                                  map.setCenter([latitude, longitude], 15);
                              }
                          }, 300);

                      },
                      error: function(xhr, status, error) {
                          console.error('Ошибка при загрузке объектов:', error);
                      }
                  });
              }

          });
      </script>
  </div>
