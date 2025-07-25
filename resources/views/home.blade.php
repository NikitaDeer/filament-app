<x-app-layout>
  {{-- Hero Section with Calculator --}}
  <section class="relative bg-gray-800 py-20 text-white">
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80"
        alt="Грузоперевозки" class="h-full w-full object-cover opacity-40">
    </div>
    <div class="container relative mx-auto px-4">
      <div class="grid items-center gap-12 lg:grid-cols-2">
        <div class="prose prose-lg text-white">
          <h1 class="text-4xl font-bold text-white sm:text-5xl">Ваш надежный партнер в области грузоперевозок</h1>
          <p class="mt-4">
            Swift Logistics предлагает надежные и эффективные услуги по перевозке грузов с учетом ваших потребностей. От
            местных доставок до международных перевозок, мы гарантируем, что ваш груз прибудет в целости и сохранности.
          </p>
          <ul class="mt-6 list-none space-y-2 p-0">
            <li class="flex items-center"><i class="fas fa-check-circle mr-2 text-primary-400"></i>Собственный автопарк
            </li>
            <li class="flex items-center"><i class="fas fa-check-circle mr-2 text-primary-400"></i>Страхование грузов
            </li>
            <li class="flex items-center"><i class="fas fa-check-circle mr-2 text-primary-400"></i>Отслеживание в
              реальном времени</li>
            <li class="flex items-center"><i class="fas fa-check-circle mr-2 text-primary-400"></i>Поддержка 24/7</li>
          </ul>
        </div>
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
