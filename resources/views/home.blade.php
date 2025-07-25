<x-main-layout>

  {{-- Header --}}
  <x-site.header />

  {{-- Hero Section --}}
  <section class="bg-base-100 py-16 dark:bg-dark-base-100 sm:py-24">
    <div class="container mx-auto px-4 text-center sm:px-6 lg:px-8">
      <h1 class="text-4xl font-extrabold text-primary-800 dark:text-primary-200 sm:text-5xl lg:text-6xl">
        Надежные грузоперевозки по всей стране
      </h1>
      <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-700 dark:text-gray-300 sm:text-xl">
        Быстрая доставка, отслеживание в реальном времени и калькулятор стоимости прямо на сайте.
      </p>
      <div class="mt-8">
        <a href="#calculator"
          class="btn rounded-lg bg-primary-500 px-8 py-3 text-lg font-semibold text-white transition-colors hover:bg-primary-600">
          Рассчитать стоимость
        </a>
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
        <div
          class="transform rounded-lg bg-gray-50 p-6 text-center shadow-md transition duration-300 hover:scale-105 dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-shipping-fast text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Скорость и сроки</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Гарантируем доставку в установленные сроки благодаря отлаженной логистике.
            Используем оптимальные маршруты и современный автопарк для быстрой доставки.
          </p>
        </div>
        <!-- Advantage 2 -->
        <div
          class="transform rounded-lg bg-gray-50 p-6 text-center shadow-md transition duration-300 hover:scale-105 dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-shield-alt text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Безопасность груза</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Полная материальная ответственность и страхование каждого отправления.
            Все грузы надежно упаковываются и защищаются от повреждений во время транспортировки.
          </p>
        </div>
        <!-- Advantage 3 -->
        <div
          class="transform rounded-lg bg-gray-50 p-6 text-center shadow-md transition duration-300 hover:scale-105 dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-headset text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Поддержка 24/7</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Наши менеджеры всегда на связи и готовы ответить на любые ваши вопросы.
            Круглосуточная поддержка по телефону и в мессенджерах для решения любых возникающих вопросов.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- Footer --}}
  <x-site.footer />

</x-main-layout>
