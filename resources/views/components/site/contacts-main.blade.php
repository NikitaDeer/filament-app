<!-- resources/views/components/site/contacts-main.blade.php -->
<div class="bg-white py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Наши контакты</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">Мы всегда на связи и готовы ответить на любые ваши вопросы. Вы можете связаться с нами любым удобным для вас способом.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-base leading-7 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            <div>
                <h3 class="border-l border-indigo-600 pl-6 font-semibold text-gray-900">Адрес</h3>
                <address class="border-l border-gray-200 pl-6 pt-2 not-italic text-gray-600">
                    <p>г. Москва, ул. Ленина, д. 1</p>
                </address>
            </div>
            <div>
                <h3 class="border-l border-indigo-600 pl-6 font-semibold text-gray-900">Телефон</h3>
                <div class="border-l border-gray-200 pl-6 pt-2 text-gray-600">
                    <p>+7 (495) 123-45-67</p>
                </div>
            </div>
            <div>
                <h3 class="border-l border-indigo-600 pl-6 font-semibold text-gray-900">Email</h3>
                <div class="border-l border-gray-200 pl-6 pt-2 text-gray-600">
                    <p>contact@example.com</p>
                </div>
            </div>
            <div>
                <h3 class="border-l border-indigo-600 pl-6 font-semibold text-gray-900">Социальные сети</h3>
                <ul role="list" class="border-l border-gray-200 pl-6 pt-2 text-gray-600">
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
