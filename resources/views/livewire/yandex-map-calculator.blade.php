<div class="mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">

  {{-- Выбор транспорта --}}
  <section class="mb-8">
    <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Шаг 1: Выберите транспорт</h2>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      @foreach($vehicles as $veh)
        <div
          wire:click="selectVehicle({{ $veh->id }})"
          class="cursor-pointer rounded-lg border-2 p-4 transition-all hover:shadow-lg @if($vehicle_id == $veh->id) border-green-600 bg-green-50 dark:bg-green-900/20 @else border-gray-200 dark:border-gray-700 @endif">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $veh->name }}</h3>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $veh->description }}</p>
              <div class="mt-3 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <p><span class="font-medium">Грузоподъемность:</span> {{ $veh->capacity_tons }} т</p>
                <p><span class="font-medium">Размеры:</span> {{ $veh->length_m }}×{{ $veh->width_m }}×{{ $veh->height_m }} м</p>
                <div class="mt-2 flex items-center gap-4 text-sm">
                  <span class="font-semibold text-green-600 dark:text-green-400">{{ $veh->price_per_km }} ₽/км</span>
                  <span class="font-semibold text-green-600 dark:text-green-400">{{ $veh->price_per_hour }} ₽/ч</span>
                </div>
              </div>
            </div>
            @if($vehicle_id == $veh->id)
              <div class="ml-4">
                <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </section>

  {{-- Карта и маршрут --}}
  <section class="mb-8">
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Шаг 2: Укажите маршрут на карте</h2>
      <button
        wire:click="resetCalculator"
        class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
        <svg class="mr-2 inline-block h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Сбросить калькулятор
      </button>
    </div>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

      {{-- Левая панель: Точки маршрута --}}
      <div class="lg:col-span-1">
        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
          <h3 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Точки маршрута</h3>

          @if(empty($route_points))
            <p class="text-sm text-gray-500 dark:text-gray-400">Кликните на карте, чтобы указать точку отправления (A)</p>
          @elseif(count($route_points) == 1)
            <p class="text-sm text-gray-500 dark:text-gray-400">Теперь укажите точку назначения (B)</p>
          @endif

          @foreach($route_points as $index => $point)
            <div class="mb-3 rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-600 dark:bg-gray-700">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <div class="flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-green-600 text-xs font-bold text-white">
                      {{ $index == 0 ? 'A' : ($index == count($route_points) - 1 ? 'B' : chr(66 + $index)) }}
                    </span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                      {{ $index == 0 ? 'Откуда' : ($index == count($route_points) - 1 ? 'Куда' : 'Промежуточная') }}
                    </span>
                  </div>
                  <p class="mt-1 text-xs text-gray-600 dark:text-gray-300">{{ $point['address'] }}</p>
                  @if(!empty($point['details']))
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                      @if(!empty($point['details']['building'])) Дом: {{ $point['details']['building'] }} @endif
                      @if(!empty($point['details']['entrance'])) Подъезд: {{ $point['details']['entrance'] }} @endif
                      @if(!empty($point['details']['floor'])) Этаж: {{ $point['details']['floor'] }} @endif
                    </div>
                  @endif
                </div>
                @if($index > 0)
                  <button
                    wire:click="removeRoutePoint({{ $index }})"
                    class="ml-2 text-red-500 hover:text-red-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                @endif
              </div>
            </div>
          @endforeach

          @if(count($route_points) >= 2)
            <button
              onclick="addIntermediatePoint()"
              class="mt-2 w-full rounded-lg border-2 border-dashed border-gray-300 px-4 py-3 text-sm font-medium text-gray-600 transition-colors hover:border-green-500 hover:text-green-600 dark:border-gray-600 dark:text-gray-400">
              + Добавить промежуточную точку
            </button>
          @endif
        </div>

        {{-- Расчет расстояния --}}
        @if($distance > 0)
          <div class="mt-4 rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-900 dark:bg-green-900/20">
            <div class="flex items-center justify-between">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Расстояние:</span>
              <span class="text-lg font-bold text-green-600 dark:text-green-400">{{ number_format($distance, 1) }} км</span>
            </div>
            <div class="mt-2 flex items-center justify-between">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Примерное время:</span>
              <input
                type="number"
                wire:model.debounce.500ms="estimated_hours"
                wire:change="recalculate"
                min="0.5"
                step="0.5"
                class="w-20 rounded border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-700"
              /> <span class="ml-1 text-sm text-gray-600 dark:text-gray-400">часов</span>
            </div>
          </div>
        @endif
      </div>

      {{-- Карта --}}
      <div class="lg:col-span-2">
        <div
          wire:ignore
          id="map"
          class="h-[400px] w-full rounded-lg border border-gray-200 dark:border-gray-700 lg:h-[600px]"
        ></div>
      </div>
    </div>
  </section>

  {{-- Дополнительные услуги и опции --}}
  @if($distance > 0)
    <section class="mb-8">
      <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Шаг 3: Дополнительные услуги и опции</h2>

      <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Услуги --}}
        @if($services->count() > 0)
          <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Дополнительные услуги</h3>
            <div class="space-y-3">
              @foreach($services as $service)
                <label class="flex cursor-pointer items-start rounded-lg border p-3 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700 @if(in_array($service->id, $selected_services)) border-green-500 bg-green-50 dark:bg-green-900/20 @else border-gray-200 @endif">
                  <input
                    type="checkbox"
                    wire:click="toggleService({{ $service->id }})"
                    @if(in_array($service->id, $selected_services)) checked @endif
                    class="mt-1 h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                  <div class="ml-3 flex-1">
                    <div class="flex items-center justify-between">
                      <span class="font-medium text-gray-900 dark:text-white">{{ $service->name }}</span>
                      <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ number_format($service->price, 0) }} ₽</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $service->description }}</p>
                  </div>
                </label>
              @endforeach
            </div>
          </div>
        @endif

        {{-- Опции --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
          <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Дополнительные опции</h3>
          <div class="space-y-4">

            {{-- Грузчики --}}
            @if($loaderOption)
              <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                <div class="flex items-center justify-between">
                  <div>
                    <label class="font-medium text-gray-900 dark:text-white">Грузчики</label>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($loaderOption->price_per_hour, 0) }} ₽/час за человека (макс: {{ $loaderOption->max_quantity }})</p>
                  </div>
                  <div class="flex items-center gap-2">
                    <button
                      wire:click="updateLoadersCount({{ $loaders_count - 1 }})"
                      class="rounded-lg bg-gray-200 px-3 py-1 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                      @if($loaders_count <= 0) disabled @endif>
                      −
                    </button>
                    <span class="w-8 text-center font-bold">{{ $loaders_count }}</span>
                    <button
                      wire:click="updateLoadersCount({{ $loaders_count + 1 }})"
                      class="rounded-lg bg-gray-200 px-3 py-1 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                      @if($loaders_count >= $loaderOption->max_quantity) disabled @endif>
                      +
                    </button>
                  </div>
                </div>
              </div>
            @endif

            {{-- Пассажиры --}}
            @if($passengerOption && $vehicle && $vehicle->allows_passengers)
              <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                <div class="flex items-center justify-between">
                  <div>
                    <label class="font-medium text-gray-900 dark:text-white">Пассажиры</label>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($passengerOption->price_per_hour, 0) }} ₽/час за человека (макс: {{ $vehicle->max_passengers }})</p>
                  </div>
                  <div class="flex items-center gap-2">
                    <button
                      wire:click="updatePassengersCount({{ $passengers_count - 1 }})"
                      class="rounded-lg bg-gray-200 px-3 py-1 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                      @if($passengers_count <= 0) disabled @endif>
                      −
                    </button>
                    <span class="w-8 text-center font-bold">{{ $passengers_count }}</span>
                    <button
                      wire:click="updatePassengersCount({{ $passengers_count + 1 }})"
                      class="rounded-lg bg-gray-200 px-3 py-1 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                      @if($passengers_count >= $vehicle->max_passengers) disabled @endif>
                      +
                    </button>
                  </div>
                </div>
              </div>
            @endif

            {{-- Этажи --}}
            @if($floorOption)
              <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                <div class="mb-3">
                  <label class="font-medium text-gray-900 dark:text-white">Подъем на этаж</label>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($floorOption->price_per_floor, 0) }} ₽ за этаж (макс: {{ $floorOption->max_quantity }})</p>
                </div>
                <div class="flex items-center gap-3">
                  <div class="flex items-center gap-2">
                    <button
                      wire:click="updateFloorsCount({{ $floors_count - 1 }})"
                      class="rounded-lg bg-gray-200 px-3 py-1 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                      @if($floors_count <= 0) disabled @endif>
                      −
                    </button>
                    <span class="w-8 text-center font-bold">{{ $floors_count }}</span>
                    <button
                      wire:click="updateFloorsCount({{ $floors_count + 1 }})"
                      class="rounded-lg bg-gray-200 px-3 py-1 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                      @if($floors_count >= $floorOption->max_quantity) disabled @endif>
                      +
                    </button>
                  </div>
                  <label class="flex items-center text-sm">
                    <input
                      type="checkbox"
                      wire:click="toggleCargoElevator"
                      @if($has_cargo_elevator) checked @endif
                      class="mr-2 h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span class="text-gray-700 dark:text-gray-300">Есть грузовой лифт</span>
                  </label>
                </div>
              </div>
            @endif

          </div>
        </div>
      </div>
    </section>

    {{-- Детализация стоимости --}}
    <section class="mb-8">
      <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Итоговая стоимость</h2>
      <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
        <div class="space-y-3">
          <div class="flex justify-between text-gray-700 dark:text-gray-300">
            <span>Расстояние ({{ number_format($distance, 1) }} км × {{ number_format($vehicle->price_per_km, 0) }} ₽/км)</span>
            <span class="font-semibold">{{ number_format($base_distance_cost, 0) }} ₽</span>
          </div>
          <div class="flex justify-between text-gray-700 dark:text-gray-300">
            <span>Время ({{ number_format($vehicle->price_per_hour, 0) }} ₽/ч)</span>
            <span class="font-semibold">{{ number_format($base_time_cost, 0) }} ₽</span>
          </div>
          @if($services_cost > 0)
            <div class="flex justify-between text-gray-700 dark:text-gray-300">
              <span>Дополнительные услуги</span>
              <span class="font-semibold">{{ number_format($services_cost, 0) }} ₽</span>
            </div>
          @endif
          @if($loaders_count > 0)
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
              <span>• Грузчики: {{ $loaders_count }} × {{ number_format($loader_price, 0) }} ₽/ч × 2 ч</span>
              <span class="font-medium">{{ number_format($loaders_count * $loader_price * $estimated_hours, 0) }} ₽</span>
            </div>
          @endif
          @if($passengers_count > 0)
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
              <span>• Пассажиры: {{ $passengers_count }} × {{ number_format($passenger_price, 0) }} ₽/ч × 2 ч</span>
              <span class="font-medium">{{ number_format($passengers_count * $passenger_price * $estimated_hours, 0) }} ₽</span>
            </div>
          @endif
          @if($floors_count > 0 && !$has_cargo_elevator)
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
              <span>• Этажи: {{ $floors_count }} × {{ number_format($floor_price, 0) }} ₽</span>
              <span class="font-medium">{{ number_format($floors_count * $floor_price, 0) }} ₽</span>
            </div>
          @endif
          <div class="border-t border-gray-300 pt-3 dark:border-gray-600">
            <div class="flex justify-between text-xl font-bold text-green-600 dark:text-green-400">
              <span>ИТОГО:</span>
              <span>{{ number_format($total_cost, 0) }} ₽</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Форма заказа --}}
    <section>
      <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Шаг 4: Оформить заявку</h2>

      <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800">
        <div class="relative">
          @if ($orderSubmittedSuccessfully)
            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center rounded-lg bg-gray-500 bg-opacity-75 p-4 text-center text-white">
              <svg class="mb-4 h-16 w-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <h3 class="mb-2 text-2xl font-bold">Заявка успешно отправлена!</h3>
              <p class="mb-4">Мы скоро с вами свяжемся.</p>
              <button wire:click="newOrder" class="rounded-lg bg-green-600 px-6 py-3 font-bold text-white hover:bg-green-700">
                Оформить новую заявку
              </button>
            </div>
          @endif

          <form wire:submit.prevent="submitOrder" class="{{ $orderSubmittedSuccessfully ? 'pointer-events-none opacity-25' : '' }}">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Ваше имя*</label>
                <input
                  type="text"
                  wire:model.defer="name"
                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                  required>
                @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Телефон*</label>
                <input
                  type="tel"
                  wire:model.defer="phone"
                  id="phone"
                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                  placeholder="+7 (___) ___-__-__"
                  required>
                @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email*</label>
                <input
                  type="email"
                  wire:model.defer="email"
                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                  required>
                @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Комментарий</label>
                <textarea
                  wire:model.defer="comment"
                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                  rows="1"></textarea>
                @error('comment') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
              </div>
            </div>

            <button
              type="submit"
              class="mt-6 w-full rounded-lg bg-green-600 px-6 py-3 font-bold text-white transition-colors hover:bg-green-700"
              wire:loading.attr="disabled">
              <span wire:loading.remove>Оформить заказ</span>
              <span wire:loading>Отправка...</span>
            </button>
          </form>

          @if ($showError)
            <div class="mt-4 flex items-center justify-between rounded-lg border border-red-400 bg-red-100 p-4 text-red-700">
              <span>Не удалось отправить заявку. Попробуйте позже.</span>
              <button wire:click="resetForm" class="rounded bg-red-500 px-3 py-1 font-bold text-white hover:bg-red-600">
                ОК
              </button>
            </div>
          @endif
        </div>
      </div>
    </section>
  @endif

