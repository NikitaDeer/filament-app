<!-- resources/views/components/site/contacts-main.blade.php -->
<div class="bg-base-100 py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Наши контакты</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">Мы всегда на связи и готовы ответить на любые ваши вопросы. Вы можете связаться с нами любым удобным для вас способом.</p>
        </div>

        <div class="mx-auto mt-16 grid max-w-4xl grid-cols-1 gap-8 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            <!-- Карточка: Адрес -->
            <div class="group rounded-xl border border-neutral-200 bg-white p-6 text-center shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary-50 p-3 text-primary-600 group-hover:bg-primary-100 dark:bg-neutral-700/60 dark:text-primary-400">
                    <i class="fas fa-map-marker-alt text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Адрес</h3>
                <address class="not-italic text-gray-600 dark:text-gray-300">
                    <p>г. Москва, ул. Ленина, д. 1</p>
                </address>
            </div>

            <!-- Карточка: Телефон -->
            <div class="group rounded-xl border border-neutral-200 bg-white p-6 text-center shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary-50 p-3 text-primary-600 group-hover:bg-primary-100 dark:bg-neutral-700/60 dark:text-primary-400">
                    <i class="fas fa-phone text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Телефон</h3>
                <div class="text-gray-600 dark:text-gray-300">
                    <a href="tel:+74951234567" class="font-medium text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-400">+7 (495) 123-45-67</a>
                </div>
            </div>

            <!-- Карточка: Email -->
            <div class="group rounded-xl border border-neutral-200 bg-white p-6 text-center shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary-50 p-3 text-primary-600 group-hover:bg-primary-100 dark:bg-neutral-700/60 dark:text-primary-400">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Email</h3>
                <div class="text-gray-600 dark:text-gray-300">
                    <a href="mailto:contact@example.com" class="font-medium text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-400">contact@example.com</a>
                </div>
            </div>

            <!-- Карточка: Социальные сети -->
            <div class="group rounded-xl border border-neutral-200 bg-white p-6 text-center shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 inline-flex items-center justify-center rounded-full bg-primary-50 p-3 text-primary-600 group-hover:bg-primary-100 dark:bg-neutral-700/60 dark:text-primary-400">
                    <i class="fas fa-share-alt text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Социальные сети</h3>
                <ul role="list" class="space-y-2 text-gray-600 dark:text-gray-300">
                    <li>
                        <a href="#" class="inline-flex items-center justify-center rounded-lg border border-neutral-200 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:border-primary-300 hover:text-primary-600 dark:border-neutral-600 dark:text-gray-200 dark:hover:border-primary-500 dark:hover:text-primary-400">
                            Telegram
                        </a>
                    </li>
                    <li>
                        <a href="#" class="inline-flex items-center justify-center rounded-lg border border-neutral-200 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:border-primary-300 hover:text-primary-600 dark:border-neutral-600 dark:text-gray-200 dark:hover:border-primary-500 dark:hover:text-primary-400">
                            VK
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Карта блока контактов -->
        <section class="mt-16">
            <div class="mx-auto max-w-3xl text-center">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Мы на карте</h3>
                <p class="mt-3 text-base text-gray-600 dark:text-gray-300">
                    Наш офис расположен в удобной транспортной доступности. Проложите маршрут и приезжайте в гости —
                    будем рады встретиться и обсудить детали вашего переезда.
                </p>
            </div>

            <div class="mt-8 rounded-xl border border-neutral-200 bg-white p-2 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                <div class="overflow-hidden rounded-lg">
                    <div id="map" class="w-full" style="height: 420px"></div>
                </div>
                <div class="mt-4 grid grid-cols-1 items-center gap-4 text-sm text-gray-600 dark:text-gray-300 sm:grid-cols-3">
                    <div class="flex items-center justify-center gap-2">
                        <span class="inline-flex h-2 w-2 rounded-full bg-primary-500"></span>
                        <span>Санкт-Петербург и Лениградская область</span>
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg class="h-4 w-4 text-primary-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7Zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5Z"/>
                        </svg>
                        <span>Адрес: г. Москва, ул. Ленина, д. 1</span>
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg class="h-4 w-4 text-primary-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M6.6 10.8c1.4 2.7 3.6 4.9 6.3 6.3l2.1-2.1c.3-.3.7-.4 1.1-.3 1.2.4 2.5.7 3.9.7.6 0 1 .4 1 .9V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.9 3 3.4 3.4 3 3.9 3H7c.5 0 .9.4.9 1 0 1.3.2 2.6.7 3.9.1.4 0 .8-.3 1.1l-1.7 1.8Z"/>
                        </svg>
                        <a href="tel:+74951234567" class="font-medium text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-400">+7 (495) 123-45-67</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_maps.key') }}&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    function init(){
        var myMap = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 11,
            controls: ['zoomControl']
        });
        myMap.behaviors.enable('scrollZoom');
    }
</script>
@endpush