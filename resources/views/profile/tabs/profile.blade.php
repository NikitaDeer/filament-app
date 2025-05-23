<div id="profile-tab" class="tab-pane active">
  <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow-sm">
      <h3 class="text-lg font-medium mb-4">Основная информация</h3>
      <div class="space-y-3">
        <div class="flex items-center gap-3">
          <i class="fas fa-user text-cyan-500"></i>
          <span>{{ Auth::user()->name }}</span>
        </div>
        <div class="flex items-center gap-3">
          <i class="fas fa-envelope text-cyan-500"></i>
          <span>{{ Auth::user()->email }}</span>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
      <h3 class="text-lg font-medium mb-4">Статус подписки</h3>
      <div class="flex items-center gap-3">
        @if(Auth::user()->activeSubscription)
          <i class="fas fa-check-circle text-green-500 text-xl"></i>
          <div>
            <p class="font-medium">{{ Auth::user()->currentTariff->title }}</p>
            <p class="text-sm text-gray-600">
              Действует до: {{ Auth::user()->activeSubscription->end_date->format('d.m.Y') }}
            </p>
          </div>
        @elseif(Auth::user()->trial_ends_at->isFuture())
          <i class="fas fa-clock text-yellow-500 text-xl"></i>
          <div>
            <p class="font-medium">Пробный период</p>
            <p class="text-sm text-gray-600">
              Заканчивается: {{ Auth::user()->trial_ends_at->format('d.m.Y') }}
            </p>
          </div>
        @else
          <i class="fas fa-times-circle text-red-500 text-xl"></i>
          <span>Нет активной подписки</span>
        @endif
      </div>
    </div>
  </section>
</div>

<!-- <div id="profile-tab" class="tab-pane active">
    <section class="mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Информация о пользователе</h3>
        <p><strong>Имя:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Статус подписки:</strong>
            @if (Auth::user()->subscription_status === 'active')
                Активна
            @elseif (Auth::user()->subscription_status === 'trial')
                Триальный период
            @else
                Неактивна
            @endif
        </p>
    </section>
</div> -->