<div class="p-4 sm:p-6 lg:p-8">
  <div class="grid grid-cols-1 gap-8 md:grid-cols-3" id="calculator-container">
    {{-- Левая колонка с формами --}}
    <div class="space-y-6 md:col-span-2" id="form-container">
      {{-- Форма калькулятора --}}
      <div class="rounded-lg bg-white p-6 shadow-md">
        <h2 class="mb-4 text-xl font-semibold">Калькулятор стоимости</h2>
        <div class="space-y-4">
          <input wire:model.debounce.500ms="from" type="text" id="from" placeholder="Откуда"
            class="w-full rounded-md border px-4 py-2">
          <input wire:model.debounce.500ms="to" type="text" id="to" placeholder="Куда"
            class="w-full rounded-md border px-4 py-2">
          <button wire:click="calculate"
            class="w-full rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Рассчитать</button>
        </div>
        @if ($distance)
          <div class="mt-4 text-gray-700">
            <p><strong>Расстояние:</strong> {{ number_format($distance, 2) }} км.</p>
            <p><strong>Примерная стоимость:</strong> {{ number_format($cost) }} руб.</p>
          </div>
        @endif
      </div>

      {{-- Форма заказа --}}
      @if ($distance)
        <div class="rounded-lg bg-white p-6 shadow-md">
          <h2 class="mb-4 text-xl font-semibold">Оформить заявку</h2>
          <form wire:submit.prevent="submitOrder" class="space-y-4">
            <input wire:model.defer="name" type="text" placeholder="Ваше имя" required
              class="w-full rounded-md border px-4 py-2">
            @error('name')
              <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror

            <input wire:model.defer="phone" type="tel" placeholder="Ваш телефон" required
              class="w-full rounded-md border px-4 py-2">
            @error('phone')
              <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror

            <input wire:model.defer="email" type="email" placeholder="Ваш Email" required
              class="w-full rounded-md border px-4 py-2">
            @error('email')
              <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror

            <button type="submit"
              class="w-full rounded-md bg-green-500 px-4 py-2 text-white hover:bg-green-600">Отправить заявку</button>
          </form>
          @if (session()->has('message'))
            <div class="mt-4 text-green-600">
              {{ session('message') }}
            </div>
          @endif
        </div>
      @endif
    </div>

    {{-- Правая колонка с картой --}}
    <div class="md:col-span-1">
      <div wire:ignore id="map" class="w-full rounded-lg shadow-md" style="min-height: 400px;"></div>
    </div>
  </div>
</div>

@push('scripts')
  <script
    src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_maps.key') }}&lang=ru_RU&load=package.full"
    type="text/javascript"></script>
  <script>
    document.addEventListener('livewire:load', function() {
      let myMap;
      let routePoints = [];

      function adjustMapHeight() {
        const formContainer = document.getElementById('form-container');
        const mapElem = document.getElementById('map');
        if (window.innerWidth > 768) { // md breakpoint
          mapElem.style.height = `${formContainer.offsetHeight}px`;
        } else {
          mapElem.style.height = '400px'; // default height for mobile
        }
        
        // Если карта инициализирована, обновляем её размер
        if (myMap) {
          myMap.container.fitToViewport();
        }
      }

      function initMap() {
        if (document.getElementById('map')) {
          // Сначала устанавливаем высоту карты перед инициализацией
          adjustMapHeight();

          myMap = new ymaps.Map("map", {
            center: [59.9342802, 30.3350986], // Санкт-Петербург
            zoom: 10
          });

          // Обработчик события готовности карты
          myMap.events.add('sizechange', function() {
            myMap.container.fitToViewport();
          });

          // Вызываем обновление размера карты после инициализации
          setTimeout(() => {
            myMap.container.fitToViewport();
          }, 100);

          new ymaps.SuggestView('from');
          new ymaps.SuggestView('to');

          myMap.events.add('click', function(e) {
            const coords = e.get('coords');

            if (routePoints.length >= 2) {
              routePoints = [];
              myMap.geoObjects.removeAll();
            }

            ymaps.geocode(coords).then(function(res) {
              const firstGeoObject = res.geoObjects.get(0);
              const address = firstGeoObject.getAddressLine();

              if (routePoints.length === 0) {
                @this.set('from', address);
                routePoints.push(coords);
                myMap.geoObjects.add(new ymaps.Placemark(coords, {
                  iconCaption: 'А'
                }));
              } else {
                @this.set('to', address);
                routePoints.push(coords);
                myMap.geoObjects.add(new ymaps.Placemark(coords, {
                  iconCaption: 'Б'
                }));
                @this.call('calculate');
              }
            });
          });

          adjustMapHeight();
        }
      }

      ymaps.ready(initMap);

      // Обработчик изменения размера окна
      window.addEventListener('resize', function() {
        adjustMapHeight();
        if (myMap) {
          myMap.container.fitToViewport();
        }
      });

      // Перерисовываем карту и подгоняем высоту, когда Livewire обновил DOM
      Livewire.on('updated', () => {
        setTimeout(() => {
          adjustMapHeight();
        }, 100);
      });
      
      // Обработчик события для обновления карты при отправке формы заказа
      Livewire.on('orderSubmitted', () => {
        setTimeout(() => {
          adjustMapHeight();
        }, 200);
      });
      
      // Используем MutationObserver для отслеживания изменений в DOM
      const formContainer = document.getElementById('form-container');
      if (formContainer) {
        const observer = new MutationObserver(function(mutations) {
          setTimeout(adjustMapHeight, 100);
        });
        
        observer.observe(formContainer, {
          childList: true,
          subtree: true,
          attributes: false
        });
      }

      // Дополнительная проверка после полной загрузки страницы
      window.addEventListener('load', function() {
        if (myMap) {
          adjustMapHeight();
          myMap.container.fitToViewport();
        }
      });


      window.addEventListener('calculate-route', event => {
        const from = event.detail.from;
        const to = event.detail.to;
        const pricePerKm = event.detail.price_per_km;

        if (!from || !to) return;

        myMap.geoObjects.removeAll();

        ymaps.route([from, to]).then(function(route) {
          myMap.geoObjects.add(route);
          const distance = route.getLength() / 1000;
          const cost = Math.round(distance * pricePerKm);

          @this.set('distance', distance);
          @this.set('cost', cost);
          
          // Обновляем размер карты после расчета маршрута
          setTimeout(adjustMapHeight, 200);
        }, function(error) {
          console.error('Ошибка построения маршрута: ', error.message);
        });
      });
    });
  </script>
@endpush
