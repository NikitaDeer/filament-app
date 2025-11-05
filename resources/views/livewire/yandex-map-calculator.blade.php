<div class="mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">

  {{-- Карусель транспорта --}}
  <section class="mb-8">
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Выберите транспорт</h2>
      <a href="{{ route('vehicles.index') }}"
         class="text-sm text-green-600 hover:text-green-700 hover:underline dark:text-green-400">
        Посмотреть весь автопарк →
      </a>
    </div>

    <div x-data="{
      currentSlide: 0,
      vehicles: @js($vehicles->values()->toArray()),
      get visibleVehicles() {
        return [
          this.vehicles[this.currentSlide],
          this.vehicles[(this.currentSlide + 1) % this.vehicles.length],
          this.vehicles[(this.currentSlide + 2) % this.vehicles.length]
        ];
      },
      prev() {
        this.currentSlide = (this.currentSlide - 1 + this.vehicles.length) % this.vehicles.length;
      },
      next() {
        this.currentSlide = (this.currentSlide + 1) % this.vehicles.length;
      }
    }" class="relative">

      {{-- Кнопка влево --}}
      <button @click="prev"
              class="absolute -left-4 top-1/2 z-10 -translate-y-1/2 rounded-full bg-green-600 p-3 text-white shadow-lg transition-all hover:bg-green-700 hover:scale-110">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
      </button>

      {{-- Карусель --}}
      <div class="overflow-hidden px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <template x-for="(veh, idx) in visibleVehicles" :key="veh.id">
            <div @click="$wire.selectVehicle(veh.id)"
                 :class="{
                   'border-green-600 bg-green-50 ring-2 ring-green-600 dark:bg-green-900/20': veh.id == {{ $vehicle_id }},
                   'border-gray-200 dark:border-gray-700 hover:border-green-400': veh.id != {{ $vehicle_id }}
                 }"
                 class="group cursor-pointer rounded-2xl border-2 p-6 transition-all hover:shadow-xl">

              {{-- Изображение --}}
              <div class="relative mb-4 aspect-video overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-700">
                <template x-if="veh.image">
                  <img :src="'/storage/' + veh.image" :alt="veh.name"
                       class="h-full w-full object-cover transition-transform group-hover:scale-110">
                </template>
                <template x-if="!veh.image">
                  <div class="flex h-full items-center justify-center">
                    <svg class="h-20 w-20 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                  </div>
                </template>

                {{-- Бейдж пассажиров --}}
                <template x-if="veh.allows_passengers">
                  <div class="absolute right-3 top-3 rounded-full bg-green-600 px-3 py-1 text-xs font-semibold text-white shadow-lg">
                    <span x-text="'До ' + veh.max_passengers + ' чел.'"></span>
                  </div>
                </template>
              </div>

              {{-- Название --}}
              <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="veh.name"></h3>

              {{-- Описание --}}
              <p class="mt-2 line-clamp-2 text-sm text-gray-600 dark:text-gray-300" x-text="veh.description"></p>

              {{-- Характеристики --}}
              <div class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between text-gray-700 dark:text-gray-300">
                  <span>Грузоподъемность:</span>
                  <span class="font-semibold" x-text="veh.capacity_tons + ' т'"></span>
                </div>
                <div class="flex justify-between text-gray-700 dark:text-gray-300">
                  <span>Размеры:</span>
                  <span class="font-semibold" x-text="veh.length_m + '×' + veh.width_m + '×' + veh.height_m + ' м'"></span>
                </div>
              </div>

              {{-- Цены --}}
              <div class="mt-4 grid grid-cols-2 gap-2">
                <div class="rounded-lg bg-green-50 p-2 text-center dark:bg-green-900/10">
                  <div class="text-xs text-gray-600 dark:text-gray-400">За км</div>
                  <div class="text-lg font-bold text-green-600 dark:text-green-400" x-text="veh.price_per_km + ' ₽'"></div>
                </div>
                <div class="rounded-lg bg-green-50 p-2 text-center dark:bg-green-900/10">
                  <div class="text-xs text-gray-600 dark:text-gray-400">За час</div>
                  <div class="text-lg font-bold text-green-600 dark:text-green-400" x-text="veh.price_per_hour + ' ₽'"></div>
                </div>
              </div>

              {{-- Чекмарк выбран --}}
              <div x-show="veh.id == {{ $vehicle_id }}"
                   class="mt-4 flex items-center justify-center rounded-lg bg-green-600 py-2 text-sm font-semibold text-white">
                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Выбрано
              </div>
            </div>
          </template>
        </div>
      </div>

      {{-- Кнопка вправо --}}
      <button @click="next"
              class="absolute -right-4 top-1/2 z-10 -translate-y-1/2 rounded-full bg-green-600 p-3 text-white shadow-lg transition-all hover:bg-green-700 hover:scale-110">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </button>

      {{-- Индикаторы --}}
      <div class="mt-6 flex justify-center gap-2">
        <template x-for="(vehicle, index) in vehicles" :key="'indicator-' + vehicle.id">
          <button @click="currentSlide = index"
                  :class="{ 'bg-green-600 w-8': currentSlide === index, 'bg-gray-300 dark:bg-gray-600': currentSlide !== index }"
                  class="h-2 w-2 rounded-full transition-all"></button>
        </template>
      </div>
    </div>
  </section>

  {{-- Основной контент: Форма СЛЕВА, Карта СПРАВА --}}
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

    {{-- Левая колонка: Форма и опции (1 часть) --}}
    <div class="lg:col-span-1">
      <div class="space-y-6">

        {{-- Дополнительные опции --}}
        <div class="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
          <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Дополнительные опции</h3>

          {{-- Грузчики --}}
          @if($loaderOption)
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Грузчики ({{ number_format($loaderOption->price_per_hour, 0) }} ₽/ч)
              </label>
              <div class="flex items-center gap-3">
                <button
                  wire:click="updateLoadersCount({{ $loaders_count - 1 }})"
                  class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                  @if($loaders_count <= 0) disabled @endif>
                  −
                </button>
                <span class="w-12 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $loaders_count }}</span>
                <button
                  wire:click="updateLoadersCount({{ $loaders_count + 1 }})"
                  class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                  @if($loaders_count >= $loaderOption->max_quantity) disabled @endif>
                  +
                </button>
                <span class="text-xs text-gray-500 dark:text-gray-400">макс. {{ $loaderOption->max_quantity }}</span>
              </div>
            </div>
          @endif

          {{-- Пассажиры --}}
          @if($vehicle && $vehicle->allows_passengers && $passengerOption)
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Пассажиры ({{ number_format($passengerOption->price_per_hour, 0) }} ₽/ч)
              </label>
              <div class="flex items-center gap-3">
                <button
                  wire:click="updatePassengersCount({{ $passengers_count - 1 }})"
                  class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                  @if($passengers_count <= 0) disabled @endif>
                  −
                </button>
                <span class="w-12 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $passengers_count }}</span>
                <button
                  wire:click="updatePassengersCount({{ $passengers_count + 1 }})"
                  class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                  @if($passengers_count >= $vehicle->max_passengers) disabled @endif>
                  +
                </button>
                <span class="text-xs text-gray-500 dark:text-gray-400">макс. {{ $vehicle->max_passengers }}</span>
              </div>
            </div>
          @endif

          {{-- Этажи --}}
          @if($floorOption)
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Подъем на этаж ({{ number_format($floorOption->price_per_floor, 0) }} ₽/этаж)
              </label>
              <div class="flex items-center gap-3">
                <button
                  wire:click="updateFloorsCount({{ $floors_count - 1 }})"
                  class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                  @if($floors_count <= 0) disabled @endif>
                  −
                </button>
                <span class="w-12 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $floors_count }}</span>
                <button
                  wire:click="updateFloorsCount({{ $floors_count + 1 }})"
                  class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                  @if($floors_count >= $floorOption->max_quantity) disabled @endif>
                  +
                </button>
                <span class="text-xs text-gray-500 dark:text-gray-400">макс. {{ $floorOption->max_quantity }}</span>
              </div>

              <label class="mt-3 flex items-center">
                <input type="checkbox" wire:model="has_cargo_elevator"
                       class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Есть грузовой лифт</span>
              </label>
            </div>
          @endif

          {{-- Услуги --}}
          @if($services->isNotEmpty())
            <div>
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Дополнительные услуги</label>
              <div class="space-y-2">
                @foreach($services as $service)
                  <label class="flex items-start">
                    <input type="checkbox" wire:model="selected_services" value="{{ $service->id }}"
                           class="mt-1 h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span class="ml-2 text-sm">
                      <span class="font-medium text-gray-900 dark:text-white">{{ $service->name }}</span>
                      @if($service->price)
                        <span class="text-gray-600 dark:text-gray-400">({{ number_format($service->price, 0) }} ₽)</span>
                      @endif
                    </span>
                  </label>
                @endforeach
              </div>
            </div>
          @endif
        </div>

        {{-- Расчет стоимости --}}
        @if(count($route_points) >= 2)
          <div class="rounded-2xl bg-gradient-to-br from-green-50 to-white p-6 shadow-lg dark:from-gray-800 dark:to-gray-800">
            <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Расчет стоимости</h3>

            <div class="space-y-3">
              <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                <span>Расстояние:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ number_format($distance, 1) }} км</span>
              </div>

              <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                <span>По километражу:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ number_format($base_distance_cost, 0) }} ₽</span>
              </div>

              <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                <span>По времени ({{ $estimated_hours }} ч):</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ number_format($base_time_cost, 0) }} ₽</span>
              </div>

              @if($loaders_count > 0)
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                  <span>• Грузчики: {{ $loaders_count }} × {{ number_format($loader_price, 0) }} ₽/ч × {{ $estimated_hours }} ч</span>
                  <span class="font-medium text-gray-900 dark:text-white">{{ number_format($loaders_count * $loader_price * $estimated_hours, 0) }} ₽</span>
                </div>
              @endif

              @if($passengers_count > 0)
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                  <span>• Пассажиры: {{ $passengers_count }} × {{ number_format($passenger_price, 0) }} ₽/ч × {{ $estimated_hours }} ч</span>
                  <span class="font-medium text-gray-900 dark:text-white">{{ number_format($passengers_count * $passenger_price * $estimated_hours, 0) }} ₽</span>
                </div>
              @endif

              @if($floors_count > 0 && !$has_cargo_elevator)
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                  <span>• Подъем на этажи: {{ $floors_count }} × {{ number_format($floor_price, 0) }} ₽</span>
                  <span class="font-medium text-gray-900 dark:text-white">{{ number_format($floors_count * $floor_price, 0) }} ₽</span>
                </div>
              @endif

              @if($services_cost > 0)
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                  <span>Дополнительные услуги:</span>
                  <span class="font-medium text-gray-900 dark:text-white">{{ number_format($services_cost, 0) }} ₽</span>
                </div>
              @endif

              <div class="border-t border-gray-300 pt-3 dark:border-gray-600">
                <div class="flex justify-between">
                  <span class="text-lg font-bold text-gray-900 dark:text-white">Итого:</span>
                  <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ number_format($total_cost, 0) }} ₽</span>
                </div>
              </div>
            </div>
          </div>
        @endif

        {{-- Форма заказа --}}
        @if(count($route_points) >= 2)
          <div class="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Оформление заказа</h3>

            <form wire:submit.prevent="submitOrder" class="space-y-4">
              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Ваше имя *</label>
                <input type="text" wire:model="name"
                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Телефон *</label>
                <input type="tel" wire:model="phone" placeholder="+7 (___) ___-__-__"
                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email *</label>
                <input type="email" wire:model="email"
                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Дата выполнения работ</label>
                <input type="date" wire:model="scheduled_date"
                       min="{{ date('Y-m-d') }}"
                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('scheduled_date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Время начала работ</label>
                <input type="time" wire:model="scheduled_time"
                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('scheduled_time') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Ваши комментарии</label>
                <textarea wire:model="client_comments" rows="3"
                          placeholder="Опишите детали заказа, особые пожелания..."
                          class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                @error('client_comments') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="flex items-center">
                  <input type="checkbox" wire:model="is_cash_payment"
                         class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                  <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Оплата наличными</span>
                </label>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                  {{ $is_cash_payment ? 'Оплата наличными водителю' : 'Безналичная оплата (по счету)' }}
                </p>
              </div>

              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Комментарий к заказу</label>
                <textarea wire:model="comment" rows="2"
                          class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                @error('comment') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
              </div>

              <button type="submit"
                      class="w-full rounded-lg bg-green-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Отправить заявку
              </button>
            </form>

            @if($orderSubmittedSuccessfully)
              <div class="mt-4 rounded-lg bg-green-50 p-4 dark:bg-green-900/20">
                <div class="flex">
                  <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-300">Заявка успешно отправлена!</p>
                    <p class="mt-1 text-sm text-green-700 dark:text-green-400">Мы свяжемся с вами в ближайшее время</p>
                  </div>
                </div>
              </div>
            @endif

            @if($showError)
              <div class="mt-4 rounded-lg bg-red-50 p-4 dark:bg-red-900/20">
                <div class="flex">
                  <svg class="h-5 w-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                  </svg>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-red-800 dark:text-red-300">Произошла ошибка при отправке</p>
                  </div>
                </div>
              </div>
            @endif
          </div>
        @endif
      </div>
    </div>

    {{-- Правая колонка: КАРТА (2 части) --}}
    <div class="lg:col-span-2">
      <div class="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Укажите маршрут на карте</h2>
          <button
            wire:click="resetCalculator"
            class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-600">
            <svg class="mr-2 inline-block h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Сбросить
          </button>
        </div>

        {{-- Карта --}}
        <div id="map" class="h-[600px] w-full rounded-xl" wire:ignore></div>

        {{-- Список точек маршрута --}}
        @if(count($route_points) > 0)
          <div class="mt-6">
            <h3 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Точки маршрута</h3>
            <div class="space-y-2">
              @foreach($route_points as $index => $point)
                <div class="flex items-start gap-3 rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-700/50">
                  <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full
                              @if($index === 0) bg-green-600 @elseif($index === count($route_points) - 1) bg-red-600 @else bg-blue-600 @endif
                              text-sm font-bold text-white">
                    {{ $index + 1 }}
                  </div>
                  <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $point['address'] }}</p>
                  </div>
                  <button wire:click="removeRoutePoint({{ $index }})"
                          class="flex-shrink-0 text-red-500 hover:text-red-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- Скрипты для карты (ВОССТАНОВЛЕННЫЕ ИЗ ОРИГИНАЛА) --}}
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
      controls: ['zoomControl', 'searchControl', 'typeSelector', 'fullscreenControl']
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
</script>
@endpush
