<x-main-layout>

    {{-- Header --}}
    <x-site.header />

    {{-- Hero Section --}}
    <section class="bg-base-100 dark:bg-dark-base-100 py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-primary-800 dark:text-primary-200">
                Надежные грузоперевозки по всей стране
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg sm:text-xl text-gray-700 dark:text-gray-300">
                Быстрая доставка, отслеживание в реальном времени и калькулятор стоимости прямо на сайте.
            </p>
            <div class="mt-8">
                <a href="#calculator" class="btn bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-primary-600 transition-colors">
                    Рассчитать стоимость
                </a>
            </div>
        </div>
    </section>

    {{-- Yandex Map Calculator Section --}}
    <section id="calculator" class="py-16 sm:py-24 bg-gray-50 dark:bg-neutral-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-12">
                Онлайн-калькулятор
            </h2>
            @livewire('yandex-map-calculator')
        </div>
    </section>

    {{-- Advantages Section --}}
    <section class="bg-base-100 dark:bg-dark-base-100 py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold">Наши преимущества</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Почему клиенты выбирают нас</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Advantage 1 -->
                <div class="text-center p-6 bg-gray-50 dark:bg-neutral-800 rounded-lg shadow-md">
                    <div class="mb-4 inline-block">
                        <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-3xl text-primary-600 dark:text-primary-400"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Скорость и сроки</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Гарантируем доставку в установленные сроки благодаря отлаженной логистике.
                    </p>
                </div>
                <!-- Advantage 2 -->
                <div class="text-center p-6 bg-gray-50 dark:bg-neutral-800 rounded-lg shadow-md">
                    <div class="mb-4 inline-block">
                        <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-3xl text-primary-600 dark:text-primary-400"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Безопасность груза</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Полная материальная ответственность и страхование каждого отправления.
                    </p>
                </div>
                <!-- Advantage 3 -->
                <div class="text-center p-6 bg-gray-50 dark:bg-neutral-800 rounded-lg shadow-md">
                    <div class="mb-4 inline-block">
                        <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-headset text-3xl text-primary-600 dark:text-primary-400"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Поддержка 24/7</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Наши менеджеры всегда на связи и готовы ответить на любые ваши вопросы.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-site.footer />

</x-main-layout>
