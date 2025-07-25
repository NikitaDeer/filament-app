<div class="rounded-2xl bg-white p-6 shadow-xl dark:bg-neutral-800 sm:p-8">
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    {{-- Левая колонка с формами и инструкцией --}}
    <div class="space-y-6 lg:col-span-1">
      <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Расчет стоимости</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
          Чтобы рассчитать стоимость, просто кликните на карте, чтобы указать точки отправления и назначения.
        </p>
      </div>

      <div class="space-y-4">
        {{-- Поле "Откуда" --}}
        <div>
          <label for="from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Откуда</label>
          <div class="mt-1 flex rounded-md shadow-sm">
            <input type="text" id="from" value="{{ $from }}" readonly
              class="block w-full cursor-not-allowed rounded-none rounded-l-md border-gray-300 bg-gray-100 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900">
            <button wire:click="resetAddress('from')" type="button"
              class="relative -ml-px inline-flex items-center space-x-2 rounded-r-md border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-gray-300 dark:hover:bg-neutral-700">
              <span>Изменить</span>
            </button>
          </div>
        </div>

        {{-- Поле "Куда" --}}
        <div>
          <label for="to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Куда</label>
          <div class="mt-1 flex rounded-md shadow-sm">
            <input type="text" id="to" value="{{ $to }}" readonly
              class="block w-full cursor-not-allowed rounded-none rounded-l-md border-gray-300 bg-gray-100 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900">
            <button wire:click="resetAddress('to')" type="button"
              class="relative -ml-px inline-flex items-center space-x-2 rounded-r-md border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-gray-300 dark:hover:bg-neutral-700">
              <span>Изменить</span>
            </button>
          </div>
        </div>
      </div>

      @if ($distance)
        <div class="mt-4 border-t border-gray-200 pt-4 dark:border-neutral-700">
          <div class="flex items-center justify-between">
            <span class="text-gray-600 dark:text-gray-300">Расстояние:</span>
            <span class="font-bold text-gray-800 dark:text-white">{{ number_format($distance, 2) }} км</span>
          </div>
          <div class="mt-2 flex items-center justify-between">
            <span class="text-gray-600 dark:text-gray-300">Примерная стоимость:</span>
            <span class="text-lg font-bold text-primary-500">{{ number_format($cost) }} руб.</span>
          </div>

          {{-- Кнопка оформления заказа появляется здесь --}}
          <button wire:click="$emit('openOrderForm')"
            class="mt-6 w-full rounded-md bg-primary-500 px-4 py-2.5 font-semibold text-white transition hover:bg-primary-600">
            Оформить заказ
          </button>
        </div>
      @endif
    </div>

    {{-- Правая колонка с картой --}}
    <div class="lg:col-span-2">
      <div wire:ignore id="map" class="w-full rounded-lg shadow-md" style="min-height: 450px;"></div>
    </div>
  </div>

  {{-- Модальное окно для формы заказа --}}
  @livewire('order-form-modal', ['from' => $from, 'to' => $to, 'distance' => $distance, 'cost' => $cost])
</div>

@push('scripts')
  <script
    src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_maps.key') }}&lang=ru_RU&load=package.full">
  </script>
  <script>
    document.addEventListener('livewire:load', function() {
      let myMap;
      let placemarks = {
        from: null,
        to: null
      };

      function initMap() {
        if (document.getElementById('map')) {
          myMap = new ymaps.Map("map", {
            center: [59.9342802, 30.3350986], // Санкт-Петербург
            zoom: 10
          }, {
            searchControlProvider: 'yandex#search'
          });

          myMap.events.add('click', function(e) {
            const coords = e.get('coords');

            ymaps.geocode(coords).then(function(res) {
              const address = res.geoObjects.get(0).getAddressLine();

              if (!@this.get('from')) {
                @this.set('from', address);
                if (placemarks.from) myMap.geoObjects.remove(placemarks.from);
                placemarks.from = new ymaps.Placemark(coords, {
                  iconCaption: 'А'
                }, {
                  preset: 'islands#violetDotIconWithCaption'
                });
                myMap.geoObjects.add(placemarks.from);
              } else if (!@this.get('to')) {
                @this.set('to', address);
                if (placemarks.to) myMap.geoObjects.remove(placemarks.to);
                placemarks.to = new ymaps.Placemark(coords, {
                  iconCaption: 'Б'
                }, {
                  preset: 'islands#violetDotIconWithCaption'
                });
                myMap.geoObjects.add(placemarks.to);
                Livewire.emit('calculateRoute');
              }
            });
          });
        }
      }

      ymaps.ready(initMap);

      Livewire.on('calculateRoute', () => {
        const from = @this.get('from');
        const to = @this.get('to');
        if (from && to) {
          ymaps.route([from, to]).then(
            function(route) {
              myMap.geoObjects.add(route);
              const distance = route.getLength() / 1000;
              @this.call('setDistanceAndCost', distance);
            },
            function(error) {
              alert('Невозможно построить маршрут: ' + error.message);
            }
          );
        }
      });

      Livewire.on('resetAddress', (field) => {
        if (myMap) {
          if (field === 'from' && placemarks.from) {
            myMap.geoObjects.remove(placemarks.from);
            placemarks.from = null;
          }
          if (field === 'to' && placemarks.to) {
            myMap.geoObjects.remove(placemarks.to);
            placemarks.to = null;
          }
          // Очищаем все маршруты
          myMap.geoObjects.each(function(geoObject) {
            if (geoObject.getOverlay) { // Проверяем, является ли объект маршрутом
              myMap.geoObjects.remove(geoObject);
            }
          });
        }
      });
    });
  </script>
@endpush
