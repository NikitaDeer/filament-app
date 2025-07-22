<section class="bg-base-100 dark:bg-dark-base-100 py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="lg:grid lg:grid-cols-2 lg:gap-16">
      <!-- Text Section -->
      <div class="font-light sm:text-lg">
        @if ($page)
          <h2 class="text-4xl font-extrabold text-primary-800 dark:text-primary-200 mb-6">{{ $page->ThirdTitle }}</h2>
          <p class="mb-4 text-lg">{!! $page->about_content !!}</p>
          <p class="text-lg">{!! $page->about_second_content !!}</p>
        @else
          <x-site.no-content />
        @endif
      </div>

      <!-- Interactive Content -->
      <div class="mt-8 lg:mt-0 grid grid-cols-2 gap-6">
        <!-- Security Features Card -->
        <div class="bg-gray-50 dark:bg-neutral-800 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
          <h3 class="text-xl font-bold text-primary-800 dark:text-primary-200 mb-4">Безопасность вашего доступа</h3>
          <div class="space-y-4">
            <!-- Feature 1 -->
            <div class="flex items-start">
              <i class="fas fa-lock text-primary-500 dark:text-primary-400 mr-3 text-xl"></i>
              <div>
                <h4 class="font-medium text-primary-800 dark:text-primary-200">Шифрование ключей</h4>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                  Все ключи доступа защищены RSA-256 шифрованием
                </p>
              </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex items-start">
              <i class="fas fa-shield-halved text-primary-500 dark:text-primary-400 mr-3 text-xl"></i>
              <div>
                <h4 class="font-medium text-primary-800 dark:text-primary-200">Ограничение сроков</h4>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                  Ключи автоматически истекают согласно тарифу
                </p>
              </div>
            </div>

            <!-- Feature 3 -->
            <div class="flex items-start">
              <i class="fas fa-receipt text-primary-500 dark:text-primary-400 mr-3 text-xl"></i>
              <div>
                <h4 class="font-medium text-primary-800 dark:text-primary-200">Аудит действий</h4>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                  Логирование всех операций с вашими ключами
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Subscription Progress Card -->
        <div class="bg-gray-50 dark:bg-neutral-800 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
          <h3 class="text-xl font-bold text-primary-800 dark:text-primary-200 mb-4">Статус вашей подписки</h3>
          
          @auth
            @php
              $user = Auth::user();
              $activeSubscription = $user->activeSubscription;
              $currentTariff = $user->currentTariff;
            @endphp

            @if ($activeSubscription && $activeSubscription->tariff)
              <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-sm text-gray-600 dark:text-gray-400">Текущий тариф:</span>
                  <span class="font-medium text-primary-800 dark:text-primary-200">{{ $activeSubscription->tariff->title }}</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-neutral-700 rounded-full h-2.5">
                  <div 
                    class="bg-gradient-to-r from-orange-400 to-pink-500 h-2.5 rounded-full" 
                    style="width: {{ $activeSubscription->progressPercentage() }}%"
                  ></div>
                </div>
                <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400 mt-1">
                  <span>Начало: {{ $activeSubscription->start_date->format('d.m.Y') }}</span>
                  <span>Окончание: {{ $activeSubscription->end_date->format('d.m.Y') }}</span>
                </div>
              </div>

              <a href="{{ route('profile.edit') }}"
                class="inline-block bg-gradient-to-r from-primary-500 to-blue-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-primary-600 hover:to-blue-600 transition-colors w-full text-center"
              >
                Управление подпиской
              </a>
            @elseif ($currentTariff)
              {{-- Если есть текущий тариф, но нет активной подписки --}}
              <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-sm text-gray-600 dark:text-gray-400">Текущий тариф:</span>
                  <span class="font-medium text-primary-800 dark:text-primary-200">{{ $currentTariff->title }}</span>
                </div>
                <p class="text-sm text-orange-600 mb-3">Подписка истекла или неактивна</p>
              </div>
              
              <a href="{{ route('profile.edit') }}"
                class="inline-block bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-orange-600 hover:to-red-600 transition-colors w-full text-center"
              >
                Продлить подписку
              </a>
            @else
              {{-- Нет ни активной подписки, ни текущего тарифа --}}
              <div class="text-center">
                <i class="fas fa-exclamation-circle text-primary-500 dark:text-primary-400 text-3xl mb-3"></i>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Подписка не активна</p>
                <a href="{{ route('profile.edit') }}"
                  class="inline-block bg-gradient-to-r from-primary-500 to-blue-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-primary-600 hover:to-blue-600 transition-colors w-full text-center"
                >
                  Выбрать тариф
                </a>
              </div>
            @endif
          @endauth

          @guest
            <div class="text-center">
              <i class="fas fa-user-lock text-primary-500 dark:text-primary-400 text-3xl mb-3"></i>
              <p class="text-gray-600 dark:text-gray-400 mb-4">Авторизуйтесь для просмотра статуса подписки</p>
              <a href="{{ route('login') }}"
                class="inline-block bg-gradient-to-r from-primary-500 to-blue-500 text-white rounded-lg py-2 px-4 text-sm font-medium hover:from-primary-600 hover:to-blue-600 transition-colors w-full text-center"
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
      <div class="max-w-screen-lg sm:text-lg">
        <h2 class="text-4xl font-bold text-primary-800 dark:text-primary-200 mb-6">{{ $page->FourthTitle }}</h2>
        <p class="text-lg font-light mb-6">{!! $page->footer_content !!}</p>
        <p class="text-lg font-medium">{!! $page->footer_second_content !!}</p>
      </div>
    </div>
  @endif
</section>