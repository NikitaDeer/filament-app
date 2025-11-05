<x-main-layout>

  {{-- Hero Section --}}
  <section class="bg-white dark:bg-gray-900">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 py-16 lg:grid-cols-2 lg:py-24">
      <!-- Левая колонка: Текст и CTA -->
      <div>
        <h1 class="text-4xl font-bold text-gray-800 dark:text-white lg:text-5xl">
          Надежные
          <span class="text-green-600 dark:text-green-500">грузоперевозки</span> в
          СПБ и ЛО
        </h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
          Быстро, безопасно и по честной цене. Рассчитайте стоимость доставки за 30 секунд с помощью нашего
          калькулятора.
        </p>
        <div class="mt-8 grid grid-cols-2 gap-6 text-gray-700 dark:text-gray-300">
          <div class="flex items-center">
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Работаем 24/7</span>
          </div>
          <div class="flex items-center">
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Опытные грузчики</span>
          </div>
          <div class="flex items-center">
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Страхование груза</span>
          </div>
          <div class="flex items-center">
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="ml-2">Фиксированные цены</span>
          </div>
        </div>
        <div class="mt-10 flex flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
          <a href="#"
            class="btn flex items-center justify-center rounded-lg bg-green-600 px-8 py-3 font-semibold text-white transition-colors hover:bg-green-700">
            Рассчитать стоимость
            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </a>
          <a href="#"
            class="btn flex items-center justify-center rounded-lg bg-gray-200 px-8 py-3 font-semibold text-gray-800 transition-colors hover:bg-gray-300">
            Связаться с нами
          </a>
        </div>
        <div class="mt-12 grid grid-cols-3 gap-8 text-center">
          <div>
            <p class="text-3xl font-bold text-green-600">500+</p>
            <p class="text-gray-500">Довольных клиентов</p>
          </div>
          <div>
            <p class="text-3xl font-bold text-green-600">24/7</p>
            <p class="text-gray-500">Работаем круглосуточно</p>
          </div>
          <div>
            <p class="text-3xl font-bold text-green-600">5 лет</p>
            <p class="text-gray-500">Опыт работы</p>
          </div>
        </div>
      </div>

      <!-- Правая колонка: Изображение -->
      <div class="relative hidden lg:block">
        <div class="flex h-full items-center justify-center rounded-2xl bg-gray-100 p-8 dark:bg-gray-800">
          <svg class="h-48 w-48 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
          </svg>
        </div>
        <div class="absolute right-0 top-10 rounded-lg bg-white p-4 text-sm shadow-lg dark:bg-gray-700">
          <p class="font-semibold">Быстрая доставка</p>
          <p class="text-gray-500 dark:text-gray-400">от 30 минут</p>
        </div>
        <div class="absolute bottom-10 left-0 rounded-lg bg-white p-4 text-sm shadow-lg dark:bg-gray-700">
          <p class="font-semibold">Честные цены</p>
          <p class="text-gray-500 dark:text-gray-400">без скрытых доплат</p>
        </div>
      </div>
    </div>
  </section>



  {{-- Advantages Section --}}
  <section class="bg-base-100 py-16 dark:bg-dark-base-100 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold sm:text-4xl">Почему выбирают нас</h2>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Мы предоставляем качественные услуги по доступным ценам
        </p>
      </div>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <!-- Advantage 1 -->
        <div
          class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-shipping-fast text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Скорость и сроки</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Гарантируем доставку в установленные сроки благодаря отлаженной логистике.
          </p>
        </div>
        <!-- Advantage 2 -->
        <div
          class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-shield-alt text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Безопасность груза</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Полная материальная ответственность и страхование каждого отправления.
          </p>
        </div>
        <!-- Advantage 3 -->
        <div
          class="rounded-lg bg-gray-50 p-6 text-center shadow-md transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-4 inline-block">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
              <i class="fas fa-headset text-3xl text-primary-600 dark:text-primary-400"></i>
            </div>
          </div>
          <h3 class="mb-2 text-xl font-semibold">Поддержка 24/7</h3>
          <p class="text-gray-700 dark:text-gray-300">
            Наши менеджеры всегда на связи и готовы ответить на любые ваши вопросы.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- About Us Section on Home Page --}}
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white sm:text-4xl">О компании СПБ Карго</h2>
        <p class="mx-auto mt-4 max-w-3xl text-lg text-gray-600 dark:text-gray-400">
          Мы специализируемся на грузоперевозках в Санкт-Петербурге и Ленинградской области. Наша миссия — сделать
          перевозку грузов простой, надежной и доступной для каждого.
        </p>
      </div>

      <div class="mt-16 grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
        <div>
          <h3 class="text-2xl font-bold text-gray-800 dark:text-white">5 лет на рынке грузоперевозок</h3>
          <p class="mt-4 text-gray-600 dark:text-gray-400">
            За это время мы выполнили более 10,000 заказов и заслужили доверие сотен клиентов. Мы понимаем, что каждый
            груз важен, поэтому относимся к каждому заказу с максимальной ответственностью.
          </p>
          <p class="mt-4 text-gray-600 dark:text-gray-400">
            Наша команда состоит из опытных профессионалов, которые знают город как свои пять пальцев и всегда найдут
            оптимальный маршрут для вашего груза.
          </p>
          <ul class="mt-6 space-y-3">
            <li class="flex items-center text-green-600 dark:text-green-400">
              <span class="mr-3 h-2 w-2 rounded-full bg-green-500"></span>
              Лицензированная деятельность
            </li>
            <li class="flex items-center text-green-600 dark:text-green-400">
              <span class="mr-3 h-2 w-2 rounded-full bg-green-500"></span>
              Собственный автопарк из 15+ машин
            </li>
            <li class="flex items-center text-green-600 dark:text-green-400">
              <span class="mr-3 h-2 w-2 rounded-full bg-green-500"></span>
              Команда из 25+ специалистов
            </li>
          </ul>
        </div>
        <div class="grid grid-cols-2 gap-6">
          <div
            class="rounded-lg bg-gray-50 p-6 text-center transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-gray-800">
            <p class="text-4xl font-bold text-green-600 dark:text-green-400">10K+</p>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Выполненных заказов</p>
          </div>
          <div
            class="rounded-lg bg-gray-50 p-6 text-center transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-gray-800">
            <p class="text-4xl font-bold text-green-600 dark:text-green-400">500+</p>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Постоянных клиентов</p>
          </div>
          <a href="{{ route('vehicles.index') }}"
            class="group rounded-lg bg-gray-50 p-6 text-center transition-all duration-300 ease-in-out hover:-translate-y-2 hover:bg-green-50 hover:shadow-lg dark:bg-gray-800 dark:hover:bg-gray-700">
            <p class="text-4xl font-bold text-green-600 dark:text-green-400">15+</p>
            <p class="mt-2 text-gray-500 group-hover:text-green-600 dark:text-gray-400 dark:group-hover:text-green-400">Единиц техники</p>
            <p class="mt-2 text-xs text-green-600 opacity-0 transition-opacity group-hover:opacity-100 dark:text-green-400">Посмотреть автопарк →</p>
          </a>
          <div
            class="rounded-lg bg-gray-50 p-6 text-center transition-transform duration-300 ease-in-out hover:-translate-y-2 dark:bg-gray-800">
            <p class="text-4xl font-bold text-green-600 dark:text-green-400">5</p>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Лет на рынке</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Автопарк - Карусель --}}
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">Наш автопарк</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
          Современный парк грузовых автомобилей для перевозки любых грузов. От компактных газелей до крупнотоннажных фур.
        </p>
      </div>

      @php
        $vehicles = \App\Models\Vehicle::active()->ordered()->get();
      @endphp

      <div x-data="{
        currentSlide: 0,
        vehicles: @js($vehicles->values()->toArray()),
        get visibleVehicles() {
          return [
            this.vehicles[this.currentSlide],
            this.vehicles[(this.currentSlide + 1) % this.vehicles.length],
            this.vehicles[(this.currentSlide + 2) % this.vehicles.length]
          ];
        },
        prev() {
          this.currentSlide = (this.currentSlide - 1 + this.vehicles.length) % this.vehicles.length;
        },
        next() {
          this.currentSlide = (this.currentSlide + 1) % this.vehicles.length;
        }
      }" class="relative">
        
        {{-- Кнопка влево --}}
        <button @click="prev" 
                class="absolute -left-4 top-1/2 z-10 -translate-y-1/2 rounded-full bg-green-600 p-3 text-white shadow-lg transition-all hover:bg-green-700 hover:scale-110 lg:-left-12">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
        </button>

        {{-- Карусель --}}
        <div class="overflow-hidden px-8">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <template x-for="(veh, idx) in visibleVehicles" :key="veh.id">
              <a :href="'{{ route('calculator.index') }}'" 
                 class="group block rounded-2xl border-2 border-gray-200 p-6 transition-all hover:border-green-600 hover:shadow-xl dark:border-gray-700 dark:hover:border-green-600">
                
                {{-- Изображение --}}
                <div class="relative mb-4 aspect-video overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-700">
                  <template x-if="veh.image">
                    <img :src="'/storage/' + veh.image" :alt="veh.name" 
                         class="h-full w-full object-cover transition-transform group-hover:scale-110">
                  </template>
                  <template x-if="!veh.image">
                    <div class="flex h-full items-center justify-center">
                      <svg class="h-20 w-20 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                      </svg>
                    </div>
                  </template>
                  
                  {{-- Бейдж пассажиров --}}
                  <template x-if="veh.allows_passengers">
                    <div class="absolute right-3 top-3 rounded-full bg-green-600 px-3 py-1 text-xs font-semibold text-white shadow-lg">
                      <span x-text="'До ' + veh.max_passengers + ' чел.'"></span>
                    </div>
                  </template>
                </div>

                {{-- Название --}}
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="veh.name"></h3>
                
                {{-- Описание --}}
                <p class="mt-2 line-clamp-2 text-sm text-gray-600 dark:text-gray-300" x-text="veh.description"></p>

                {{-- Характеристики --}}
                <div class="mt-4 space-y-2 text-sm">
                  <div class="flex justify-between text-gray-700 dark:text-gray-300">
                    <span>Грузоподъемность:</span>
                    <span class="font-semibold" x-text="veh.capacity_tons + ' т'"></span>
                  </div>
                  <div class="flex justify-between text-gray-700 dark:text-gray-300">
                    <span>Размеры:</span>
                    <span class="font-semibold" x-text="veh.length_m + '×' + veh.width_m + '×' + veh.height_m + ' м'"></span>
                  </div>
                </div>

                {{-- Цены --}}
                <div class="mt-4 grid grid-cols-2 gap-2">
                  <div class="rounded-lg bg-green-50 p-2 text-center dark:bg-green-900/10">
                    <div class="text-xs text-gray-600 dark:text-gray-400">За км</div>
                    <div class="text-lg font-bold text-green-600 dark:text-green-400" x-text="veh.price_per_km + ' ₽'"></div>
                  </div>
                  <div class="rounded-lg bg-green-50 p-2 text-center dark:bg-green-900/10">
                    <div class="text-xs text-gray-600 dark:text-gray-400">За час</div>
                    <div class="text-lg font-bold text-green-600 dark:text-green-400" x-text="veh.price_per_hour + ' ₽'"></div>
                  </div>
                </div>

                {{-- Кнопка --}}
                <div class="mt-4 rounded-lg bg-green-600 py-2 text-center text-sm font-semibold text-white transition-colors group-hover:bg-green-700">
                  Заказать расчет →
                </div>
              </a>
            </template>
          </div>
        </div>

        {{-- Кнопка вправо --}}
        <button @click="next" 
                class="absolute -right-4 top-1/2 z-10 -translate-y-1/2 rounded-full bg-green-600 p-3 text-white shadow-lg transition-all hover:bg-green-700 hover:scale-110 lg:-right-12">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </button>

        {{-- Индикаторы --}}
        <div class="mt-8 flex justify-center gap-2">
          <template x-for="(vehicle, index) in vehicles" :key="'indicator-' + vehicle.id">
            <button @click="currentSlide = index"
                    :class="{ 'bg-green-600 w-8': currentSlide === index, 'bg-gray-300 dark:bg-gray-600': currentSlide !== index }"
                    class="h-2 w-2 rounded-full transition-all"></button>
          </template>
        </div>
      </div>

      <div class="mt-8 text-center">
        <a href="{{ route('vehicles.index') }}" 
           class="inline-flex items-center rounded-lg border-2 border-green-600 px-6 py-3 font-semibold text-green-600 transition-all hover:bg-green-600 hover:text-white dark:border-green-500 dark:text-green-500">
          Смотреть весь автопарк
          <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- Services Section --}}
  <section class="bg-gray-50 py-16 dark:bg-neutral-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold sm:text-4xl">Наши услуги</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
          Предоставляем полный спектр услуг по грузоперевозкам и грузовым работам для частных лиц и малого бизнеса в
          Санкт-Петербурге и области.
        </p>
      </div>
      @php
        $services = \App\Models\Service::where('is_published', true)->latest()->take(3)->get();
      @endphp
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
          <div
            class="transform rounded-lg bg-white p-6 shadow-lg transition-transform duration-300 hover:-translate-y-2 dark:bg-neutral-800">
            <div class="flex items-start justify-between">
              <div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $service->name }}</h3>
              </div>
              <div class="rounded-lg bg-green-100 p-2 text-green-600 dark:bg-green-900/50 dark:text-green-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
              </div>
            </div>
            <p class="mt-4 text-gray-600 dark:text-gray-300">{{ $service->description }}</p>
            <ul class="mt-4 space-y-2">
              @if (is_array($service->features))
                @foreach (array_slice($service->features, 0, 3) as $feature)
                  <li class="flex items-center text-gray-600 dark:text-gray-300">
                    <svg class="mr-2 h-5 w-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                      </path>
                    </svg>
                    <span>{{ $feature }}</span>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        @endforeach
      </div>
      <div class="mt-12 text-center">
        <a href="{{ route('services.index') }}"
          class="inline-flex items-center rounded-full border border-green-600 px-6 py-3 font-semibold text-green-600 transition-colors hover:text-green-700 dark:border-green-400 dark:text-green-400 dark:hover:text-green-500">
          Все услуги
          <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
            </path>
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- Yandex Map Calculator Section --}}
  <section id="calculator" class="bg-gray-50 py-16 dark:bg-neutral-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="mb-12 text-center text-3xl font-bold sm:text-4xl">
        Онлайн-калькулятор
      </h2>
      @livewire('yandex-map-calculator')
    </div>
  </section>

  <x-site.cta />

  {{-- Footer --}}
  <x-site.footer />

</x-main-layout>
