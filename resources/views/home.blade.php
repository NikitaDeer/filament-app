<x-main-layout>

  {{-- Header --}}
  <x-site.header />

  {{-- Hero Section --}}
  <section class="bg-white dark:bg-gray-900">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 py-16 lg:grid-cols-2 lg:py-24">
      <!-- Левая колонка: Текст и CTA -->
      <div>
        <h1 class="text-4xl font-bold text-gray-800 dark:text-white lg:text-5xl">
          Надежные
          <span class="text-blue-600 dark:text-blue-500">грузоперевозки</span> в
          СПБ и ЛО
        </h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
          Быстро, безопасно и по честной цене. Рассчитайте стоимость доставки за 30 секунд с помощью нашего
          калькулятора.
        </p>
        <div class="mt-8 grid grid-cols-2 gap-6 text-gray-700 dark:text-gray-300">
          <div class="flex items-center">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Работаем 24/7</span>
          </div>
          <div class="flex items-center">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Опытные грузчики</span>
          </div>
          <div class="flex items-center">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Страхование груза</span>
          </div>
          <div class="flex items-center">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Фиксированные цены</span>
          </div>
        </div>
        <div class="mt-10 flex flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
          <a href="#"
            class="btn flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 font-semibold text-white transition-colors hover:bg-blue-700">
            Рассчитать стоимость
            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </a>
          <a href="#"
            class="btn flex items-center justify-center rounded-lg bg-gray-200 px-8 py-3 font-semibold text-gray-800 transition-colors hover:bg-gray-300">
            Связаться с нами
          </a>
        </div>
        <div class="mt-12 grid grid-cols-3 gap-8 text-center">
          <div>
            <p class="text-3xl font-bold text-blue-600">500+</p>
            <p class="text-gray-500">Довольных клиентов</p>
          </div>
          <div>
            <p class="text-3xl font-bold text-blue-600">24/7</p>
            <p class="text-gray-500">Работаем круглосуточно</p>
          </div>
          <div>
            <p class="text-3xl font-bold text-blue-600">5 лет</p>
            <p class="text-gray-500">Опыт работы</p>
          </div>
        </div>
      </div>

      <!-- Правая колонка: Изображение -->
      <div class="relative hidden lg:block">
        <div class="flex h-full items-center justify-center rounded-2xl bg-gray-100 p-8 dark:bg-gray-800">
          <svg class="h-48 w-48 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
          </svg>
        </div>
        <div class="absolute right-0 top-10 rounded-lg bg-white p-4 text-sm shadow-lg dark:bg-gray-700">
          <p class="font-semibold">Быстрая доставка</p>
          <p class="text-gray-500 dark:text-gray-400">от 30 минут</p>
        </div>
        <div class="absolute bottom-10 left-0 rounded-lg bg-white p-4 text-sm shadow-lg dark:bg-gray-700">
          <p class="font-semibold">Честные цены</p>
          <p class="text-gray-500 dark:text-gray-400">без скрытых доплат</p>
        </div>
      </div>
    </div>
  </section>

  {{-- Yandex Map Calculator Section --}}
  <section id="calculator" class="bg-gray-50 py-16 dark:bg-neutral-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="mb-12 text-center text-3xl font-bold sm:text-4xl">
        Онлайн-калькулятор
      </h2>
      @livewire('yandex-map-calculator')
    </div>
  </section>

  {{-- Advantages Section --}}
  <section class="bg-base-100 py-16 dark:bg-dark-base-100 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold sm:text-4xl">Наши преимущества</h2>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Почему клиенты выбирают нас</p>
      </div>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <!-- Advantage 1 -->
        <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-shipping-fast text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Скорость и сроки</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Гарантируем доставку в установленные сроки благодаря отлаженной логистике.
          </p>
        </div>
        <!-- Advantage 2 -->
        <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-shield-alt text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Безопасность груза</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Полная материальная ответственность и страхование каждого отправления.
          </p>
        </div>
        <!-- Advantage 3 -->
        <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-headset text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Поддержка 24/7</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Наши менеджеры всегда на связи и готовы ответить на любые ваши вопросы.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- Services Section --}}
  <section class="bg-gray-50 py-16 dark:bg-neutral-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold sm:text-4xl">Наши услуги</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
          Предоставляем полный спектр услуг по грузоперевозкам и грузовым работам для частных лиц и малого бизнеса в
          Санкт-Петербурге и области.
        </p>
      </div>
      @php
        $services = \App\Models\Service::where('is_published', true)->latest()->take(3)->get();
      @endphp
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
          <div
            class="transform rounded-lg bg-white p-6 shadow-lg transition-transform duration-300 hover:-translate-y-2 dark:bg-neutral-800">
            <div class="flex items-start justify-between">
              <div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $service->name }}</h3>
                <p class="mt-1 text-gray-500 dark:text-gray-400">от {{ $service->price }} ₽</p>
              </div>
              <div class="rounded-lg bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                </svg>
              </div>
            </div>
            <p class="mt-4 text-gray-600 dark:text-gray-300">{{ $service->description }}</p>
            <ul class="mt-4 space-y-2">
              @if (is_array($service->features))
                @foreach (array_slice($service->features, 0, 3) as $feature)
                  <li class="flex items-center text-gray-600 dark:text-gray-300">
                    <svg class="mr-2 h-5 w-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                      </path>
                    </svg>
                    <span>{{ $feature }}</span>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        @endforeach
      </div>
      <div class="mt-12 text-center">
        <a href="{{ route('services.index') }}"
          class="inline-flex items-center rounded-full border border-blue-600 px-6 py-3 font-semibold text-blue-600 transition-colors hover:text-blue-700 dark:border-blue-400 dark:text-blue-400 dark:hover:text-blue-500">
          Все услуги
          <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
            </path>
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- Footer --}}
  <x-site.footer />

</x-main-layout>
