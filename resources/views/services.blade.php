<x-app-layout>
  {{-- Hero Section --}}
  <section class="bg-base-100 py-16 dark:bg-dark-base-100 sm:py-24">
    <div class="container mx-auto px-4 text-center sm:px-6 lg:px-8">
      <h1 class="text-4xl font-extrabold text-primary-800 dark:text-primary-200 sm:text-5xl lg:text-6xl">
        Наши услуги
      </h1>
      <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-700 dark:text-gray-300 sm:text-xl">
        Широкий спектр транспортных услуг для бизнеса и частных клиентов
      </p>
    </div>
  </section>

  {{-- Services Section --}}
  <section class="bg-gray-50 py-16 dark:bg-neutral-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold sm:text-4xl">Наши услуги</h2>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Профессиональные решения для ваших транспортных
          потребностей</p>
      </div>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($services as $service)
          <div
            class="transform rounded-2xl bg-base-100 p-6 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl dark:bg-neutral-800">
            <!-- Иконка услуги -->
            <div
              class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 shadow-md dark:bg-primary-900">
              <i class="fas fa-truck text-2xl text-primary-600 dark:text-primary-400"></i>
            </div>

            <!-- Заголовок -->
            <h3 class="mb-4 text-2xl font-extrabold text-primary-800 dark:text-primary-200">{{ $service->title }}</h3>

            <!-- Описание -->
            <p class="mb-6 text-gray-700 dark:text-gray-300">{{ $service->description }}</p>

            <!-- Характеристики -->
            <div class="mb-6 space-y-2">
              @if ($service->delivery_time)
                <div class="flex items-center">
                  <i class="fas fa-clock mr-2 text-primary-500"></i>
                  <span class="text-sm text-gray-600 dark:text-gray-400">Срок доставки:
                    {{ $service->delivery_time }}</span>
                </div>
              @endif
              @if ($service->coverage_area)
                <div class="flex items-center">
                  <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                  <span class="text-sm text-gray-600 dark:text-gray-400">Зона доставки:
                    {{ $service->coverage_area }}</span>
                </div>
              @endif
              @if ($service->max_weight)
                <div class="flex items-center">
                  <i class="fas fa-weight-hanging mr-2 text-primary-500"></i>
                  <span class="text-sm text-gray-600 dark:text-gray-400">Макс. вес: {{ $service->max_weight }} кг</span>
                </div>
              @endif
            </div>

            <!-- Кнопка -->
            <a href="{{ route('calculator') }}"
              class="inline-block w-full rounded-lg bg-gradient-to-r from-primary-500 to-blue-500 px-6 py-3 text-center font-semibold text-white transition-all duration-300 hover:from-primary-600 hover:to-blue-600">
              Рассчитать стоимость
            </a>
          </div>
        @empty
          <div class="col-span-full py-12 text-center">
            <i class="fas fa-box-open mb-4 text-6xl text-gray-400"></i>
            <h3 class="text-xl font-medium text-gray-600 dark:text-gray-400">Услуги временно недоступны</h3>
            <p class="mt-2 text-gray-500 dark:text-gray-500">В данный момент у нас нет активных услуг. Пожалуйста,
              зайдите позже.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  {{-- Calculator Section --}}
  <section class="py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold sm:text-4xl">Рассчитайте стоимость</h2>
      </div>
      @livewire('yandex-map-calculator')
    </div>
  </section>
</x-app-layout>
