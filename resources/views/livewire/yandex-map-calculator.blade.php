<div class="rounded-2xl bg-white p-6 shadow-xl dark:bg-neutral-800 sm:p-8">
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    {{-- Левая колонка с формами и инструкцией --}}
    <div class="space-y-6 lg:col-span-1" id="form-container">
      <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Расчет стоимости</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
          Кликните на карте, чтобы указать точки отправления (А) и назначения (Б).
        </p>
      </div>

      <div class="space-y-4">
        {{-- Поля адресов и результаты --}}
        <div class="space-y-4 rounded-lg border p-4 dark:border-neutral-700">
          <div class="flex items-center">
            <span class="w-24 font-semibold text-gray-700 dark:text-gray-300">Откуда:</span>
            <input type="text" value="{{ $from }}" readonly
              class="w-full cursor-not-allowed border-0 bg-transparent p-0 text-gray-600 focus:ring-0 dark:text-gray-400">
          </div>
          <div class="flex items-center">
            <span class="w-24 font-semibold text-gray-700 dark:text-gray-300">Куда:</span>
            <input type="text" value="{{ $to }}" readonly
              class="w-full cursor-not-allowed border-0 bg-transparent p-0 text-gray-600 focus:ring-0 dark:text-gray-400">
          </div>
          @if ($distance)
            <div class="mt-4 space-y-2 border-t pt-4 dark:border-neutral-700">
              <div class="flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-300">Расстояние:</span>
                <span class="font-bold text-gray-800 dark:text-white">{{ number_format($distance, 2) }} км</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-300">Стоимость:</span>
                <span class="text-lg font-bold text-primary-500">{{ number_format($cost) }} руб.</span>
              </div>
            </div>
          @endif
        </div>
        <button wire:click="resetAddress('all')" type="button"
          class="w-full text-center text-sm text-primary-500 hover:underline">Очистить карту и начать заново</button>
      </div>

      {{-- Форма заказа --}}
      @if ($distance)
        <div class="relative">
          @if ($orderSubmittedSuccessfully)
            <div class="py-10 text-center">
              <i class="fas fa-check-circle mb-4 text-5xl text-green-500"></i>
              <h3 class="text-xl font-bold text-gray-800 dark:text-white">Заявка успешно отправлена!</h3>
              <p class="mt-2 text-gray-600 dark:text-gray-400">Мы скоро с вами свяжемся.</p>
              <button wire:click="newOrder"
                class="mt-6 w-full rounded-md bg-primary-500 px-4 py-2.5 font-semibold text-white transition hover:bg-primary-600">
                Новый расчет
              </button>
            </div>
          @else
            <h3 class="mb-4 text-xl font-bold text-gray-800 dark:text-white">Оформить заявку</h3>
            <form wire:submit.prevent="submitOrder" class="space-y-4">
              <input type="text" wire:model.defer="name"
                class="w-full rounded-md border-gray-300 bg-gray-50 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900"
                placeholder="Ваше имя*" required>
              <input type="tel" wire:model.defer="phone"
                class="w-full rounded-md border-gray-300 bg-gray-50 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900"
                placeholder="Ваш телефон*" required>
              <input type="email" wire:model.defer="email"
                class="w-full rounded-md border-gray-300 bg-gray-50 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900"
                placeholder="Ваш email">
              <textarea wire:model.defer="comment"
                class="w-full rounded-md border-gray-300 bg-gray-50 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900"
                placeholder="Комментарий"></textarea>
              <button type="submit"
                class="w-full rounded-md bg-primary-500 px-4 py-2.5 font-semibold text-white transition hover:bg-primary-600"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Оформить заказ</span>
                <span wire:loading>Отправка...</span>
              </button>
            </form>
          @endif
        </div>
      @endif
    </div>

    {{-- Правая колонка с картой --}}
    <div class="lg:col-span-2">
      <div wire:ignore id="map" class="w-full rounded-lg shadow-md" style="min-height: 450px;"></div>
    </div>
  </div>
</div>

@push('scripts')
  <script
    src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_maps.key') }}&lang=ru_RU&load=package.full">
  </script>
  <script>
    document.addEventListener('livewire:load', function() {
      let myMap;
      let route;
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
          if (route) myMap.geoObjects.remove(route);
          if (placemarks.from) myMap.geoObjects.remove(placemarks.from);
          if (placemarks.to) myMap.geoObjects.remove(placemarks.to);

          ymaps.route([from, to]).then(
            function(newRoute) {
              route = newRoute;
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
          myMap.geoObjects.removeAll();
          route = null;
          placemarks = {
            from: null,
            to: null
          };
        }
      });
    });
  </script>
@endpush
