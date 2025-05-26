<section class="bg-white py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="lg:grid lg:grid-cols-2 lg:gap-16">
      <!-- Text Section -->
      <div class="text-cyan-800 font-light sm:text-lg">
        @if ($page)
          <h2 class="text-4xl font-extrabold text-cyan-800 mb-6">{{ $page->ThirdTitle }}</h2>
          <p class="mb-4 text-lg">{!! $page->about_content !!}</p>
          <p class="text-lg">{!! $page->about_second_content !!}</p>
        @else
          <x-site.no-content />
        @endif
      </div>

      <!-- Interactive Content -->
      <div class="mt-8 lg:mt-0 grid grid-cols-2 gap-6">
        <!-- Security Features Card -->
        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
          <h3 class="text-xl font-bold text-cyan-800 mb-4">Безопасность вашего доступа</h3>
          <div class="space-y-4">
            <!-- Feature 1 -->
            <div class="flex items-start">
              <i class="fas fa-lock text-cyan-500 mr-3 text-xl"></i>
              <div>
                <h4 class="font-medium text-cyan-800">Шифрование ключей</h4>
                <p class="text-gray-600 text-sm">
                  Все ключи доступа защищены AES-256 шифрованием
                </p>
              </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex items-start">
              <i class="fas fa-shield-halved text-cyan-500 mr-3 text-xl"></i>
              <div>
                <h4 class="font-medium text-cyan-800">Ограничение сроков</h4>
                <p class="text-gray-600 text-sm">
                  Ключи автоматически expire через 30 дней
                </p>
              </div>
            </div>

            <!-- Feature 3 -->
            <div class="flex items-start">
              <i class="fas fa-receipt text-cyan-500 mr-3 text-xl"></i>
              <div>
                <h4 class="font-medium text-cyan-800">Аудит действий</h4>
                <p class="text-gray-600 text-sm">
                  Логирование всех операций с вашими ключами
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Subscription Progress Card -->
        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
          <h3 class="text-xl font-bold text-cyan-800 mb-4">Статус вашей подписки</h3>
          
          @auth
            @if (Auth::user()->activeSubscription)
              <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-sm text-gray-600">Текущий тариф:</span>
                  <span class="font-medium text-cyan-800">{{ Auth::user()->currentTariff->title }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div 
                    class="bg-gradient-to-r from-orange-400 to-pink-500 h-2.5 rounded-full" 
                    style="width: {{ Auth::user()->activeSubscription->progressPercentage() }}%"
                  ></div>
                </div>
                <div class="flex justify-between text-xs text-gray-600 mt-1">
                  <span>Начало: {{ Auth::user()->activeSubscription->start_date->format('d.m.Y') }}</span>
                  <span>Окончание: {{ Auth::user()->activeSubscription->end_date->format('d.m.Y') }}</span>
                </div>
              </div>

              <a href="{{ route('profile.edit') }}"
                class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-cyan-600 hover:to-blue-600 transition-colors w-full text-center"
              >
                Управление подпиской
              </a>
            @else
              <div class="text-center">
                <i class="fas fa-exclamation-circle text-cyan-500 text-3xl mb-3"></i>
                <p class="text-gray-600 mb-4">Подписка не активна</p>
                <a href="{{ route('profile.edit') }}"
                  class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-cyan-600 hover:to-blue-600 transition-colors w-full text-center"
                >
                  Выбрать тариф
                </a>
              </div>
            @endif
          @endauth

          @guest
            <div class="text-center">
              <i class="fas fa-user-lock text-cyan-500 text-3xl mb-3"></i>
              <p class="text-gray-600 mb-4">Авторизуйтесь для просмотра статуса подписки</p>
              <a href="{{ route('login') }}"
                class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-cyan-600 hover:to-blue-600 transition-colors w-full text-center"
              >
                Войти
              </a>
            </div>
          @endguest
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  @if ($page)
    <div class="mx-auto max-w-screen-xl py-8 px-6 lg:px-16">
      <div class="max-w-screen-lg text-cyan-800 sm:text-lg">
        <h2 class="text-4xl font-bold text-cyan-800 mb-6">{{ $page->FourthTitle }}</h2>
        <p class="text-lg font-light mb-6">{!! $page->footer_content !!}</p>
        <p class="text-lg font-medium">{!! $page->footer_second_content !!}</p>
      </div>
    </div>
  @endif
</section>


<!-- <section class="bg-slate-700">
  <div class="mx-auto max-w-screen-xl items-center gap-16 py-8 px-10 lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
    <div class="font-light text-violet-200 sm:text-lg">
      @if ($page)
        <h2 class="mb-4 text-4xl font-extrabold text-violet-200">{{ $page->ThirdTitle }}</h2>
        <p class="mb-4">{!! $page->about_content !!}</p>
        <p>{!! $page->about_second_content !!}</p>
      @endif
    </div>
    @if ($page)
      <div class="mt-8 grid grid-cols-2 gap-4">
        <img class="w-full rounded-lg" src="storage/{{ $page->first_photo_path }}" alt="Тут Доктор">
        <img class="mt-4 w-full rounded-lg lg:mt-10" src="storage/{{ $page->second_photo_path }}" alt="Тут Доктор">
      </div>
    @endif
  </div>

  @if ($page)
    <div class="mx-auto max-w-screen-xl py-8 px-10 lg:py-16 lg:px-6">
      <div class="max-w-screen-lg text-violet-200 sm:text-lg">
        <h2 class="mb-4 text-4xl font-bold text-violet-200">{{ $page->FourthTitle }}</h2>
        <p class="mb-4 font-light">{!! $page->footer_content !!}</p>
        <p class="mb-4 font-medium">{!! $page->footer_second_content !!}</p>
      </div>
    </div>
  @endif
</section> -->