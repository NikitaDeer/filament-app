<header class="bg-base-100 shadow-md dark:bg-dark-base-100">
  <nav class="container mx-auto px-4 py-4 lg:px-6">
    <div class="flex items-center justify-between">
      <!-- Логотип -->
      <a href="/" class="text-2xl font-bold text-primary-500">Okolo</a>

      <!-- Мобильное меню -->
      <x-site.hamburger />

      <!-- Навигация -->
      <div class="hidden lg:block">
        <ul class="flex space-x-6">
          <li>
            <a href="{{ route('home') }}" class="hover:text-primary-500">Главная</a>
          </li>
          <li>
            <a href="{{ route('services') }}" class="hover:text-primary-500">Услуги</a>
          </li>
          <li>
            <a href="{{ route('about') }}" class="hover:text-primary-500">О компании</a>
          </li>
          <li>
            <a href="{{ route('pricing') }}" class="hover:text-primary-500">Цены</a>
          </li>
          <li>
            <a href="{{ route('calculator') }}" class="hover:text-primary-500">Калькулятор</a>
          </li>
          <li>
            <a href="{{ route('reviews') }}" class="hover:text-primary-500">Отзывы</a>
          </li>
          <li>
            <a href="{{ route('contact') }}" class="hover:text-primary-500">Контакты</a>
          </li>
        </ul>
      </div>

      <!-- Авторизация/Личный кабинет -->
      <div class="flex items-center space-x-4">
        @guest
          <a href="{{ route('login') }}" class="hover:text-primary-500">Войти</a>
          <a href="{{ route('register') }}"
            class="rounded bg-primary-500 px-4 py-2 text-white hover:bg-primary-600">Регистрация</a>
        @endguest

        @auth
          <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 hover:text-primary-500">
            <i class="fas fa-user-alt text-primary-500"></i>
            <span>Личный кабинет</span>
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-2 hover:text-primary-500">
              <i class="fas fa-door-open text-primary-500"></i>
              <span>Выйти</span>
            </button>
          </form>
        @endauth
      </div>
    </div>
  </nav>
</header>
