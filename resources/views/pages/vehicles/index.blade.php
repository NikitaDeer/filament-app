<x-main-layout>
  <!-- Hero -->
  <section class="bg-gradient-to-br from-green-50 to-white py-16 dark:from-gray-900 dark:to-gray-800 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
      <div class="mx-auto max-w-3xl text-center">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white sm:text-5xl">
          Наш автопарк
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
          Современный парк грузовых автомобилей для любых задач. От небольших газелей до крупнотоннажных фур.
          Все машины в отличном техническом состоянии и готовы к работе.
        </p>
      </div>
    </div>
  </section>

  <!-- Каталог транспорта -->
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      @php
        $vehicles = \App\Models\Vehicle::active()->ordered()->get();
      @endphp

      @if($vehicles->isEmpty())
        <div class="mx-auto max-w-md text-center">
          <div class="rounded-lg bg-gray-50 p-8 dark:bg-gray-800">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Нет доступного транспорта</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">В настоящий момент список транспорта пуст</p>
          </div>
        </div>
      @else
        <div class="mx-auto max-w-7xl">
          <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($vehicles as $vehicle)
              <article class="group relative flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-all hover:-translate-y-2 hover:shadow-xl dark:border-gray-700 dark:bg-gray-800">
                <!-- Изображение -->
                <div class="relative aspect-video w-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                  @if($vehicle->image)
                    <img src="{{ $vehicle->image_url }}" 
                         alt="{{ $vehicle->name }}" 
                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                  @else
                    <div class="flex h-full items-center justify-center">
                      <svg class="h-20 w-20 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                      </svg>
                    </div>
                  @endif
                  
                  <!-- Бейдж пассажиров -->
                  @if($vehicle->allows_passengers)
                    <div class="absolute right-3 top-3 rounded-full bg-green-600 px-3 py-1 text-xs font-semibold text-white shadow-lg">
                      <svg class="mr-1 inline-block h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                      </svg>
                      До {{ $vehicle->max_passengers }} чел.
                    </div>
                  @endif
                </div>

                <!-- Контент -->
                <div class="flex flex-1 flex-col p-6">
                  <!-- Заголовок -->
                  <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $vehicle->name }}
                  </h3>
                  
                  <!-- Описание -->
                  @if($vehicle->description)
                    <p class="mt-3 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                      {{ $vehicle->description }}
                    </p>
                  @endif

                  <!-- Характеристики -->
                  <div class="mt-6 space-y-3 border-t border-gray-200 pt-6 dark:border-gray-700">
                    <!-- Грузоподъемность -->
                    <div class="flex items-center justify-between">
                      <span class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Грузоподъемность
                      </span>
                      <span class="font-semibold text-gray-900 dark:text-white">{{ $vehicle->capacity_tons }} т</span>
                    </div>

                    <!-- Размеры -->
                    <div class="flex items-center justify-between">
                      <span class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                        Размеры (Д×Ш×В)
                      </span>
                      <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $vehicle->length_m }}×{{ $vehicle->width_m }}×{{ $vehicle->height_m }} м
                      </span>
                    </div>
                  </div>

                  <!-- Цены -->
                  <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="rounded-lg bg-green-50 p-3 text-center dark:bg-green-900/20">
                      <div class="text-xs font-medium text-gray-600 dark:text-gray-400">За километр</div>
                      <div class="mt-1 text-xl font-bold text-green-600 dark:text-green-400">
                        {{ number_format($vehicle->price_per_km, 0) }} ₽
                      </div>
                    </div>
                    <div class="rounded-lg bg-green-50 p-3 text-center dark:bg-green-900/20">
                      <div class="text-xs font-medium text-gray-600 dark:text-gray-400">За час</div>
                      <div class="mt-1 text-xl font-bold text-green-600 dark:text-green-400">
                        {{ number_format($vehicle->price_per_hour, 0) }} ₽
                      </div>
                    </div>
                  </div>

                  <!-- Кнопка заказа -->
                  <div class="mt-6">
                    <a href="{{ route('calculator.index') }}" 
                       class="inline-flex w-full items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white transition-all hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                      Заказать расчет
                      <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                      </svg>
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </section>

  <!-- Призыв к действию -->
  <section class="bg-gradient-to-br from-green-600 to-green-700 py-16 sm:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-3xl text-center">
        <h2 class="text-3xl font-bold text-white sm:text-4xl">
          Нужна консультация?
        </h2>
        <p class="mt-4 text-lg text-green-50">
          Наши специалисты помогут подобрать оптимальный транспорт для вашей задачи
        </p>
        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
          <a href="{{ route('calculator.index') }}" 
             class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 text-base font-semibold text-green-600 transition-all hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600">
            Рассчитать стоимость
          </a>
          <a href="{{ route('contacts.index') }}" 
             class="inline-flex items-center justify-center rounded-lg border-2 border-white px-8 py-3 text-base font-semibold text-white transition-all hover:bg-white hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600">
            Связаться с нами
          </a>
        </div>
      </div>
    </div>
  </section>
</x-main-layout>

