<div id="profile-tab" class="tab-pane active">
    <section class="bg-white shadow-md p-6 rounded-lg mb-6">
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
</div>