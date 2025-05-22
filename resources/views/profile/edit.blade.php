<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Личный кабинет
        </h2>
    </x-slot>

    <x-site.header />

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Вкладки -->
            <nav class="mb-6 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tab-menu">
                    <li class="mr-2">
                        <button type="button" data-tab="profile" class="inline-block p-4 border-b-2 border-primary-500 rounded-t-lg active">Профиль</button>
                    </li>
                    <li class="mr-2">
                        <button type="button" data-tab="access-key" class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">Ключ доступа</button>
                    </li>
                    <li class="mr-2">
                        <button type="button" data-tab="subscriptions" class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">Подписки</button>
                    </li>
                    <li class="mr-2">
                        <button type="button" data-tab="settings" class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">Настройки</button>
                    </li>
                </ul>
            </nav>

            <!-- Контент вкладок -->
            <div id="tab-content">
                @include('profile.tabs.profile')
                @include('profile.tabs.access-key')
                @include('profile.tabs.subscriptions')
                @include('profile.tabs.settings')
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('[data-tab]');
        const tabPanes = document.querySelectorAll('.tab-pane');

        // Переключение вкладок
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                const target = this.getAttribute('data-tab');

                // Скрываем все вкладки
                tabPanes.forEach(pane => {
                    pane.classList.add('hidden');
                });

                // Убираем активный класс у всех кнопок
                tabs.forEach(t => {
                    t.classList.remove('border-primary-500');
                    t.classList.add('border-transparent');
                });

                // Показываем нужную вкладку
                document.getElementById(target + '-tab').classList.remove('hidden');

                // Делаем текущую вкладку активной
                this.classList.add('border-primary-500');
                this.classList.remove('border-transparent');
            });
        });
    });

    // Функция копирования ключа
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Ключ скопирован в буфер обмена');
        }).catch(err => {
            console.error('Ошибка копирования:', err);
        });
    }
</script>

</x-main-layout>