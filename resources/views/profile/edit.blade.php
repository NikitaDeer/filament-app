<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Личный кабинет
        </h2>
    </x-slot>

    <x-site.header />

    <div class="py-6 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Левое меню -->
                <aside class="md:w-64 bg-white shadow-md p-6 rounded-lg sticky top-6 self-start">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-cyan-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Пользователь</p>
                        </div>
                    </div>
                    <nav class="space-y-4">
                        <button data-tab="profile" class="w-full text-left px-4 py-3 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg font-medium active">
                            <i class="fas fa-user mr-2"></i> Профиль
                        </button>
                        <button data-tab="access-key" class="w-full text-left px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-key mr-2"></i> Ключ доступа
                        </button>
                        <button data-tab="subscriptions" class="w-full text-left px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-calendar-alt mr-2"></i> Подписки
                        </button>
                        <button data-tab="settings" class="w-full text-left px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-cog mr-2"></i> Настройки
                        </button>
                    </nav>
                </aside>

                <!-- Основной контент -->
                <main class="bg-white p-6 rounded-lg shadow-md w-full">
                <div id="tab-content">
                    @include('profile.tabs.profile', ['user' => $user])
                    @include('profile.tabs.access-key', ['accessKey' => $accessKey])
                    @include('profile.tabs.subscriptions', ['subscriptions' => $subscriptions])
                    @include('profile.tabs.settings')
                </div>
                </main>

            </div>
        </div>
    </div>

    {{-- bye bye section --}}
  <x-site.bye-bye />

  {{-- footer --}}
  <x-site.footer />

</x-main-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('[data-tab]');
    const panes = document.querySelectorAll('.tab-pane');

    // Активируем первую вкладку
    if (!document.querySelector('.tab-pane:not(.hidden)')) {
        document.getElementById('profile-tab').classList.remove('hidden');
    }

    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.getAttribute('data-tab');

            // Скрываем все панели
            panes.forEach(pane => pane.classList.add('hidden'));

            // Показываем нужную
            document.getElementById(`${target}-tab`).classList.remove('hidden');

            // Снимаем активность с других кнопок
            buttons.forEach(btn => {
                btn.classList.remove('bg-blue-100', 'text-blue-800');
                btn.classList.add('text-gray-700', 'hover:bg-gray-100');
            });

            // Активируем текущую кнопку
            this.classList.remove('text-gray-700', 'hover:bg-gray-100');
            this.classList.add('bg-blue-100', 'text-blue-800');
        });
    });
});
</script>

<script>
function copyToClipboard(text) {
  navigator.clipboard.writeText(text)
    .then(() => {
      const tooltip = document.createElement('div');
      tooltip.textContent = 'Скопировано!';
      tooltip.className = 'fixed bottom-4 right-4 bg-cyan-500 text-white px-4 py-2 rounded-lg shadow-lg';
      document.body.appendChild(tooltip);
      setTimeout(() => tooltip.remove(), 2000);
    })
    .catch(err => console.error('Ошибка копирования:', err));
}
</script>