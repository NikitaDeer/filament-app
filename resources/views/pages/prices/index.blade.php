<x-main-layout>
  {{-- Hero секция --}}
  <section class="bg-gradient-to-br from-green-50 to-white py-16 dark:from-gray-900 dark:to-gray-800 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <span class="rounded bg-green-600 px-3 py-1 text-sm font-medium text-white">
          {{ prices_content('hero_badge', 'Прозрачное ценообразование') }}
        </span>
        <h1 class="mt-4 text-4xl font-bold text-gray-900 dark:text-white sm:text-5xl">
          {{ prices_content('hero_title', 'Актуальные цены на грузоперевозки') }}
        </h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
          {{ prices_content('hero_subtitle', 'Все цены указаны с учетом НДС. Точную стоимость вашего заказа можно рассчитать в нашем онлайн-калькуляторе') }}
        </p>
        <div class="mt-8">
          <a href="{{ route('calculator.index') }}"
             class="inline-flex items-center rounded-lg bg-green-600 px-8 py-3 font-semibold text-white transition-colors hover:bg-green-700">
            Рассчитать стоимость
            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- Цены на транспорт --}}
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
          <svg class="mr-2 inline-block h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
          </svg>
          {{ prices_content('transport_section_title', 'Аренда грузового транспорта') }}
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ prices_content('transport_section_subtitle', 'Стоимость аренды за километр и час работы') }}</p>
      </div>

      @php
        $vehicles = \App\Models\Vehicle::active()->ordered()->get();
      @endphp

      <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-lg dark:border-gray-700">
        <table class="w-full">
          <thead class="bg-green-600 text-white">
            <tr>
              <th class="px-6 py-4 text-left text-sm font-semibold">Тип транспорта</th>
              <th class="px-6 py-4 text-center text-sm font-semibold">Грузоподъемность</th>
              <th class="px-6 py-4 text-center text-sm font-semibold">Размеры (Д×Ш×В)</th>
              <th class="px-6 py-4 text-center text-sm font-semibold">Цена за км</th>
              <th class="px-6 py-4 text-center text-sm font-semibold">Цена за час</th>
              <th class="px-6 py-4 text-center text-sm font-semibold">Пассажиры</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
            @forelse($vehicles as $vehicle)
              <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4">
                  <div class="font-semibold text-gray-900 dark:text-white">{{ $vehicle->name }}</div>
                  @if($vehicle->description)
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($vehicle->description, 60) }}</div>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    {{ $vehicle->capacity_tons }} т
                  </span>
                </td>
                <td class="px-6 py-4 text-center text-sm text-gray-600 dark:text-gray-400">
                  {{ $vehicle->length_m }}×{{ $vehicle->width_m }}×{{ $vehicle->height_m }} м
                </td>
                <td class="px-6 py-4 text-center">
                  <span class="text-lg font-bold text-green-600 dark:text-green-400">
                    {{ number_format($vehicle->price_per_km, 0, ',', ' ') }} ₽
                  </span>
                </td>
                <td class="px-6 py-4 text-center">
                  <span class="text-lg font-bold text-green-600 dark:text-green-400">
                    {{ number_format($vehicle->price_per_hour, 0, ',', ' ') }} ₽
                  </span>
                </td>
                <td class="px-6 py-4 text-center">
                  @if($vehicle->allows_passengers)
                    <span class="inline-flex items-center text-sm text-green-600 dark:text-green-400">
                      <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                      </svg>
                      До {{ $vehicle->max_passengers }} чел.
                    </span>
                  @else
                    <span class="text-sm text-gray-400">—</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                  Транспорт не найден
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-6 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
        <div class="flex">
          <svg class="h-5 w-5 flex-shrink-0 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
          </svg>
          <div class="ml-3">
            <p class="text-sm text-blue-800 dark:text-blue-300">
              <strong>Минимальный заказ:</strong> 2 часа работы транспорта. Итоговая стоимость рассчитывается по наибольшему значению из двух параметров: километраж или время работы.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Дополнительные услуги --}}
  <section class="bg-gray-50 py-16 dark:bg-gray-800 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
          <svg class="mr-2 inline-block h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
          </svg>
          {{ prices_content('options_section_title', 'Дополнительные опции') }}
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ prices_content('options_section_subtitle', 'Услуги, которые можно добавить к вашему заказу') }}</p>
      </div>

      @php
        $pricingOptions = \App\Models\PricingOption::where('is_active', true)->get()->groupBy('type');
      @endphp

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        {{-- Грузчики --}}
        @if($pricingOptions->has('грузчики'))
          @php $option = $pricingOptions['грузчики']->first(); @endphp
          <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-lg dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-start">
              <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $option->name }}</h3>
                @if($option->description)
                  <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $option->description }}</p>
                @endif
                <div class="mt-4 flex items-baseline">
                  <span class="text-3xl font-bold text-green-600 dark:text-green-400">
                    {{ number_format($option->price_per_hour, 0, ',', ' ') }} ₽
                  </span>
                  <span class="ml-2 text-gray-600 dark:text-gray-400">за час работы</span>
                </div>
                @if($option->max_quantity)
                  <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Максимум: {{ $option->max_quantity }} грузчиков</p>
                @endif
              </div>
            </div>
          </div>
        @endif

        {{-- Пассажиры --}}
        @if($pricingOptions->has('пассажиры'))
          @php $option = $pricingOptions['пассажиры']->first(); @endphp
          <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-lg dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-start">
              <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $option->name }}</h3>
                @if($option->description)
                  <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $option->description }}</p>
                @endif
                <div class="mt-4 flex items-baseline">
                  <span class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    {{ number_format($option->price_per_hour, 0, ',', ' ') }} ₽
                  </span>
                  <span class="ml-2 text-gray-600 dark:text-gray-400">за час поездки</span>
                </div>
                @if($option->max_quantity)
                  <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Зависит от типа транспорта</p>
                @endif
              </div>
            </div>
          </div>
        @endif

        {{-- Подъем на этаж --}}
        @if($pricingOptions->has('этажи'))
          @php $option = $pricingOptions['этажи']->first(); @endphp
          <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-lg dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-start">
              <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $option->name }}</h3>
                @if($option->description)
                  <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $option->description }}</p>
                @endif
                <div class="mt-4 flex items-baseline">
                  <span class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                    {{ number_format($option->price_per_floor, 0, ',', ' ') }} ₽
                  </span>
                  <span class="ml-2 text-gray-600 dark:text-gray-400">за этаж</span>
                </div>
                @if($option->max_quantity)
                  <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Максимум: {{ $option->max_quantity }} этажей</p>
                @endif
                <div class="mt-3 rounded-lg bg-purple-50 p-3 dark:bg-purple-900/10">
                  <p class="text-xs text-purple-800 dark:text-purple-300">
                    💡 При наличии грузового лифта подъем не тарифицируется
                  </p>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

  {{-- Специальные услуги --}}
  @php
    $services = \App\Models\Service::where('is_published', true)->get();
  @endphp

  @if($services->isNotEmpty())
    <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
            <svg class="mr-2 inline-block h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            {{ prices_content('special_section_title', 'Специальные услуги') }}
          </h2>
          <p class="mt-2 text-gray-600 dark:text-gray-400">{{ prices_content('special_section_subtitle', 'Дополнительный сервис для комфортной перевозки') }}</p>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-lg dark:border-gray-700">
          <table class="w-full">
            <thead class="bg-gray-800 text-white dark:bg-gray-700">
              <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold">Услуга</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">Описание</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
              @foreach($services as $service)
                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      @if($service->is_popular)
                        <span class="mr-2 rounded-full bg-orange-100 px-2 py-1 text-xs font-semibold text-orange-800 dark:bg-orange-900/30 dark:text-orange-400">
                          Популярно
                        </span>
                      @endif
                      <span class="font-semibold text-gray-900 dark:text-white">{{ $service->name }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ $service->description ?? '—' }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
  @endif

  {{-- Условия работы --}}
  <section class="bg-gradient-to-br from-green-50 to-white py-16 dark:from-gray-800 dark:to-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ prices_content('conditions_section_title', 'Условия работы и оплаты') }}</h2>
        @if($desc = prices_content('conditions_section_description'))
            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $desc }}</p>
        @endif
      </div>

      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @php
            $conditions = prices_content('conditions_items');
        @endphp

        @if(!empty($conditions) && is_array($conditions))
            @foreach($conditions as $item)
                <div class="rounded-xl bg-white p-6 shadow-md dark:bg-gray-800">
                  <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">{{ $item['title'] ?? '' }}</h3>
                  </div>
                  <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                    {{ $item['description'] ?? '' }}
                  </p>
                </div>
            @endforeach
        @else
        {{-- Минимальный заказ --}}
        <div class="rounded-xl bg-white p-6 shadow-md dark:bg-gray-800">
          <div class="flex items-center">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
              <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">Минимальный заказ</h3>
          </div>
          <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            Минимальная продолжительность заказа — 2 часа работы транспорта и водителя
          </p>
        </div>

        {{-- Оплата --}}
        <div class="rounded-xl bg-white p-6 shadow-md dark:bg-gray-800">
          <div class="flex items-center">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
              <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">Способы оплаты</h3>
          </div>
          <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            Наличными водителю или безналичный расчет по договору с НДС
          </p>
        </div>

        {{-- Расчет --}}
        <div class="rounded-xl bg-white p-6 shadow-md dark:bg-gray-800">
          <div class="flex items-center">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
              <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
              </svg>
            </div>
            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">Расчет стоимости</h3>
          </div>
          <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            Итоговая цена = MAX(цена за км × км, цена за час × часы) + доп. услуги
          </p>
        </div>

        {{-- Подача --}}
        <div class="rounded-xl bg-white p-6 shadow-md dark:bg-gray-800">
          <div class="flex items-center">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/30">
              <svg class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">Подача транспорта</h3>
          </div>
          <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            Бесплатная подача по городу. За городом — по тарифу за км от МКАД
          </p>
        </div>

        {{-- Работа в праздники --}}
        <div class="rounded-xl bg-white p-6 shadow-md dark:bg-gray-800">
          <div class="flex items-center">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
              <svg class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">Праздничные дни</h3>
          </div>
          <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            В праздничные и выходные дни — надбавка +30% к базовому тарифу
          </p>
        </div>

        @endif
      </div>
    </div>
  </section>

  {{-- CTA секция --}}
  <section class="bg-gradient-to-r from-green-600 to-green-700 py-16">
    <div class="container mx-auto px-4 text-center sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-white">Рассчитайте точную стоимость прямо сейчас!</h2>
      <p class="mx-auto mt-4 max-w-2xl text-lg text-green-100">
        Воспользуйтесь нашим онлайн-калькулятором для расчета стоимости вашего заказа с учетом всех параметров
      </p>
      <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
        <a href="{{ route('calculator.index') }}"
           class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 font-semibold text-green-600 transition-colors hover:bg-gray-100">
          <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
          </svg>
          Открыть калькулятор
        </a>
        <a href="{{ route('contacts.index') }}"
           class="inline-flex items-center justify-center rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-colors hover:bg-green-800">
          <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
          Связаться с нами
        </a>
      </div>
    </div>
  </section>

  <x-site.footer />
</x-main-layout>
