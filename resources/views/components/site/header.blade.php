<header class="bg-base-100 dark:bg-dark-base-100 shadow-md">
  <nav class="container mx-auto px-4 py-4 lg:px-6">
    <div class="flex items-center justify-between">
      <!-- Логотип -->
      <a href="/" class="text-primary-500 text-2xl font-bold">Okolo</a>

      <!-- Мобильное меню -->
      <x-site.hamburger />

      <!-- Навигация -->
      <div class="hidden lg:block">
        <ul class="flex space-x-6">
          <li>
            <a href="#" class="hover:text-primary-500">Главная</a>
          </li>
          <li>
            <a href="#" class="hover:text-primary-500">Тарифы</a>
          </li>
          <li>
            <a href="#" class="hover:text-primary-500">О нас</a>
          </li>
          <li>
            <a href="#" class="hover:text-primary-500">Контакты</a>
          </li>
        </ul>
      </div>

      <!-- Авторизация/Личный кабинет -->
      <div class="flex items-center space-x-4">
        @guest
          <a href="{{ route('login') }}" class="hover:text-primary-500">Войти</a>
          <a href="{{ route('register') }}" class="bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600">Регистрация</a>
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
