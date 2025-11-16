<x-main-layout>
  {{-- Hero секция --}}
  <section class="bg-gradient-to-br from-green-50 via-white to-green-50 py-16 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <span class="inline-block rounded-full bg-green-600 px-4 py-1.5 text-sm font-semibold text-white">
          {{ services_content('hero_badge', 'Наши услуги') }}
        </span>
        <h1 class="mt-6 text-4xl font-bold text-gray-900 dark:text-white sm:text-5xl">
          {{ services_content('hero_title', 'Полный спектр услуг по грузоперевозкам') }}
        </h1>
        <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-gray-600 dark:text-gray-400">
          {{ services_content('hero_subtitle', 'От квартирных переездов до доставки строительных материалов — мы решаем любые задачи по транспортировке грузов. Профессиональное оборудование, опытные специалисты и гарантия качества.') }}
        </p>
        <div class="mt-8">
          <a href="{{ route('calculator.index') }}"
             class="inline-flex items-center rounded-lg bg-green-600 px-8 py-3 text-base font-semibold text-white transition-colors hover:bg-green-700">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Рассчитать стоимость
          </a>
        </div>
      </div>
    </div>
  </section>

  @php
    $calculatorServices = \App\Models\Service::where('is_published', true)
                                             ->where('is_calculator_option', true)
                                             ->get();
    $otherServices = \App\Models\Service::where('is_published', true)
                                        ->where('is_calculator_option', false)
                                        ->get();
    $popularService = $calculatorServices->where('is_popular', true)->first();
  @endphp

  {{-- Услуги доступные в калькуляторе --}}
  @if($calculatorServices->isNotEmpty())
    <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                <svg class="mr-2 inline-block h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Доступны в калькуляторе
              </h2>
              <p class="mt-2 text-gray-600 dark:text-gray-400">
                Эти услуги вы можете добавить при расчёте стоимости в онлайн-калькуляторе
              </p>
            </div>
            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-800 dark:bg-green-900/30 dark:text-green-400">
              {{ $calculatorServices->count() }} {{ $calculatorServices->count() === 1 ? 'услуга' : 'услуг' }}
            </span>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
          @foreach($calculatorServices as $service)
            <div class="group relative overflow-hidden rounded-2xl border-2 transition-all duration-300
                        @if($service->is_popular) border-orange-400 bg-gradient-to-br from-orange-50 to-white dark:border-orange-600 dark:from-orange-900/20 dark:to-gray-800
                        @else border-gray-200 bg-white hover:border-green-500 hover:shadow-xl dark:border-gray-700 dark:bg-gray-800 dark:hover:border-green-600 @endif">
              
              @if($service->is_popular)
                <div class="absolute right-4 top-4 z-10 rounded-full bg-orange-500 px-3 py-1 text-xs font-bold text-white shadow-lg">
                  ⭐ Популярно
                </div>
              @endif

              <div class="p-6">
                {{-- Иконка --}}
                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600 transition-colors group-hover:bg-green-600 group-hover:text-white dark:bg-green-900/30 dark:text-green-400">
                  @if($service->icon)
                    <i class="{{ $service->icon }} text-2xl"></i>
                  @else
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  @endif
                </div>

                {{-- Заголовок и цена --}}
                <div class="mb-3">
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $service->name }}</h3>
                  <div class="mt-2 flex items-baseline">
                    @if($service->price)
                      <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                        {{ number_format($service->price, 0, '.', ' ') }} ₽
                      </span>
                      @if($service->pricing_type === 'hourly')
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">/час</span>
                      @endif
                    @else
                      <span class="text-lg font-semibold text-gray-600 dark:text-gray-400">По запросу</span>
                    @endif
                  </div>
                </div>

                {{-- Описание --}}
                <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                  {{ $service->description }}
                </p>

                {{-- Особенности --}}
                @if(is_array($service->features) && count($service->features) > 0)
                  <div class="mb-4 space-y-2">
                    @foreach(array_slice($service->features, 0, 4) as $feature)
                      <div class="flex items-start text-sm text-gray-700 dark:text-gray-300">
                        <svg class="mr-2 mt-0.5 h-4 w-4 flex-shrink-0 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ $feature }}</span>
                      </div>
                    @endforeach
                  </div>
                @endif

                {{-- Кнопка --}}
                <a href="{{ route('calculator.index') }}"
                   class="mt-4 flex w-full items-center justify-center rounded-lg bg-green-600 px-4 py-3 text-sm font-semibold text-white transition-colors hover:bg-green-700">
                  <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                  </svg>
                  Добавить в расчёт
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- Остальные услуги --}}
  @if($otherServices->isNotEmpty())
    <section class="bg-gray-50 py-16 dark:bg-gray-800 sm:py-24">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                <svg class="mr-2 inline-block h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Дополнительные услуги
              </h2>
              <p class="mt-2 text-gray-600 dark:text-gray-400">
                Специализированные услуги для сложных задач. Стоимость рассчитывается индивидуально.
              </p>
            </div>
            <span class="rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
              {{ $otherServices->count() }} {{ $otherServices->count() === 1 ? 'услуга' : 'услуг' }}
            </span>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
          @foreach($otherServices as $service)
            <div class="group flex flex-col overflow-hidden rounded-2xl border-2 border-gray-200 bg-white transition-all duration-300 hover:border-blue-500 hover:shadow-xl dark:border-gray-700 dark:bg-gray-900 dark:hover:border-blue-600">
              <div class="flex flex-1 flex-col p-6">
                <div class="flex items-start justify-between">
                  {{-- Иконка --}}
                  <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    @if($service->icon)
                      <i class="{{ $service->icon }} text-xl"></i>
                    @else
                      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                      </svg>
                    @endif
                  </div>

                  {{-- Цена --}}
                  @if($service->price)
                    <div class="text-right">
                      <div class="text-xl font-bold text-blue-600 dark:text-blue-400">
                        {{ number_format($service->price, 0, '.', ' ') }} ₽
                      </div>
                      @if($service->pricing_type === 'hourly')
                        <div class="text-xs text-gray-600 dark:text-gray-400">за час</div>
                      @endif
                    </div>
                  @else
                    <div class="rounded-full bg-gray-100 px-3 py-1 text-sm font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                      По запросу
                    </div>
                  @endif
                </div>

                <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ $service->name }}</h3>
                
                <p class="mt-2 flex-1 text-sm text-gray-600 dark:text-gray-400">
                  {{ $service->description }}
                </p>

                {{-- Особенности --}}
                @if(is_array($service->features) && count($service->features) > 0)
                  <div class="mt-4 grid grid-cols-2 gap-2">
                    @foreach(array_slice($service->features, 0, 4) as $feature)
                      <div class="flex items-center text-xs text-gray-700 dark:text-gray-300">
                        <svg class="mr-1.5 h-3 w-3 flex-shrink-0 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ $feature }}</span>
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>

              {{-- Кнопка связи --}}
              <div class="border-t border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
                <a href="{{ route('contacts.index') }}"
                   class="flex w-full items-center justify-center rounded-lg border-2 border-blue-600 px-4 py-2.5 text-sm font-semibold text-blue-600 transition-colors hover:bg-blue-600 hover:text-white dark:border-blue-500 dark:text-blue-400 dark:hover:bg-blue-500">
                  <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                  Связаться с нами
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- Блок с калькулятором --}}
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="rounded-3xl bg-gradient-to-r from-green-600 to-green-700 p-12 text-center shadow-2xl">
        <h2 class="text-3xl font-bold text-white">Не нашли нужную услугу?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-green-100">
          Мы выполняем индивидуальные заказы любой сложности. Рассчитайте стоимость в нашем калькуляторе или свяжитесь с нами напрямую.
        </p>
        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
          <a href="{{ route('calculator.index') }}"
             class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 font-semibold text-green-600 transition-colors hover:bg-gray-100">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Рассчитать стоимость
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
    </div>
  </section>

  <x-site.footer />
</x-main-layout>
