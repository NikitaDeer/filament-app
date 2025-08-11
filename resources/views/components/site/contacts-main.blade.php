<!-- resources/views/components/site/contacts-main.blade.php -->
<div class="bg-base-100 dark:bg-gray-900 py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">Свяжитесь с нами</h1>
            <p class="mx-auto mt-4 max-w-3xl text-lg leading-8 text-gray-600 dark:text-gray-300">
                Мы всегда рады помочь. Выберите удобный для вас способ связи, и мы ответим в кратчайшие сроки.
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-lg grid-cols-1 gap-8 md:max-w-none md:grid-cols-3">
            <!-- Карточка: Адрес -->
            <div class="flex flex-col items-center rounded-2xl border border-neutral-200 bg-white p-8 text-center shadow-lg transition-all duration-300 hover:-translate-y-1 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
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
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <i class="fas fa-headset fa-2x"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Поддержка</h3>
                <div class="space-y-1 text-gray-600 dark:text-gray-300">
                    <p>
                        <a href="tel:+78121234567" class="hover:text-blue-600 dark:hover:text-blue-400">+7 (812) 123-45-67</a>
                    </p>
                    <p>
                        <a href="mailto:support@example.com" class="hover:text-blue-600 dark:hover:text-blue-400">support@example.com</a>
                    </p>
                </div>
            </div>

            <!-- Карточка: Социальные сети -->
            <div class="flex flex-col items-center rounded-2xl border border-neutral-200 bg-white p-8 text-center shadow-lg transition-all duration-300 hover:-translate-y-1 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <i class="fas fa-share-alt fa-2x"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Мы в соцсетях</h3>
                <div class="flex space-x-6 text-2xl text-gray-500 dark:text-gray-400">
                    <a href="#" class="transition-colors hover:text-blue-600 dark:hover:text-blue-400" title="Telegram">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                    <a href="#" class="transition-colors hover:text-blue-600 dark:hover:text-blue-400" title="VK">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="#" class="transition-colors hover:text-green-500 dark:hover:text-green-400" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Карта блока контактов -->
        <section class="mt-16 sm:mt-24">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Мы на карте</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Наш офис находится в самом сердце Санкт-Петербурга. Приезжайте на встречу, мы всегда рады гостям!
                </p>
            </div>

            <div class="mt-8 rounded-2xl border border-neutral-200 bg-white p-2 shadow-xl dark:border-neutral-700 dark:bg-neutral-800">
                <div class="overflow-hidden rounded-lg">
                    <div id="map" class="w-full" style="height: 450px"></div>
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
            center: [59.9342802, 30.3350986], // Санкт-Петербург
            zoom: 12,
            controls: ['zoomControl']
        });

        // var myPlacemark = new ymaps.Placemark([59.9342802, 30.3350986], {
        //     balloonContent: 'Наш офис'
        // }, {
        //     preset: 'islands#blueCircleDotIconWithCaption',
        //     iconCaptionMaxWidth: '50'
        // });

        myMap.geoObjects.add(myPlacemark);
        myMap.behaviors.enable('scrollZoom');
    }
</script>
@endpush
