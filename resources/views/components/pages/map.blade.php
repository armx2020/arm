  <div class="mb-8">

      @php
          $zoom = 8;

          if (!isset($lat) && !isset($lon)) {
              $lat = 55.755819;
              $lon = 37.617644;
              $zoom = 8;
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
              ymaps.ready(function() {
                  var myMap = new ymaps.Map('map', {
                          center: [{{ $lat }}, {{ $lon }}],
                          zoom: {{ $zoom }},
                          controls: ['zoomControl', 'geolocationControl', 'fullscreenControl'],
                      }, {
                          searchControlProvider: 'yandex#search'
                      }),
                      clusterer = new ymaps.Clusterer({
                          preset: 'islands#invertedVioletClusterIcons',
                          groupByCoordinates: false,
                          clusterDisableClickZoom: true,
                          clusterHideIconOnBalloonOpen: false,
                          geoObjectHideIconOnBalloonOpen: false
                      }),
                      /**
                       * Модифицированная функция для использования данных из $entities
                       */
                      getEntityData = function(entity) {
                          return {
                              balloonContentHeader: '<font size=3><b>' + entity.name + '</b></font>',
                              balloonContentBody: '<div style="padding: 5px; max-width: 300px;">' +
                                  (entity.address ? '<p><strong>Адрес:</strong> ' + entity.address + '</p>' :
                                      '') +
                                  '<a target="_blank" href="https://yandex.ru/maps/?pt=' + entity.lon + ',' +
                                  entity.lat + '&z=17&l=map">' +
                                  'Открыть в Яндекс Картах</a>' +
                                  '</div>',
                              balloonContentFooter: '<font size=1>ID объекта: ' + entity.id + '</font>',
                              clusterCaption: entity.name
                          };
                      },
                      /**
                       * Функция возвращает опции метки (можно кастомизировать)
                       */
                      getEntityOptions = function() {
                          return {
                              preset: 'islands#violetIcon',
                              balloonCloseButton: true,
                              hideIconOnBalloonOpen: false
                          };
                      },
                      /**
                       * Массив координат из ваших сущностей
                       */
                      entities = [
                          @foreach ($entities as $entity)
                              @if ($entity->coordinates)
                                  {
                                      id: {{ $entity->id }},
                                      name: '{{ addslashes($entity->name) }}',
                                      address: '{{ $entity->address ? addslashes($entity->address) : '' }}',
                                      lat: {{ $entity->lat }},
                                      lon: {{ $entity->lon }}
                                  },
                              @endif
                          @endforeach
                      ],
                      geoObjects = [];
                  console.log(entities)
                  /**
                   * Создаем метки для каждой сущности
                   */
                  for (var i = 0, len = entities.length; i < len; i++) {
                      geoObjects[i] = new ymaps.Placemark(
                          [entities[i].lat, entities[i].lon],
                          getEntityData(entities[i]),
                          getEntityOptions()
                      );
                  }

                  /**
                   * Настройки кластеризатора
                   */
                  clusterer.options.set({
                      gridSize: 80,
                      clusterDisableClickZoom: true,
                      clusterOpenBalloonOnClick: true
                  });

                  /**
                   * Добавляем метки в кластеризатор
                   */
                  clusterer.add(geoObjects);
                  myMap.geoObjects.add(clusterer);

                  /**
                   * Центрируем карту по всем объектам
                   */
                  if (geoObjects.length > 0) {
                      myMap.setBounds(clusterer.getBounds(), {
                          checkZoomRange: true,
                          zoomMargin: 50
                      });
                  }

              });
          });
      </script>
  </div>
