<header class="bg-white shadow-md">
  <nav class="container mx-auto px-4 py-4 lg:px-6">
    <div class="flex items-center justify-between">
      <!-- Логотип -->
      <a href="/" class="text-cyan-500 text-2xl font-bold">Okolo</a>

      <!-- Мобильное меню -->
      <x-site.hamburger />

      <!-- Навигация -->
      <div class="hidden lg:block">
        <ul class="flex space-x-6">
          <li>
            <a href="#" class="text-gray-800 hover:text-cyan-500">Главная</a>
          </li>
          <li>
            <a href="#" class="text-gray-800 hover:text-cyan-500">Тарифы</a>
          </li>
          <li>
            <a href="#" class="text-gray-800 hover:text-cyan-500">О нас</a>
          </li>
          <li>
            <a href="#" class="text-gray-800 hover:text-cyan-500">Контакты</a>
          </li>
        </ul>
      </div>

      <!-- Авторизация/Личный кабинет -->
      <div class="flex items-center space-x-4">
        @guest
          <a href="{{ route('login') }}" class="text-gray-800 hover:text-cyan-500">Войти</a>
          <a href="{{ route('register') }}" class="bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-600">Регистрация</a>
        @endguest

        @auth
          <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2">
            <i class="fas fa-user-alt text-cyan-500"></i>
            <span>Личный кабинет</span>
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-2">
              <i class="fas fa-door-open text-cyan-500"></i>
              <span>Выйти</span>
            </button>
          </form>
        @endauth
      </div>
    </div>
  </nav>
</header>

<!-- <header class="bg-slate-900">
  <nav class="border-gray-700 bg-slate-900 px-4 py-2.5 lg:px-6">
    <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between">
      <a href="https://forestking.dergunov.info" class="flex items-center">
        {{-- <img src="сюда лого" class="mr-3 h-6 sm:h-9" alt="Lorem Logo" /> --}}
        <span class="text-violet-600 self-center whitespace-nowrap text-3xl font-semibold">VPN Okolo</span>
      </a>
      <div class="flex items-center lg:order-2">
        @guest
          <a href="{{ route('login') }}"
            class="mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-white hover:text-violet-800 hover:bg-purple-300 focus:outline-none focus:ring-4 focus:ring-purple-300">Войти</a>

          <a href="{{ route('register') }}"
            class="mr-2 rounded-lg bg-violet-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-700">Регистрация</a>
        @endguest

        @auth
          <form method="POST"
            class="mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-300"
            action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
              onclick="event.preventDefault();
                                        this.closest('form').submit();">
              {{ __('Выйти из аккаунта') }}
            </x-responsive-nav-link>
          </form>
          {{-- <a href="{{ route('logout') }}"
            class="mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-red-800 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-300">Выйти из аккаунта</a> --}}
        @endauth

        <x-site.hamburger />

      </div>
      <div class="hidden w-full items-center justify-between lg:order-1 lg:flex lg:w-auto" id="mobile-menu-2">
        <ul class="mt-4 flex flex-col font-medium lg:mt-0 lg:flex-row lg:space-x-8">
          <li>
            <a href="#"
              class="bg-primary-700 lg:text-primary-700 block rounded py-2 pr-4 pl-3 text-violet-400 lg:bg-transparent lg:p-0"
              aria-current="page">Главная</a>
          </li>
          {{-- <li>
            <a href="#"
              class="lg:hover:text-primary-700 block border-b border-gray-100 py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 lg:border-0 lg:p-0 lg:hover:bg-transparent">Company</a>
          </li>
          <li>
            <a href="#"
              class="lg:hover:text-primary-700 block border-b border-gray-100 py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 lg:border-0 lg:p-0 lg:hover:bg-transparent">Marketplace</a>
          </li>
          <li>
            <a href="#"
              class="lg:hover:text-primary-700 block border-b border-gray-100 py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 lg:border-0 lg:p-0 lg:hover:bg-transparent">Features</a>
          </li>
          <li>
            <a href="#"
              class="lg:hover:text-primary-700 block border-b border-gray-100 py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 lg:border-0 lg:p-0 lg:hover:bg-transparent">Team</a>
          </li>
          <li>
            <a href="#"
              class="lg:hover:text-primary-700 block border-b border-gray-100 py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 lg:border-0 lg:p-0 lg:hover:bg-transparent">Contact</a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>
</header> -->
