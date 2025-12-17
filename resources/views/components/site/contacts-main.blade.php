<!-- resources/views/components/site/contacts-main.blade.php -->
<div class="bg-base-100 dark:bg-gray-900 py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">{{ contacts_content('hero_title', 'Свяжитесь с нами') }}</h1>
            <p class="mx-auto mt-4 max-w-3xl text-lg leading-8 text-gray-600 dark:text-gray-300">
                {{ contacts_content('hero_subtitle', 'Мы всегда рады помочь. Выберите удобный для вас способ связи, и мы ответим в кратчайшие сроки.') }}
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-lg grid-cols-1 gap-8 md:max-w-none md:grid-cols-3">
            <!-- Карточка: Адрес -->
            <div class="flex flex-col items-center rounded-2xl border border-neutral-200 bg-white p-8 text-center shadow-lg transition-all duration-300 hover:-translate-y-1 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-400">
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Наш офис</h3>
                <address class="not-italic text-gray-600 dark:text-gray-300">
                    <p>г. Санкт-Петербург,</p>
                    <p>Невский проспект, д. 28</p>
                </address>
            </div>

            <!-- Карточка: Телефон и Email -->
            <div class="flex flex-col items-center rounded-2xl border border-neutral-200 bg-white p-8 text-center shadow-lg transition-all duration-300 hover:-translate-y-1 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-400">
                    <i class="fas fa-headset fa-2x"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Поддержка</h3>
                <div class="space-y-1 text-gray-600 dark:text-gray-300">
                    <p>
                        <a href="tel:+78121234567" class="hover:text-green-600 dark:hover:text-green-400">+7 (812) 123-45-67</a>
                    </p>
                    <p>
                        <a href="mailto:support@example.com" class="hover:text-green-600 dark:hover:text-green-400">support@example.com</a>
                    </p>
                </div>
            </div>

            <!-- Карточка: Режим работы -->
            <div class="flex flex-col items-center rounded-2xl border border-neutral-200 bg-white p-8 text-center shadow-lg transition-all duration-300 hover:-translate-y-1 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-400">
                    <i class="fas fa-clock fa-2x"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ contacts_content('hours_title', 'Режим работы') }}</h3>
                <div class="space-y-1 text-gray-600 dark:text-gray-300">
                    <p>{{ contacts_content('hours_weekdays', 'Пн-Пт: 9:00-21:00') }}</p>
                    <p>{{ contacts_content('hours_weekend', 'Сб-Вс: 10:00-18:00') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
