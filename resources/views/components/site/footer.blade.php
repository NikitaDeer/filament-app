<footer class="border-t border-gray-200 bg-white dark:border-neutral-800 dark:bg-neutral-900">
  <div class="container mx-auto px-6 py-12 lg:px-8">
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-4">
      <div class="lg:col-span-2">
        <h3 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">Okolo™</h3>
        <p class="max-w-md leading-relaxed text-gray-600 dark:text-gray-400">
          Ваш надежный партнер в области грузоперевозок по Санкт-Петербургу и Ленинградской области. Мы гарантируем
          быструю и безопасную доставку ваших грузов.
        </p>
      </div>

      <div>
        <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Навигация</h4>
        <ul class="space-y-3">
          <li><a href="{{ route('home') }}"
              class="text-gray-600 transition-colors hover:text-primary-500 dark:text-gray-300 dark:hover:text-primary-400">Главная</a>
          </li>
          <li><a href="{{ route('services') }}"
              class="text-gray-600 transition-colors hover:text-primary-500 dark:text-gray-300 dark:hover:text-primary-400">Услуги</a>
          </li>
          <li><a href="{{ route('about') }}"
              class="text-gray-600 transition-colors hover:text-primary-500 dark:text-gray-300 dark:hover:text-primary-400">О
              компании</a></li>
          <li><a href="{{ route('contact') }}"
              class="text-gray-600 transition-colors hover:text-primary-500 dark:text-gray-300 dark:hover:text-primary-400">Контакты</a>
          </li>
        </ul>
      </div>

      <div>
        <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Контакты</h4>
        <ul class="space-y-3">
          <li class="flex items-center text-gray-600 dark:text-gray-300">
            <i class="fas fa-phone-alt w-5 text-primary-500"></i>
            <a href="tel:+78121234567" class="ml-3 hover:text-primary-500">+7 (812) 123-45-67</a>
          </li>
          <li class="flex items-center text-gray-600 dark:text-gray-300">
            <i class="fas fa-envelope w-5 text-primary-500"></i>
            <a href="mailto:info@example-cargo.ru" class="ml-3 hover:text-primary-500">info@okolo.ru</a>
          </li>
          <li class="flex items-center text-gray-600 dark:text-gray-300">
            <i class="fas fa-map-marker-alt w-5 text-primary-500"></i>
            <span class="ml-3">Санкт-Петербург, ул. Промышленная, д. 5</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-12 border-t border-gray-200 pt-8 dark:border-neutral-800">
      <div class="flex flex-col items-center justify-between sm:flex-row">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          © {{ date('Y') }} Okolo™. Все права защищены.
        </p>
        <div class="mt-4 flex space-x-4 sm:mt-0">
          <a href="#" class="text-gray-500 hover:text-primary-500"><i class="fab fa-telegram-plane"></i></a>
          <a href="#" class="text-gray-500 hover:text-primary-500"><i class="fab fa-vk"></i></a>
          <a href="#" class="text-gray-500 hover:text-primary-500"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>
