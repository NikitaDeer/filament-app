<section class="bg-gray-50 dark:bg-neutral-900 py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @forelse ($tariffs as $tariff)
        <div class="bg-base-100 dark:bg-neutral-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
          <!-- Иконка тарифа -->
          <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900 shadow-md">
            <i class="fas fa-rocket text-primary-600 dark:text-primary-400 text-2xl"></i>
          </div>

          <!-- Заголовок и цена -->
          <h3 class="text-2xl font-extrabold text-primary-800 dark:text-primary-200 mb-4">{{ $tariff->title }}</h3>
          <div class="flex items-end mb-6">
            <span class="text-4xl font-bold text-primary-600 dark:text-primary-400">{{ $tariff->price }}</span>
            <span class="text-gray-600 dark:text-gray-400 ml-1">₽/{{ $tariff->duration_days }} дней</span>
          </div>

          <!-- Описание -->
          <p class="text-gray-700 dark:text-gray-300 mb-6">{!! $tariff->description !!}</p>

          <!-- Кнопка выбора тарифа -->
          <form action="{{ route('tariffs.activate', $tariff) }}" method="POST">
            @csrf
            <button type="submit" 
              class="w-full bg-gradient-to-r from-primary-500 to-blue-500 text-white rounded-lg py-3 px-6 text-lg font-semibold text-center hover:from-primary-600 hover:to-blue-600 transition-all duration-300"
            >
            Выбрать тариф
            </button>
          </form>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section>