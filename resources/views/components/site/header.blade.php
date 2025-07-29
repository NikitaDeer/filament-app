<header class="sticky top-0 z-40 bg-white shadow-md dark:bg-gray-800">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <!-- Логотип -->
      <div class="flex-shrink-0">
        <a href="/" class="flex items-center">
          <div class="rounded-lg bg-blue-600 p-2 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
              </path>
            </svg>
          </div>
          <div class="ml-3">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">СПБ Карго</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Грузоперевозки</p>
          </div>
        </a>
      </div>

      <!-- Навигация -->
      <div class="hidden lg:flex lg:items-center lg:space-x-8">
        <a href="{{ route('home') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Главная</a>
        <a href="{{ route('about.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">О нас</a>
        <a href="{{ route('services.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Услуги</a>
        <a href="{{ route('prices') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Цены</a>
        <a href="{{ route('calculator.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Калькулятор</a>
        <a href="#"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Контакты</a>
      </div>

      <!-- Правая часть -->
      <div class="flex items-center">
        <a href="{{ route('calculator.index') }}"
          class="hidden rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition-colors hover:bg-blue-700 sm:inline-block">
          Оставить заявку
        </a>

        <!-- Hamburger -->
        <div class="ml-4 lg:hidden">
          <x-site.hamburger />
        </div>
      </div>
    </div>
  </div>
</header>
