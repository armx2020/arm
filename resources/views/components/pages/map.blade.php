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
              ymaps.ready(init);

              function init() {
                  var geolocation = ymaps.geolocation;
                  var myMap = new ymaps.Map('map', {
                      center: [{{ $lat }}, {{ $lon }}],
                      zoom: {{ $zoom }},
                      controls: ['zoomControl', 'geolocationControl', 'fullscreenControl'],
                  }, {
                      searchControlProvider: 'yandex#search'
                  });

                  var objectManager = new ymaps.ObjectManager({
                      clusterize: true,
                      gridSize: 32,
                      clusterDisableClickZoom: true
                  });

                  objectManager.objects.options.set('preset', 'islands#greenDotIcon');
                  objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
                  myMap.geoObjects.add(objectManager);

                  // Собираем все координаты объектов
                  var coordinates = [];
                  var features = [];

                  @foreach ($entities as $entity)
                      @if ($entity->coordinates)
                          coordinates.push([{{ $entity->lat }}, {{ $entity->lon }}]);
                          features.push({
                              type: 'Feature',
                              id: {{ $entity->id }},
                              geometry: {
                                  type: 'Point',
                                  coordinates: [{{ $entity->lat }}, {{ $entity->lon }}]
                              },
                              properties: {
                                  balloonContent: `
                            <div style="padding: 5px;">
                                <strong>{{ $entity->name }}</strong><br>
                                <a href="https://yandex.ru/maps/?pt={{ $entity->lon }},{{ $entity->lat }}&z=17&l=map" 
                                   target="_blank" 
                                   style="color: #1e88e5; text-decoration: none;">
                                    Открыть в Яндекс Картах
                                </a>
                            </div>
                        `,
                                  hintContent: '{{ $entity->name }}'
                              }
                          });
                      @endif
                  @endforeach

                  // Добавляем все метки через ObjectManager
                  if (coordinates.length > 0) {
                      objectManager.add({
                          type: 'FeatureCollection',
                          features: features
                      });

                      // Центрируем карту по всем объектам
                      myMap.setBounds(myMap.geoObjects.getBounds(), {
                          checkZoomRange: true,
                          zoomMargin: 20
                      });
                  }

                  // Обработчик клика по объекту для открытия ссылки
                  objectManager.objects.events.add('click', function(e) {
                      var objectId = e.get('objectId');
                      var object = objectManager.objects.getById(objectId);
                      // Можно добавить дополнительную логику при клике
                  });
              }
          });
      </script>
  </div>
