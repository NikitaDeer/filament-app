<div class="mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">

  {{-- Выбор транспорта (карусель) --}}
  <section class="mb-8">
    <div class="mb-4">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        <svg class="mr-2 inline-block h-7 w-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
        </svg>
        Выберите грузовой автомобиль
      </h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Кликните на карточку для выбора транспорта</p>
    </div>

    <div x-data="{
      currentSlide: 0,
      itemsPerPage: 4,
      vehicles: @js($vehicles->toArray()),
      selectedVehicleId: @entangle('vehicle_id'),
      get totalPages() {
        return Math.ceil(this.vehicles.length / this.itemsPerPage);
      },
      get visibleVehicles() {
        const start = this.currentSlide * this.itemsPerPage;
        return this.vehicles.slice(start, start + this.itemsPerPage);
      },
      prev() {
        if (this.currentSlide > 0) {
          this.currentSlide--;
        }
      },
      next() {
        if (this.currentSlide < this.totalPages - 1) {
          this.currentSlide++;
        }
      },
      selectVehicle(id) {
        this.selectedVehicleId = id;
        $wire.call('selectVehicle', id);
      }
    }" class="relative">

      {{-- Кнопка влево --}}
      <button @click="prev"
              x-show="currentSlide > 0"
              class="absolute -left-4 top-1/2 z-10 -translate-y-1/2 rounded-full bg-green-600 p-3 text-white shadow-lg transition-all hover:bg-green-700 hover:scale-110 lg:-left-12">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
      </button>

      {{-- Карусель --}}
      <div class="overflow-hidden px-2">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <template x-for="veh in visibleVehicles" :key="veh.id">
            <label class="cursor-pointer">
              <input type="radio"
                     name="vehicle"
                     :value="veh.id"
                     x-model="selectedVehicleId"
                     @change="selectVehicle(veh.id)"
                     class="peer sr-only">

              <div class="group relative overflow-hidden rounded-xl border-2 transition-all
                          peer-checked:border-green-600 peer-checked:bg-green-50 peer-checked:shadow-lg
                          border-gray-200 hover:border-green-400 hover:shadow-md
                          dark:border-gray-700 dark:peer-checked:border-green-500 dark:peer-checked:bg-green-900/20
                          h-full"
                   :class="{ 'border-green-600 bg-green-50 shadow-lg dark:border-green-500 dark:bg-green-900/20': selectedVehicleId == veh.id }">

                {{-- Чекмарк --}}
                <div class="absolute right-2 top-2 z-10 h-6 w-6 items-center justify-center rounded-full bg-green-600 text-white"
                     :class="{ 'flex': selectedVehicleId == veh.id, 'hidden': selectedVehicleId != veh.id }">
                  <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                  </svg>
                </div>

                <div class="p-4">
                  {{-- Название --}}
                  <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="veh.name"></h3>

                  {{-- Параметры --}}
                  <div class="mt-3 space-y-2 text-xs">
                    <div class="flex items-center justify-between text-gray-600 dark:text-gray-400">
                      <span class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Грузопод.
                      </span>
                      <span class="font-semibold text-gray-900 dark:text-white" x-text="veh.capacity_tons + ' т'"></span>
                    </div>

                    <div class="flex items-center justify-between text-gray-600 dark:text-gray-400">
                      <span class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                        Размеры
                      </span>
                      <span class="font-semibold text-gray-900 dark:text-white" x-text="veh.length_m + '×' + veh.width_m + '×' + veh.height_m"></span>
                    </div>
                  </div>

                  {{-- Цены --}}
                  <div class="mt-3 grid grid-cols-2 gap-2">
                    <div class="rounded-lg bg-gray-100 p-2 text-center dark:bg-gray-700">
                      <div class="text-[10px] text-gray-600 dark:text-gray-400">₽/км</div>
                      <div class="text-base font-bold text-green-600 dark:text-green-400" x-text="veh.price_per_km"></div>
                    </div>
                    <div class="rounded-lg bg-gray-100 p-2 text-center dark:bg-gray-700">
                      <div class="text-[10px] text-gray-600 dark:text-gray-400">₽/час</div>
                      <div class="text-base font-bold text-green-600 dark:text-green-400" x-text="veh.price_per_hour"></div>
                    </div>
                  </div>

                  <template x-if="veh.allows_passengers">
                    <div class="mt-2 text-center text-xs text-green-600 dark:text-green-400">
                      <span x-text="'👥 До ' + veh.max_passengers + ' пассажиров'"></span>
                    </div>
                  </template>
                </div>
              </div>
            </label>
          </template>
        </div>
      </div>

      {{-- Кнопка вправо --}}
      <button @click="next"
              x-show="currentSlide < totalPages - 1"
              class="absolute -right-4 top-1/2 z-10 -translate-y-1/2 rounded-full bg-green-600 p-3 text-white shadow-lg transition-all hover:bg-green-700 hover:scale-110 lg:-right-12">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </button>

      {{-- Индикаторы страниц --}}
      <div class="mt-6 flex justify-center gap-2" x-show="totalPages > 1">
        <template x-for="page in totalPages" :key="page">
          <button @click="currentSlide = page - 1"
                  :class="{ 'bg-green-600 w-8': currentSlide === page - 1, 'bg-gray-300 dark:bg-gray-600': currentSlide !== page - 1 }"
                  class="h-2 w-2 rounded-full transition-all"></button>
        </template>
      </div>
    </div>
  </section>

  {{-- Основной контент --}}
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

    {{-- Левая колонка --}}
    <div class="lg:col-span-1 space-y-6">

        {{-- Дополнительные опции --}}
        <div class="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
          <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Дополнительные опции</h3>

          @if($loaderOption)
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Грузчики ({{ number_format($loaderOption->price_per_hour, 0) }} ₽/ч)
              </label>
              <div class="flex items-center gap-3">
                <button wire:click="decrementLoaders"
                        class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @if($loaders_count <= 0) disabled @endif>−</button>
                <span class="w-12 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $loaders_count }}</span>
                <button wire:click="incrementLoaders"
                        class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @if($loaders_count >= $loaderOption->max_quantity) disabled @endif>+</button>
                <span class="text-xs text-gray-500 dark:text-gray-400">макс. {{ $loaderOption->max_quantity }}</span>
              </div>
            </div>
          @endif

          @if($vehicle && $vehicle->allows_passengers && $passengerOption)
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Пассажиры ({{ number_format($passengerOption->price_per_hour, 0) }} ₽/ч)
              </label>
              <div class="flex items-center gap-3">
                <button wire:click="decrementPassengers"
                        class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @if($passengers_count <= 0) disabled @endif>−</button>
                <span class="w-12 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $passengers_count }}</span>
                <button wire:click="incrementPassengers"
                        class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @if($passengers_count >= $vehicle->max_passengers) disabled @endif>+</button>
                <span class="text-xs text-gray-500 dark:text-gray-400">макс. {{ $vehicle->max_passengers }}</span>
              </div>
            </div>
          @endif

          @if($floorOption)
            <div class="mb-6">
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Подъем на этаж ({{ number_format($floorOption->price_per_floor, 0) }} ₽/этаж)
              </label>
              <div class="flex items-center gap-3">
                <button wire:click="decrementFloors"
                        class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @if($floors_count <= 0) disabled @endif>−</button>
                <span class="w-12 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $floors_count }}</span>
                <button wire:click="incrementFloors"
                        class="rounded-lg bg-gray-200 px-4 py-2 font-bold hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @if($floors_count >= $floorOption->max_quantity) disabled @endif>+</button>
                <span class="text-xs text-gray-500 dark:text-gray-400">макс. {{ $floorOption->max_quantity }}</span>
              </div>

              <label class="mt-3 flex items-center">
                <input type="checkbox" wire:model="has_cargo_elevator"
                       class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Есть грузовой лифт</span>
              </label>
            </div>
          @endif

          @if($services->isNotEmpty())
            <div>
              <h4 class="mb-3 flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <svg class="mr-2 h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Дополнительные услуги
              </h4>
              <div class="space-y-3">
                @foreach($services as $service)
                  <label class="group relative block cursor-pointer">
                    <input type="checkbox" wire:model="selected_services" value="{{ $service->id }}"
                           class="peer sr-only">

                    <div class="rounded-lg border-2 border-gray-200 bg-white p-3 transition-all
                                peer-checked:border-green-600 peer-checked:bg-green-50
                                hover:border-green-400 hover:shadow-md
                                dark:border-gray-700 dark:bg-gray-700 dark:peer-checked:border-green-500 dark:peer-checked:bg-green-900/20">

                      {{-- Чекмарк --}}
                      <div class="absolute right-2 top-2 hidden h-5 w-5 items-center justify-center rounded-full bg-green-600 text-white peer-checked:flex">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                      </div>

                      <div class="flex items-start pr-6">
                        {{-- Иконка --}}
                        @if($service->icon)
                          <div class="mr-3 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                            <i class="{{ $service->icon }} text-lg"></i>
                          </div>
                        @else
                          <div class="mr-3 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                          </div>
                        @endif

                        {{-- Контент --}}
                        <div class="flex-1 min-w-0">
                          <div class="flex items-baseline justify-between">
                            <h5 class="font-semibold text-gray-900 dark:text-white">{{ $service->name }}</h5>
                            @if($service->price)
                              <span class="ml-2 whitespace-nowrap text-sm font-bold text-green-600 dark:text-green-400">
                                {{ number_format($service->price, 0) }} ₽
                              </span>
                            @endif
                          </div>
                          @if($service->description)
                            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400 line-clamp-2">
                              {{ $service->description }}
                            </p>
                          @endif
                          @if($service->is_popular)
                            <span class="mt-1 inline-block rounded-full bg-orange-100 px-2 py-0.5 text-xs font-semibold text-orange-800 dark:bg-orange-900/30 dark:text-orange-400">
                              ⭐ Популярно
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
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
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Дата и время получения груза</label>
                <input type="datetime-local" wire:model="scheduled_datetime"
                       min="{{ date('Y-m-d\TH:i') }}"
                       class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('scheduled_datetime') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
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

              <button type="submit"
                      class="w-full rounded-lg bg-green-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-green-700">
                Отправить заявку
              </button>
            </form>


          </div>
        @endif
    </div>

    {{-- Правая колонка: КАРТА --}}
    <div class="lg:col-span-2">
      <div class="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Укажите маршрут на карте</h2>
          <button wire:click="resetCalculator"
                  class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-600">
            <svg class="mr-2 inline-block h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Сбросить
          </button>
        </div>

        {{-- Подсказка --}}
        @if(count($route_points) == 0)
          <div class="mb-4 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
            <div class="flex">
              <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
              </svg>
              <div class="ml-3">
                <p class="text-sm font-medium text-blue-800 dark:text-blue-300">Кликните на карте, чтобы указать точку отправления (откуда)</p>
              </div>
            </div>
          </div>
        @elseif(count($route_points) == 1)
          <div class="mb-4 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
            <div class="flex">
              <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
              </svg>
              <div class="ml-3">
                <p class="text-sm font-medium text-blue-800 dark:text-blue-300">Теперь укажите точку назначения (куда)</p>
              </div>
            </div>
          </div>
        @endif

        {{-- Карта --}}
        <div id="map" class="h-[600px] w-full rounded-xl" wire:ignore></div>

        {{-- Точки маршрута с drag & drop --}}
        @if(count($route_points) > 0)
          <div class="mt-6">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Точки маршрута</h3>
              @if(count($route_points) >= 2)
                <button wire:click="addIntermediatePoint"
                        class="rounded-lg bg-green-600 px-3 py-1 text-sm font-medium text-white hover:bg-green-700">
                  + Добавить промежуточную точку
                </button>
              @endif
            </div>

            <p class="mb-3 text-sm text-gray-600 dark:text-gray-400">
              💡 <strong>Подсказка:</strong> Перетаскивайте точки для изменения порядка. Нажмите на кнопку "Добавить детали" для уточнения адреса (подъезд, этаж, домофон и т.д.)
            </p>

            <div x-data="{ dragging: null }" class="space-y-3">
              @foreach($route_points as $index => $point)
                <div class="rounded-xl border-2 border-gray-200 bg-white p-4 shadow-sm transition-all dark:border-gray-700 dark:bg-gray-800">

                  {{-- Верхняя часть: основная информация --}}
                  <div draggable="true"
                       x-on:dragstart="dragging = {{ $index }}"
                       x-on:dragend="dragging = null"
                       x-on:dragover.prevent
                       x-on:drop.prevent="if (dragging !== null && dragging !== {{ $index }}) { $wire.reorderRoutePoints(dragging, {{ $index }}) }"
                       :class="{ 'opacity-50': dragging === {{ $index }} }"
                       class="flex items-start gap-3 cursor-move">

                    {{-- Иконка перетаскивания --}}
                    <div class="text-gray-400 hover:text-green-600">
                      <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                      </svg>
                    </div>

                    {{-- Номер точки --}}
                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full
                                @if($index === 0) bg-green-600 @elseif($index === count($route_points) - 1) bg-red-600 @else bg-blue-600 @endif
                                text-base font-bold text-white shadow-md">
                      {{ $index + 1 }}
                    </div>

                    {{-- Детали точки --}}
                    <div class="flex-1 min-w-0">
                      <div class="flex items-start justify-between gap-2">
                        <div class="flex-1 min-w-0">
                          <span class="inline-block rounded-full px-2 py-1 text-xs font-semibold
                                       @if($index === 0) bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                       @elseif($index === count($route_points) - 1) bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                       @else bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 @endif">
                            {{ $index === 0 ? '📍 Откуда' : ($index === count($route_points) - 1 ? '🎯 Куда' : '📌 Промежуточная') }}
                          </span>
                          <p class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ $point['address'] }}</p>
                        </div>

                        <button wire:click="removeRoutePoint({{ $index }})"
                                class="flex-shrink-0 rounded-lg p-2 text-red-500 transition-colors hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  {{-- Блок с деталями адреса --}}
                  <div class="mt-3 border-t border-gray-200 pt-3 dark:border-gray-700">
                    @if(!empty($point['details']) && (
                      !empty($point['details']['entrance']) ||
                      !empty($point['details']['floor']) ||
                      !empty($point['details']['apartment']) ||
                      !empty($point['details']['intercom_code']) ||
                      !empty($point['details']['contact_phone'])
                    ))
                      {{-- Детали заполнены --}}
                      <div class="rounded-lg bg-green-50 p-3 dark:bg-green-900/10">
                        <div class="mb-2 flex items-center justify-between">
                          <span class="text-xs font-semibold text-green-800 dark:text-green-400">✅ Детали адреса указаны</span>
                          <button wire:click="editPointDetails({{ $index }})"
                                  class="rounded-lg bg-green-600 px-3 py-1 text-xs font-medium text-white transition-colors hover:bg-green-700">
                            <svg class="mr-1 inline-block h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Редактировать
                          </button>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-700 dark:text-gray-300">
                          @if(!empty($point['details']['entrance']))
                            <span class="flex items-center">
                              <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                              </svg>
                              Подъезд: <strong>{{ $point['details']['entrance'] }}</strong>
                            </span>
                          @endif
                          @if(!empty($point['details']['floor']))
                            <span class="flex items-center">
                              <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                              </svg>
                              Этаж: <strong>{{ $point['details']['floor'] }}</strong>
                            </span>
                          @endif
                          @if(!empty($point['details']['apartment']))
                            <span class="flex items-center">
                              <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                              </svg>
                              Квартира: <strong>{{ $point['details']['apartment'] }}</strong>
                            </span>
                          @endif
                          @if(!empty($point['details']['intercom_code']))
                            <span class="flex items-center">
                              <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                              </svg>
                              Домофон: <strong>{{ $point['details']['intercom_code'] }}</strong>
                            </span>
                          @endif
                          @if(!empty($point['details']['contact_phone']))
                            <span class="flex items-center col-span-2">
                              <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                              </svg>
                              Контакт: <strong>{{ $point['details']['contact_phone'] }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    @else
                      {{-- Детали не заполнены - призыв к действию --}}
                      <button wire:click="editPointDetails({{ $index }})"
                              class="w-full rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-3 text-left transition-all hover:border-green-500 hover:bg-green-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-green-600 dark:hover:bg-green-900/20">
                        <div class="flex items-center justify-between">
                          <div class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Добавить детали адреса</span>
                          </div>
                          <span class="text-xs text-gray-500 dark:text-gray-400">Подъезд, этаж, домофон...</span>
                        </div>
                      </button>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  {{-- Модальное окно деталей точки --}}
  @if($showPointDetailsModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
         x-data x-on:click.self="$wire.set('showPointDetailsModal', false)">
      <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-gray-800"
           x-on:click.stop>
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-xl font-bold text-gray-900 dark:text-white">Детали адреса</h3>
          <button wire:click="$set('showPointDetailsModal', false)"
                  class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <div class="mb-4 rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
          <p class="text-sm font-medium text-gray-900 dark:text-white">
            {{ $route_points[$editingPointIndex]['address'] ?? '' }}
          </p>
        </div>

        <div class="space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Подъезд</label>
              <input type="text" wire:model="current_point_details.entrance"
                     class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
              <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Этаж</label>
              <input type="text" wire:model="current_point_details.floor"
                     class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Квартира</label>
              <input type="text" wire:model="current_point_details.apartment"
                     class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
              <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Код домофона</label>
              <input type="text" wire:model="current_point_details.intercom_code"
                     class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
          </div>

          <div>
            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Контактный телефон</label>
            <input type="tel" wire:model="current_point_details.contact_phone"
                   placeholder="+7 (___) ___-__-__"
                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
          </div>

          <div class="flex gap-3">
            <button wire:click="savePointDetails"
                    class="flex-1 rounded-lg bg-green-600 px-4 py-2 font-semibold text-white hover:bg-green-700">
              Сохранить
            </button>
            <button wire:click="$set('showPointDetailsModal', false)"
                    class="flex-1 rounded-lg border-2 border-gray-300 px-4 py-2 font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
              Отмена
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif

  {{-- Модальное окно успешной отправки заказа --}}
  @if($orderSubmittedSuccessfully)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
         x-data x-init="$el.classList.add('opacity-100')"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
      
      <div class="relative w-full max-w-md transform rounded-2xl bg-white p-6 text-center shadow-2xl transition-all dark:bg-gray-800"
           x-on:click.outside="$wire.closeSuccessModal()">
        
        {{-- Иконка успеха --}}
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
          <svg class="h-10 w-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>

        <h3 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white">Заявка принята!</h3>
        
        <p class="mb-6 text-gray-600 dark:text-gray-300">
          Спасибо за ваш заказ. Наш менеджер свяжется с вами в ближайшее время для подтверждения деталей.
        </p>

        <button wire:click="closeSuccessModal"
                class="w-full rounded-xl bg-green-600 px-6 py-3 text-base font-semibold text-white shadow-lg transition-all hover:bg-green-700 hover:shadow-green-500/30 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
          Отлично, жду звонка
        </button>

        {{-- Кнопка закрытия (крестик) --}}
        <button wire:click="closeSuccessModal" 
                class="absolute right-4 top-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

      </div>
    </div>
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
      center: [59.9342802, 30.3350986],
      zoom: 10,
      controls: ['zoomControl', 'searchControl', 'typeSelector', 'fullscreenControl']
    });

    myMap.events.add('click', function(e) {
      const coords = e.get('coords');

      ymaps.geocode(coords).then(function(res) {
        const firstGeoObject = res.geoObjects.get(0);
        const address = firstGeoObject.getAddressLine();

        @this.call('addRoutePoint', address, coords, {});

        addPlacemark(coords, placemarksArray.length);

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

      const distance = route.getLength() / 1000;
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

  ymaps.ready(initMap);

  Livewire.on('resetMap', () => {
    clearMap();
  });

  Livewire.on('routePointRemoved', () => {
    clearMap();
    const routePoints = @this.get('route_points');
    routePoints.forEach((point, index) => {
      addPlacemark(point.coords, index);
    });
    if (routePoints.length >= 2) {
      buildRoute();
    }
  });

  Livewire.on('routeReordered', () => {
    clearMap();
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
