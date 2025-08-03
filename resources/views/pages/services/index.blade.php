<x-main-layout>
  <x-site.header />

  <main class="py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <span
          class="me-2 rounded bg-gray-200 px-2.5 py-0.5 text-sm font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-200">Наши
          услуги</span>
        <h1 class="mt-4 text-4xl font-bold sm:text-5xl">Полный спектр услуг по грузоперевозкам</h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">От квартирных переездов до доставки
          строительных материалов — мы решаем любые задачи по транспортировке грузов</p>
      </div>

      <div class="mt-16">
        <h2 class="text-center text-3xl font-bold">Основные услуги</h2>
        <p class="mt-2 text-center text-gray-500">Выберите подходящую услугу для ваших потребностей</p>

        @php
          $services = \App\Models\Service::where('is_published', true)->get();
          $popularService = $services->firstWhere('is_popular', true);
        @endphp

        <div class="mt-12 grid grid-cols-1 gap-8 lg:grid-cols-2">
          @if ($popularService)
            <div
              class="relative transform rounded-lg border-2 border-blue-500 bg-white p-8 shadow-lg transition-transform duration-300 hover:-translate-y-2 dark:bg-neutral-800">
              <span
                class="absolute top-0 -translate-y-1/2 rounded-full bg-gray-800 px-3 py-1 text-xs font-semibold text-white">Популярно</span>
              @include('pages.services.partials.service-card', ['service' => $popularService])
            </div>
          @endif

          @foreach ($services->where('is_popular', false) as $service)
            <div
              class="transform rounded-lg bg-white p-8 shadow-lg transition-transform duration-300 hover:-translate-y-2 dark:bg-neutral-800">
              @include('pages.services.partials.service-card', ['service' => $service])
            </div>
          @endforeach
        </div>
      </div>

      <div class="mt-24 rounded-lg bg-gray-100 p-12 text-center dark:bg-gray-800">
        <h2 class="text-3xl font-bold">Не нашли нужную услугу?</h2>
        <p class="mx-auto mt-4 max-w-xl text-gray-600 dark:text-gray-400">Мы выполняем индивидуальные заказы любой
          сложности. Рассчитайте стоимость в нашем калькуляторе или свяжитесь с нами напрямую.</p>
        <div class="mt-8 flex justify-center gap-4">
          <a href="{{ route('calculator.index') }}"
            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 font-semibold text-white transition-colors hover:bg-blue-700">
            Рассчитать стоимость
            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </a>
          <a href="#"
            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-8 py-3 font-semibold text-gray-800 transition-colors hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
            Связаться с нами
          </a>
        </div>
      </div>
    </div>
  </main>

  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      @livewire('yandex-map-calculator')
    </div>
  </section>

  <x-site.footer />
</x-main-layout>
