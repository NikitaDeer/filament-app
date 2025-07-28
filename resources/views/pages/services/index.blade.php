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
            <div class="relative rounded-lg border-2 border-blue-500 bg-white p-8 shadow-lg dark:bg-neutral-800">
              <span
                class="absolute top-0 -translate-y-1/2 rounded-full bg-gray-800 px-3 py-1 text-xs font-semibold text-white">Популярно</span>
              @include('pages.services.partials.service-card', ['service' => $popularService])
            </div>
          @endif

          @foreach ($services->where('is_popular', false) as $service)
            <div class="rounded-lg bg-white p-8 shadow-lg dark:bg-neutral-800">
              @include('pages.services.partials.service-card', ['service' => $service])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  <x-site.footer />
</x-main-layout>
