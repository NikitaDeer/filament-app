<header class="bg-gray-900">
  <nav class="border-gray-700 bg-gray-900 px-4 py-2.5 lg:px-6">
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
</header>
