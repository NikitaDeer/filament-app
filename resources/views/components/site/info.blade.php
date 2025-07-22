<section class="bg-base-100 dark:bg-dark-base-100 py-16">
  @if (session('success'))
    <div id="notification" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-gradient-to-r from-primary-500 to-primary-700 rounded-2xl p-6 shadow-xl transform transition-all duration-500">
        <p class="text-white text-lg font-semibold text-center">{{ session('success') }}</p>
      </div>
    </div>

    <script>
      setTimeout(() => {
        const notification = document.getElementById('notification');
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 500);
      }, 3000);
    </script>
  @endif

  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="grid lg:grid-cols-12 gap-12 items-center">
      <!-- Text Section -->
      <div class="lg:col-span-7">
        @if ($page)
          <h1 class="text-4xl sm:text-5xl xl:text-6xl font-extrabold text-primary-600 dark:text-primary-400 mb-6">
            {{ $page->FirstTitle }}
          </h1>
          <p class="text-lg sm:text-xl mb-8">
            {!! $page->content !!}
          </p>
        @else
          <x-site.no-content />
        @endif

        <div class="flex flex-col sm:flex-row gap-4">
          @guest
            <a href="#"
              class="w-full sm:w-auto bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg py-3 px-8 text-lg font-semibold text-center hover:from-primary-600 hover:to-primary-700 transition-all">
              Подключить Okolo
            </a>
          @endguest

          @auth
            <a href="{{ route('orders.create') }}"
              class="w-full sm:w-auto bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg py-3 px-8 text-lg font-semibold text-center hover:from-primary-600 hover:to-primary-700 transition-all">
              Подключить Okolo
            </a>
          @endauth

          @can('view', auth()->user())
            <a href="/admin" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-200 mt-4 sm:mt-0 flex items-center gap-2">
              <i class="fas fa-cog"></i> Админ панель
            </a>
          @endcan
        </div>
      </div>

      <!-- FAQ Accordion -->
      <div class="lg:col-span-5">
        <div class="bg-gray-50 dark:bg-neutral-800 rounded-3xl p-6 shadow-lg border border-gray-200 dark:border-neutral-700">
          <h2 class="text-2xl font-bold text-primary-600 dark:text-primary-400 mb-6">Часто задаваемые вопросы</h2>
          
          <!-- FAQ Item 1 -->
          <div class="border-b border-gray-200 dark:border-neutral-700 last:border-b-0">
            <button 
              type="button" 
              class="flex justify-between items-center w-full text-left p-4 focus:outline-none"
              onclick="toggleAccordion('faq1')"
            >
              <span class="font-medium">Как работает пробный период?</span>
              <i class="fas fa-chevron-down text-primary-600 dark:text-primary-400 transition-transform transform" id="icon-faq1"></i>
            </button>
            <div id="faq1" class="overflow-hidden transition-all duration-300 max-h-0 px-4">
              <p class="text-gray-600 dark:text-gray-400 mb-4">
                Пробный период предоставляется автоматически после подтверждения почты. 
                Он длится 7 дней и позволяет протестировать все функции сервиса без оплаты.
              </p>
            </div>
          </div>

          <!-- FAQ Item 2 -->
          <div class="border-b border-gray-200 dark:border-neutral-700 last:border-b-0">
            <button 
              type="button" 
              class="flex justify-between items-center w-full text-left p-4 focus:outline-none"
              onclick="toggleAccordion('faq2')"
            >
              <span class="font-medium">Как обновить подписку?</span>
              <i class="fas fa-chevron-down text-primary-600 dark:text-primary-400 transition-transform transform" id="icon-faq2"></i>
            </button>
            <div id="faq2" class="overflow-hidden transition-all duration-300 max-h-0 px-4">
              <p class="text-gray-600 dark:text-gray-400 mb-4">
                Для обновления подписки перейдите в личный кабинет > Подписки > Выберите новый тариф и оплатите его.
              </p>
            </div>
          </div>

          <!-- FAQ Item 3 -->
          <div>
            <button 
              type="button" 
              class="flex justify-between items-center w-full text-left p-4 focus:outline-none"
              onclick="toggleAccordion('faq3')"
            >
              <span class="font-medium">Где хранятся мои ключи доступа?</span>
              <i class="fas fa-chevron-down text-primary-600 dark:text-primary-400 transition-transform transform" id="icon-faq3"></i>
            </button>
            <div id="faq3" class="overflow-hidden transition-all duration-300 max-h-0 px-4">
              <p class="text-gray-600 dark:text-gray-400 mb-4">
                Ключи доступа зашифрованы и хранятся в нашей базе данных. 
                Вы можете всегда найти их в разделе "Ключи доступа" вашего личного кабинета.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function toggleAccordion(id) {
    const content = document.getElementById(id);
    const icon = document.querySelector(`#icon-${id}`);
    content.style.maxHeight = content.style.maxHeight ? null : `${content.scrollHeight}px`;
    icon.classList.toggle('rotate-180');
  }
</script>