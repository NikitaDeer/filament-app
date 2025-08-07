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

      <!-- Навигация для десктопа -->
      <div class="hidden lg:flex lg:items-center lg:space-x-8">
        <a href="{{ route('home') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Главная</a>
        <a href="{{ route('about.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">О нас</a>
        <a href="{{ route('services.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Услуги</a>
        <a href="{{ route('prices.index') }}" class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Цены</a>
        <a href="{{ route('calculator.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Калькулятор</a>
        <a href="{{ route('contacts.index') }}"
          class="text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Контакты</a>
      </div>

      <!-- Правая часть -->
      <div class="flex items-center">
        <a href="{{ route('calculator.index') }}"
          class="hidden rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition-colors hover:bg-blue-700 sm:inline-block">
          Оставить заявку
        </a>

        <!-- Кнопка переключения темы -->
        <button id="theme-toggle" type="button" class="ml-2 z-50 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 transition-all duration-200 hover:scale-110">
          <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
          <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 5.05A1 1 0 003.636 6.464l.707.707a1 1 0 001.414-1.414l-.707-.707zM3 11a1 1 0 100-2H2a1 1 0 100 2h1zM6.464 16.364a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM13.536 16.364a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707z"></path></svg>
        </button>

        <!-- Hamburger -->
        <div class="ml-2 lg:hidden">
          <x-site.hamburger />
        </div>
      </div>
    </div>
  </div>

  <!-- Мобильное меню -->
  <div id="mobile-menu" class="hidden lg:hidden">
    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
      <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Главная</a>
      <a href="{{ route('about.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">О нас</a>
      <a href="{{ route('services.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Услуги</a>
      <a href="{{ route('prices.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Цены</a>
      <a href="{{ route('calculator.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Калькулятор</a>
      <a href="{{ route('contacts.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Контакты</a>
    </div>
  </div>
</header>