</div>

{{-- Скрипты для карты --}}
@push('scripts')
<script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_maps.key') }}&lang=ru_RU&load=package.full" type="text/javascript"></script>
<script>
document.addEventListener('livewire:load', function() {
  let myMap;
  let placemarksArray = [];
  let currentRoute = null;

  function initMap() {
    if (!document.getElementById('map')) return;

    myMap = new ymaps.Map("map", {
      center: [59.9342802, 30.3350986], // Санкт-Петербург
      zoom: 10,
      controls: ['zoomControl']
    });

    // Клик по карте для добавления точки
    myMap.events.add('click', function(e) {
      const coords = e.get('coords');

      ymaps.geocode(coords).then(function(res) {
        const firstGeoObject = res.geoObjects.get(0);
        const address = firstGeoObject.getAddressLine();

        // Вызываем метод Livewire для добавления точки
        @this.call('addRoutePoint', address, coords, {});

        // Добавляем маркер
        addPlacemark(coords, placemarksArray.length);

        // Если есть 2+ точки, строим маршрут
        if (placemarksArray.length >= 2) {
          buildRoute();
        }
      });
    });
  }

  function addPlacemark(coords, index) {
    const labels = ['A', 'B', 'C', 'D', 'E', 'F'];
    const placemark = new ymaps.Placemark(coords, {
      iconCaption: labels[index] || (index + 1).toString()
    }, {
      preset: 'islands#greenDotIconWithCaption'
    });

    myMap.geoObjects.add(placemark);
    placemarksArray.push(placemark);
  }

  function buildRoute() {
    if (currentRoute) {
      myMap.geoObjects.remove(currentRoute);
    }

    const points = placemarksArray.map(pm => pm.geometry.getCoordinates());

    ymaps.route(points, {
      mapStateAutoApply: true
    }).then(function(route) {
      currentRoute = route;
      myMap.geoObjects.add(route);

      const distance = route.getLength() / 1000; // в километрах
      @this.set('distance', distance.toFixed(2));
      @this.call('recalculate');
    });
  }

  function clearMap() {
    placemarksArray.forEach(pm => myMap.geoObjects.remove(pm));
    placemarksArray = [];

    if (currentRoute) {
      myMap.geoObjects.remove(currentRoute);
      currentRoute = null;
    }
  }

  // Инициализация карты при загрузке Яндекс.Карт
  ymaps.ready(initMap);

  // Слушаем события от Livewire
  window.addEventListener('new-order-started', () => {
    clearMap();
  });

  // Сброс калькулятора
  Livewire.on('resetMap', () => {
    clearMap();
  });

  // Обновление маркеров при изменении точек маршрута
  Livewire.on('routePointRemoved', () => {
    clearMap();
    // Перестраиваем маркеры из текущих данных
    const routePoints = @this.get('route_points');
    routePoints.forEach((point, index) => {
      addPlacemark(point.coords, index);
    });
    if (routePoints.length >= 2) {
      buildRoute();
    }
  });
});

// Маска телефона
document.addEventListener('DOMContentLoaded', function() {
  const phoneInput = document.getElementById('phone');
  if (!phoneInput) return;

  const format = (value) => {
    const digits = value.replace(/\D/g, '');
    let result = '+7 ';
    let d = digits;
    if (d.startsWith('8')) d = '7' + d.slice(1);
    if (!d.startsWith('7')) d = '7' + d;
    const num = d.slice(1);
    if (num.length > 0) result += '(' + num.substring(0, 3);
    if (num.length >= 3) result += ') ' + num.substring(3, 6);
    if (num.length >= 6) result += '-' + num.substring(6, 8);
    if (num.length >= 8) result += '-' + num.substring(8, 10);
    return result;
  };

  phoneInput.addEventListener('input', () => {
    phoneInput.value = format(phoneInput.value);
  });

  phoneInput.addEventListener('focus', () => {
    if (phoneInput.value.trim() === '') phoneInput.value = '+7 ';
  });
});
</script>
@endpush
