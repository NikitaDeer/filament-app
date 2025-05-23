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
                        <button data-tab="profile" class="w-full text-left px-4 py-3 bg-primary-100 hover:bg-primary-50 text-primary-700 rounded-lg font-medium">
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
                        @include('profile.tabs.profile')
                        @include('profile.tabs.access-key')
                        @include('profile.tabs.subscriptions')
                        @include('profile.tabs.settings')
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('[data-tab]');
            const panes = document.querySelectorAll('.tab-pane');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const target = this.getAttribute('data-tab');

                    // Убираем активность у всех кнопок
                    buttons.forEach(btn => btn.classList.remove('bg-primary-100', 'text-primary-700'));
                    buttons.forEach(btn => btn.classList.add('hover:bg-gray-100'));

                    // Показываем нужную вкладку
                    panes.forEach(pane => pane.classList.add('hidden'));
                    document.getElementById(target + '-tab').classList.remove('hidden');

                    // Делаем текущую кнопку активной
                    this.classList.add('bg-primary-100', 'text-primary-700');
                });
            });
        });

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Ключ скопирован в буфер обмена');
            }).catch(err => {
                console.error('Ошибка копирования:', err);
            });
        }
    </script>
</x-main-layout>