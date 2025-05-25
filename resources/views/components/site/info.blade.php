<section class="bg-white py-16">
  @if (session('success'))
    <div id="notification" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-screen bg-opacity-50 bg-black">
      <div class="rounded-lg bg-gray-800 border border-gray-700 py-8 px-16 shadow-2xl transform transition-all duration-500 ease-in-out">
        <p class="text-white text-lg font-semibold text-center">{{ session('success') }}</p>
      </div>
    </div>

    <script>
      setTimeout(function() {
        const notification = document.getElementById('notification');
        let opacity = 1;
        const timer = setInterval(function() {
          if (opacity <= 0.1) {
            clearInterval(timer);
            notification.style.display = 'none';
          }
          notification.style.opacity = opacity;
          notification.style.filter = 'alpha(opacity=' + opacity * 100 + ")";
          opacity -= opacity * 0.1;
        }, 50);
      }, 1000);
    </script>
  @endif

  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="grid lg:grid-cols-12 gap-12 items-center">
      <!-- Text Section -->
      <div class="lg:col-span-7">
        @if ($page)
          <h1 class="text-4xl sm:text-5xl xl:text-6xl font-extrabold text-cyan-600 mb-6">
            {{ $page->FirstTitle }}
          </h1>
          <p class="text-gray-700 text-lg sm:text-xl mb-8">
            {!! $page->content !!}
          </p>
        @else
          <x-site.no-content />
        @endif

        <div class="flex flex-col sm:flex-row gap-4">
          @guest
            <a href="#"
              class="w-full sm:w-auto bg-gradient-to-r from-orange-400 to-pink-500 text-white rounded-lg py-3 px-8 text-lg font-semibold text-center hover:from-orange-500 hover:to-pink-600 transition-all">
              Подключить VPN Okolo
            </a>
          @endguest

          @auth
            <a href="{{ route('orders.create') }}"
              class="w-full sm:w-auto bg-gradient-to-r from-orange-400 to-pink-500 text-white rounded-lg py-3 px-8 text-lg font-semibold text-center hover:from-orange-500 hover:to-pink-600 transition-all">
              Подключить VPN Okolo
            </a>
          @endauth

          @can('view', auth()->user())
            <a href="/admin" class="text-cyan-600 hover:text-cyan-800 mt-4 sm:mt-0">
              Перейти в админ панель
            </a>
          @endcan
        </div>
      </div>

      <!-- FAQ Accordion -->
      <div class="lg:col-span-5">
        <div class="bg-gray-50 rounded-2xl p-6 shadow-md">
          <h2 class="text-xl font-bold text-cyan-600 mb-4">Часто задаваемые вопросы</h2>
          
          <!-- FAQ Item 1 -->
          <div class="mb-3">
            <button 
              type="button" 
              class="flex justify-between items-center w-full text-left p-3 bg-white rounded-lg focus:outline-none"
              onclick="toggleAccordion('faq1')"
            >
              <span>Как работает пробный период?</span>
              <i class="fas fa-plus text-cyan-600"></i>
            </button>
            <div id="faq1" class="overflow-hidden transition-all duration-300 max-h-0">
              <p class="text-gray-700 mt-2">
                Пробный период предоставляется автоматически после подтверждения почты. 
                Он длится 7 дней и позволяет протестировать все функции сервиса без оплаты.
              </p>
            </div>
          </div>

          <!-- FAQ Item 2 -->
          <div class="mb-3">
            <button 
              type="button" 
              class="flex justify-between items-center w-full text-left p-3 bg-white rounded-lg focus:outline-none"
              onclick="toggleAccordion('faq2')"
            >
              <span>Как обновить подписку?</span>
              <i class="fas fa-plus text-cyan-600"></i>
            </button>
            <div id="faq2" class="overflow-hidden transition-all duration-300 max-h-0">
              <p class="text-gray-700 mt-2">
                Для обновления подписки перейдите в личный кабинет > Подписки > Выберите новый тариф и оплатите его.
              </p>
            </div>
          </div>

          <!-- FAQ Item 3 -->
          <div>
            <button 
              type="button" 
              class="flex justify-between items-center w-full text-left p-3 bg-white rounded-lg focus:outline-none"
              onclick="toggleAccordion('faq3')"
            >
              <span>Где хранятся мои ключи доступа?</span>
              <i class="fas fa-plus text-cyan-600"></i>
            </button>
            <div id="faq3" class="overflow-hidden transition-all duration-300 max-h-0">
              <p class="text-gray-700 mt-2">
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
  const icon = event.target.querySelector('i');
  
  if (content.classList.contains('max-h-0')) {
    content.classList.remove('max-h-0');
    icon.classList.remove('transform');
    icon.classList.add('transform', 'rotate-45');
  } else {
    content.classList.add('max-h-0');
    icon.classList.remove('transform', 'rotate-45');
  }
}
</script>


