<!-- resources/views/components/site/contacts-main.blade.php -->
<div class="bg-white py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Наши контакты</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">Мы всегда на связи и готовы ответить на любые ваши вопросы. Вы можете связаться с нами любым удобным для вас способом.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-base leading-7 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
                <div class="mb-4 inline-block">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                        <i class="fas fa-map-marker-alt text-3xl"></i>
                    </div>
                </div>
                <h3 class="mb-2 text-xl font-semibold">Адрес</h3>
                <address class="not-italic text-gray-600 dark:text-gray-300">
                    <p>г. Москва, ул. Ленина, д. 1</p>
                </address>
            </div>
            <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
                <div class="mb-4 inline-block">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                        <i class="fas fa-phone text-3xl"></i>
                    </div>
                </div>
                <h3 class="mb-2 text-xl font-semibold">Телефон</h3>
                <div class="text-gray-600 dark:text-gray-300">
                    <p>+7 (495) 123-45-67</p>
                </div>
            </div>
            <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
                <div class="mb-4 inline-block">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                        <i class="fas fa-envelope text-3xl"></i>
                    </div>
                </div>
                <h3 class="mb-2 text-xl font-semibold">Email</h3>
                <div class="text-gray-600 dark:text-gray-300">
                    <p>contact@example.com</p>
                </div>
            </div>
            <div class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
                <div class="mb-4 inline-block">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                        <i class="fas fa-share-alt text-3xl"></i>
                    </div>
                </div>
                <h3 class="mb-2 text-xl font-semibold">Социальные сети</h3>
                <ul role="list" class="text-gray-600 dark:text-gray-300">
                    <li><a href="#" class="hover:text-gray-900">Telegram</a></li>
                    <li class="mt-2"><a href="#" class="hover:text-gray-900">VK</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-16">
            <div id="map" style="width: 100%; height: 400px"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://api-maps.yandex.ru/2.1/?apikey=YOUR_YANDEX_MAPS_API_KEY&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    function init(){
        var myMap = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 10
        });
    }
</script>
@endpush