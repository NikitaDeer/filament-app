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
          <div class="relative">
            @if ($orderSubmittedSuccessfully)
              <div
                class="absolute inset-0 z-10 flex flex-col items-center justify-center rounded-lg bg-gray-500 bg-opacity-75 p-4 text-center text-white transition-opacity duration-300 ease-in-out">
                <svg class="mb-4 h-16 w-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-2 text-2xl font-bold">Заявка успешно отправлена!</h3>
                <p>Мы скоро с вами свяжемся.</p>
              </div>
            @endif

            <form wire:submit.prevent="submitOrder"
              class="{{ $orderSubmittedSuccessfully ? 'opacity-50 pointer-events-none' : '' }} space-y-4">
              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="hidden">
                  <input type="text" wire:model.defer="from" readonly>
                  <input type="text" wire:model.defer="to" readonly>
                  <input type="text" wire:model.defer="distance" readonly>
                  <input type="text" wire:model.defer="cost" readonly>
                </div>

                <input type="text" wire:model.defer="name" class="w-full rounded-md border px-4 py-2"
                  placeholder="Ваше имя*" required :disabled="$orderSubmittedSuccessfully">
                @error('name')
                  <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror

                <input type="tel" wire:model.defer="phone" class="w-full rounded-md border px-4 py-2"
                  placeholder="Ваш телефон*" required :disabled="$orderSubmittedSuccessfully">
                @error('phone')
                  <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror

                <input type="email" wire:model.defer="email" class="w-full rounded-md border px-4 py-2"
                  placeholder="Ваш email*" required :disabled="$orderSubmittedSuccessfully">
                @error('email')
                  <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror

                <textarea wire:model.defer="comment" class="w-full rounded-md border px-4 py-2 md:col-span-2" placeholder="Комментарий"
                  :disabled="$orderSubmittedSuccessfully"></textarea>
                @error('comment')
                  <span class="text-sm text-red-500 md:col-span-2">{{ $message }}</span>
                @enderror
              </div>
              <button type="submit"
                class="mt-4 w-full rounded-md bg-blue-500 px-4 py-2 text-white transition-colors duration-300 hover:bg-blue-600"
                wire:loading.attr="disabled" :disabled="$orderSubmittedSuccessfully">
                <span wire:loading.remove>Оформить заказ</span>
                <span wire:loading>Отправка...</span>
              </button>
            </form>

            @error('general')
              <div class="mt-4 rounded border border-red-400 bg-red-100 p-4 text-red-700">
                {{ $message }}
              </div>
            @enderror
          </div>
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

      // Обработчик события show-notification
      window.addEventListener('show-notification', function(event) {
        const notificationContainer = document.getElementById('notification-container');
        if (!notificationContainer) return;

        const type = event.detail.type;
        const message = event.detail.message;

        // Создаем элемент уведомления с улучшенным стилем
        const notification = document.createElement('div');
        notification.className =
          `p-4 rounded-md mb-4 shadow-md ${type === 'error' ? 'bg-red-50 text-red-700 border-l-4 border-red-500' : 'bg-green-50 text-green-700 border-l-4 border-green-500'}`;
        notification.style.animation = 'fadeIn 0.5s';

        // Создаем содержимое уведомления
        const content = document.createElement('div');
        content.className = 'flex items-center';

        // Добавляем иконку
        const icon = document.createElement('svg');
        icon.className = 'w-6 h-6 mr-3';
        icon.setAttribute('fill', 'currentColor');
        icon.setAttribute('viewBox', '0 0 20 20');
        icon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');

        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('fill-rule', 'evenodd');
        if (type === 'error') {
          path.setAttribute('d',
            'M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z'
          );
        } else {
          path.setAttribute('d',
            'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z'
          );
        }
        path.setAttribute('clip-rule', 'evenodd');
        icon.appendChild(path);

        // Добавляем текст сообщения с улучшенным стилем
        const textContainer = document.createElement('div');
        textContainer.className = 'flex-1';

        const text = document.createElement('p');
        text.className = 'font-medium';
        text.textContent = message;
        textContainer.appendChild(text);

        // Добавляем кнопку закрытия
        const closeButton = document.createElement('button');
        closeButton.className = 'ml-auto text-gray-400 hover:text-gray-600';
        closeButton.innerHTML =
          '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>';
        closeButton.onclick = function() {
          hideNotification(notification);
        };

        // Собираем уведомление
        content.appendChild(icon);
        content.appendChild(textContainer);
        content.appendChild(closeButton);
        notification.appendChild(content);

        // Очищаем контейнер и добавляем новое уведомление
        notificationContainer.innerHTML = '';
        notificationContainer.appendChild(notification);

        // Прокручиваем к уведомлению с плавной анимацией
        notification.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });

        // Добавляем стили анимации
        const style = document.createElement('style');
        if (!document.querySelector('#notification-styles')) {
          style.id = 'notification-styles';
          style.textContent = `
            @keyframes fadeIn {
              from { opacity: 0; transform: translateY(-10px); }
              to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeOut {
              from { opacity: 1; transform: translateY(0); }
              to { opacity: 0; transform: translateY(-10px); }
            }
          `;
          document.head.appendChild(style);
        }

        // Функция для скрытия уведомления
        function hideNotification(notif) {
          notif.style.animation = 'fadeOut 0.5s';
          setTimeout(() => {
            if (notificationContainer.contains(notif)) {
              notificationContainer.removeChild(notif);
            }
          }, 500);
        }

        // Автоматически скрываем уведомление через 10 секунд
        setTimeout(() => {
          hideNotification(notification);
        }, 10000);
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