<!-- <div class="lg:col-span-5">
        @if ($page)
          <div class="rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
            <img class="w-full h-auto object-cover transform hover:scale-105 transition-transform" 
                 src="storage/{{ $page->main_photo_path }}" 
                 alt="VPN Okolo">
          </div>
        @else
          <x-site.no-content />
        @endif
      </div> -->

<!-- <section class="bg-slate-800">
  @if (session('success'))
    <div id="notification" class="fixed top-0 left-0 z-50 flex h-screen w-screen items-center justify-center"
      style="background-color: rgba(0, 0, 0, .5);">
      <div class="rounded bg-slate-800 py-16 px-32 shadow-lg">
        <p class="text-violet-200">{{ session('success') }}</p>
      </div>
    </div>

    <script>
      setTimeout(function() {
        const notification = document.getElementById('notification');
        let opacity = 1;
        const timer = setInterval(function() {
          if (opacity <= 0.1) {
            clearInterval(timer);
            notification.style.display = 'none';
          }
          notification.style.opacity = opacity;
          notification.style.filter = 'alpha(opacity=' + opacity * 100 + ")";
          opacity -= opacity * 0.1;
        }, 50);
      }, 1000);
    </script>
  @endif

  <div class="mx-auto grid max-w-screen-xl px-10 py-8 lg:grid-cols-12 lg:gap-8 lg:py-16 lg:px-6 xl:gap-0">
    <div class="mr-auto place-self-center lg:col-span-7">
      @if ($page)
        <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none text-violet-200 md:text-5xl xl:text-6xl">
          {{ $page->FirstTitle }}
        </h1>
        <p class="mb-6 max-w-2xl font-light text-violet-200 md:text-lg lg:mb-8 lg:text-xl">
          {!! $page->content !!}
        </p>
      @else
        <x-site.no-content />
      @endif
      
      @guest
        <a href="#"
          class="mr-3 inline-flex items-center justify-center rounded-lg bg-violet-500 py-3 px-5 text-center text-base font-medium text-white hover:bg-violet-700 focus:ring-4 focus:ring-violet-700">
          Позвоните мне!
        </a>
      @endguest

      @auth
        <a href="{{ route('orders.create') }}"
          class="mr-3 inline-flex items-center justify-center rounded-lg bg-violet-500 py-3 px-5 text-center text-base font-medium text-white hover:bg-violet-700 focus:ring-4 focus:ring-violet-700">
          Оставить заявку
        </a>
      @endauth

      @can('view', auth()->user())
        <a href="/admin" class="text-violet-200 hover:text-violet-400">Перейти в админ панель</a>
      @endcan

    </div>
    <div class="hidden lg:col-span-5 lg:mt-0 lg:flex">
      @if ($page)
        <img class="rounded-full" src="storage/{{ $page->main_photo_path }}" alt="Тут Доктор">
      @else
        <x-site.no-content />
      @endif
    </div>
  </div>
</section> -->