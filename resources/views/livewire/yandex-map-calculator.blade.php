<div class="p-4 sm:p-6 lg:p-8">
  <div class="grid grid-cols-1 gap-6 md:grid-cols-2" id="calculator-container">
    {{-- Левая колонка с формами --}}
    <div class="space-y-6 md:col-span-1" id="form-container">
      {{-- Форма калькулятора --}}
      <div class="rounded-lg bg-gray-50 dark:bg-neutral-800 p-6 shadow-md border border-gray-200 dark:border-neutral-700">
        <h2 class="mb-2 text-xl font-semibold">Калькулятор стоимости</h2>
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Выберите две точки на карте: сначала точку А (откуда), затем точку Б (куда). Поля заполнятся автоматически.</p>
        <div class="space-y-3">
          <input wire:model.debounce.500ms="from" type="text" id="from" placeholder="Откуда (выберите на карте)" readonly
            class="w-full rounded-md border-gray-300 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-900 px-4 py-2 focus:ring-primary-500 focus:border-primary-500 cursor-not-allowed">
          <input wire:model.debounce.500ms="to" type="text" id="to" placeholder="Куда (выберите на карте)" readonly
            class="w-full rounded-md border-gray-300 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-900 px-4 py-2 focus:ring-primary-500 focus:border-primary-500 cursor-not-allowed">
          <button wire:click="calculate"
            class="w-full rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Рассчитать</button>
        </div>
        @if ($distance)
          <div class="mt-4">
            <p><strong>Расстояние:</strong> {{ number_format($distance, 2) }} км.</p>
            <p><strong>Примерная стоимость:</strong> {{ number_format($cost) }} руб.</p>
          </div>
        @endif
      </div>

      {{-- Форма заказа --}}
      @if ($distance)
        <div class="rounded-lg bg-gray-50 dark:bg-neutral-800 p-6 shadow-md border border-gray-200 dark:border-neutral-700">
          <h2 class="mb-4 text-xl font-semibold">Оформить заявку</h2>
          <div class="relative">
            @if ($orderSubmittedSuccessfully)
              <div
                class="absolute inset-0 z-10 flex flex-col items-center justify-center rounded-lg bg-gray-500 bg-opacity-75 p-4 text-center text-white">
                <svg class="mb-4 h-16 w-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-2 text-2xl font-bold">Заявка успешно отправлена!</h3>
                <p class="mb-4">Мы скоро с вами свяжемся.</p>
                <button wire:click="newOrder"
                  class="rounded bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-600">
                  Оформить новую заявку
                </button>
              </div>
            @endif

            <form wire:submit.prevent="submitOrder"
              class="{{ $orderSubmittedSuccessfully ? 'opacity-25 pointer-events-none' : '' }} space-y-4">
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="hidden">
                  <input type="text" wire:model.defer="from" readonly>
                  <input type="text" wire:model.defer="to" readonly>
                  <input type="text" wire:model.defer="distance" readonly>
                  <input type="text" wire:model.defer="cost" readonly>
                </div>

                <input type="text" wire:model.defer="name" class="w-full rounded-md border-gray-300 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-900 px-4 py-2 focus:ring-primary-500 focus:border-primary-500"
                  placeholder="Ваше имя*" required>
                @error('name')
                  <span class="text-sm text-danger-500">{{ $message }}</span>
                @enderror

                <input type="tel" wire:model.defer="phone" id="phone" inputmode="tel" pattern="^\+7\s?\(?\d{3}\)?\s?\d{3}[-\s]?\d{2}[-\s]?\d{2}$" class="w-full rounded-md border-gray-300 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-900 px-4 py-2 focus:ring-primary-500 focus:border-primary-500"
                  placeholder="+7 (___) ___-__-__" required>
                @error('phone')
                  <span class="text-sm text-danger-500">{{ $message }}</span>
                @enderror

                <input type="email" wire:model.defer="email" class="w-full rounded-md border-gray-300 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-900 px-4 py-2 focus:ring-primary-500 focus:border-primary-500"
                  placeholder="Ваш email*" required>
                @error('email')
                  <span class="text-sm text-danger-500">{{ $message }}</span>
                @enderror

                <textarea wire:model.defer="comment" class="w-full rounded-md border-gray-300 dark:border-neutral-700 bg-gray-100 dark:bg-neutral-900 px-4 py-2 md:col-span-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Комментарий"></textarea>
                @error('comment')
                  <span class="text-sm text-danger-500 md:col-span-2">{{ $message }}</span>
                @enderror
              </div>
              <button type="submit" class="mt-4 w-full rounded-md bg-accent-500 px-4 py-2 text-white hover:bg-accent-600"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Оформить заказ</span>
                <span wire:loading>Отправка...</span>
              </button>
            </form>

            @if ($showError)
              <div
                class="mt-4 flex items-center justify-between rounded border border-danger-400 bg-danger-100 p-4 text-danger-700">
                <span>Не удалось отправить заявку. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.</span>
                <button wire:click="resetForm"
                  class="rounded bg-danger-500 px-3 py-1 font-bold text-white hover:bg-danger-600">
                  Попробовать снова
                </button>
              </div>
            @endif
          </div>
        </div>
      @endif
    </div>

    {{-- Правая колонка с картой --}}
    <div class="md:col-span-1">
      <div wire:ignore id="map" class="w-full rounded-lg shadow-md border border-gray-200 dark:border-neutral-700" style="min-height: 200px;"></div>
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

          // Поля адресов только для отображения, выбор делается кликами по карте

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

      // Синхронизация после обновления Livewire
      Livewire.on('updated', () => {
          // Небольшая задержка, чтобы DOM успел полностью перерисоваться
          setTimeout(syncMapHeight, 150);
      });

      // Принудительная синхронизация по событию из PHP
      window.addEventListener('force-map-sync', event => {
          setTimeout(syncMapHeight, 50);
      });

      window.addEventListener('new-order-started', event => {
          if (myMap) {
              myMap.geoObjects.removeAll();
              routePoints = []; // Очищаем массив точек
          }
      });

      window.addEventListener('calculate-route', event => {
          const from = event.detail.from;
          const to = event.detail.to;
          const pricePerKm = event.detail.price_per_km;

          if (!from || !to) return;

          // Очищаем предыдущий маршрут перед построением нового
          myMap.geoObjects.removeAll();
          routePoints = []; // Также очищаем точки здесь

          ymaps.route([from, to]).then(function(route) {
              // Добавляем метки в начало и конец маршрута
              const points = route.getWayPoints();
              myMap.geoObjects.add(new ymaps.Placemark(points.get(0).geometry.getCoordinates(), { iconCaption: 'А' }));
              myMap.geoObjects.add(new ymaps.Placemark(points.get(1).geometry.getCoordinates(), { iconCaption: 'Б' }));

              // Добавляем саму линию маршрута
              myMap.geoObjects.add(route);

              const distance = route.getLength() / 1000;
              const cost = Math.round(distance * pricePerKm);

              @this.set('distance', distance);
              @this.set('cost', cost);
          }, function(error) {
              console.error('Ошибка построения маршрута: ', error.message);
          });
      });
    });
  </script>
  <script>
    // Маска телефона РФ: +7 (XXX) XXX-XX-XX
    document.addEventListener('DOMContentLoaded', function() {
      const phoneInput = document.getElementById('phone');
      if (!phoneInput) return;

      const format = (value) => {
        const digits = value.replace(/\D/g, '');
        let result = '+7 ';
        // Обрезаем к 11-ти, включая ведущую 7
        let d = digits;
        if (d.startsWith('8')) d = '7' + d.slice(1);
        if (!d.startsWith('7')) d = '7' + d; // принудительно +7
        const num = d.slice(1); // без ведущей 7
        if (num.length > 0) result += '(' + num.substring(0, 3);
        if (num.length >= 3) result += ') ' + num.substring(3, 6);
        if (num.length >= 6) result += '-' + num.substring(6, 8);
        if (num.length >= 8) result += '-' + num.substring(8, 10);
        return result;
      };

      const handle = (e) => {
        const caretEnd = phoneInput.selectionEnd;
        phoneInput.value = format(phoneInput.value);
      };

      phoneInput.addEventListener('input', handle);
      phoneInput.addEventListener('focus', () => {
        if (phoneInput.value.trim() === '') phoneInput.value = '+7 ';
      });
      phoneInput.addEventListener('blur', () => {
        if (phoneInput.value.replace(/\D/g, '').length < 11) {
          // оставим как есть — серверная валидация покажет ошибку
        }
      });
    });
  </script>
  <script>
    document.addEventListener('livewire:load', function() {
      window.addEventListener('show-notification', event => {
        const container = document.getElementById('notification-container');
        if (!container) return;

        const notification = document.createElement('div');
        const typeClass = event.detail.type === 'success' ? 'bg-green-500' : 'bg-red-500';

        notification.className = `p-4 rounded-lg text-white ${typeClass} shadow-lg animate-fade-in-up mb-2`;
        notification.textContent = event.detail.message;

        container.appendChild(notification);

        setTimeout(() => {
          notification.remove();
        }, 5000);
      });
    });
  </script>
@endpush
