<footer class="border-t bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
  <div class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
      <!-- Company Info -->
      <div>
        <div class="flex items-center">
          <div class="rounded-lg bg-blue-600 p-2 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
              </path>
            </svg>
          </div>
          <h1 class="ml-3 text-xl font-bold text-gray-800 dark:text-white">СПБ Карго</h1>
        </div>
        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
          Надежные грузоперевозки в Санкт-Петербурге и Ленинградской области. Работаем с частными лицами и малым
          бизнесом.
        </p>
      </div>
      <!-- Services -->
      <div>
        <h3 class="font-semibold text-gray-800 dark:text-white">Услуги</h3>
        @php
          $footerServices = \App\Models\Service::where('is_published', true)->latest()->take(6)->get(['id','name']);
        @endphp
        <ul class="mt-4 space-y-2">
          @foreach ($footerServices as $s)
            <li>
              <a href="{{ route('services.index') }}" class="text-gray-500 hover:text-blue-600 dark:text-gray-400">
                {{ $s->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
      <!-- Contacts -->
      <div>
        <h3 class="font-semibold text-gray-800 dark:text-white">Контакты</h3>
        <ul class="mt-4 space-y-3">
          <li class="flex items-center text-gray-500 dark:text-gray-400">
            <i class="fas fa-phone-alt mr-2 w-5 text-center"></i>
            <a href="tel:+78121234567" class="hover:text-blue-600">+7 (812) 123-45-67</a>
          </li>
          <li class="flex items-center text-gray-500 dark:text-gray-400">
            <i class="fas fa-envelope mr-2 w-5 text-center"></i>
            <a href="mailto:info@spbcargo.ru" class="hover:text-blue-600">info@spbcargo.ru</a>
          </li>
          <li class="flex items-center text-gray-500 dark:text-gray-400">
            <i class="fas fa-map-marker-alt mr-2 w-5 text-center"></i>
            <span>Санкт-Петербург</span>
          </li>
        </ul>
      </div>
      <!-- Working Hours -->
      <div>
        <h3 class="font-semibold text-gray-800 dark:text-white">Режим работы</h3>
        <ul class="mt-4 space-y-3">
          <li class="flex items-center text-gray-500 dark:text-gray-400">
            <i class="fas fa-clock mr-2 w-5 text-center"></i>
            <span>Пн-Вс: 8:00 - 22:00</span>
          </li>
          <li class="text-sm text-gray-500 dark:text-gray-400">
            Принимаем заявки круглосуточно
          </li>
        </ul>
      </div>
    </div>
    <div class="mt-12 border-t pt-8 text-center text-sm text-gray-400">
      <p>&copy; {{ date('Y') }} СПБ Карго. Все права защищены.</p>
    </div>
  </div>
</footer>
