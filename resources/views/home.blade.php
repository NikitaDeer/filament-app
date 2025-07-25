<x-app-layout>
  {{-- Hero Section --}}
  <section class="bg-base-100 py-20 dark:bg-dark-base-100">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-4xl font-bold text-gray-800 dark:text-white sm:text-5xl lg:text-6xl">
        Надежные грузоперевозки по Санкт-Петербургу и ЛО
      </h1>
      <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
        Быстрый расчет стоимости, онлайн-заказ и отслеживание вашего груза в реальном времени.
      </p>
      <div class="mt-10">
        <a href="{{ route('calculator') }}"
          class="btn rounded-lg bg-primary-500 px-8 py-3 text-lg font-medium text-white transition-colors hover:bg-primary-600">
          Рассчитать стоимость
        </a>
      </div>
    </div>
  </section>

  {{-- Advantages Section --}}
  <section class="bg-gray-50 py-20 dark:bg-neutral-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-semibold sm:text-4xl">Наши преимущества</h2>
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Почему клиенты выбирают нас</p>
      </div>
      <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
        <!-- Advantage 1 -->
        <div
          class="transform rounded-xl bg-white p-8 text-center shadow-lg transition duration-300 hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-6 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/10">
              <i class="fas fa-shipping-fast text-3xl text-primary-500"></i>
            </div>
          </div>
          <h3 class="mb-4 text-xl font-medium">Скорость и сроки</h3>
          <p class="text-gray-600 dark:text-gray-300">
            Гарантируем доставку в установленные сроки благодаря отлаженной логистике и оптимальным маршрутам.
          </p>
        </div>
        <!-- Advantage 2 -->
        <div
          class="transform rounded-xl bg-white p-8 text-center shadow-lg transition duration-300 hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-6 inline-block">
            <div
              class="flex h-16 w-16 items-center justify-center rounded-full bg-secondary-100 dark:bg-secondary-900/10">
              <i class="fas fa-shield-alt text-3xl text-secondary-500"></i>
            </div>
          </div>
          <h3 class="mb-4 text-xl font-medium">Безопасность груза</h3>
          <p class="text-gray-600 dark:text-gray-300">
            Полная материальная ответственность и страхование каждого отправления для вашей уверенности.
          </p>
        </div>
        <!-- Advantage 3 -->
        <div
          class="transform rounded-xl bg-white p-8 text-center shadow-lg transition duration-300 hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-6 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-accent-100 dark:bg-accent-900/10">
              <i class="fas fa-headset text-3xl text-accent-500"></i>
            </div>
          </div>
          <h3 class="mb-4 text-xl font-medium">Поддержка 24/7</h3>
          <p class="text-gray-600 dark:text-gray-300">
            Наши менеджеры всегда на связи и готовы ответить на любые ваши вопросы в любое время суток.
          </p>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>
