<section class="bg-gradient-to-t from-white via-cyan-50 to-white py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @forelse ($tariffs as $tariff)
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
          <!-- Иконка тарифа -->
          <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100 shadow-md">
            <i class="fas fa-rocket text-cyan-600 text-2xl"></i>
          </div>

          <!-- Заголовок и цена -->
          <h3 class="text-2xl font-extrabold text-cyan-800 mb-4">{{ $tariff->title }}</h3>
          <div class="flex items-end mb-6">
            <span class="text-4xl font-bold text-cyan-600">{{ $tariff->price }}</span>
            <span class="text-gray-600 ml-1">₽/{{ $tariff->duration_days }} дней</span>
          </div>

          <!-- Описание -->
          <p class="text-gray-700 mb-6">{!! $tariff->description !!}</p>

          <!-- Кнопка выбора тарифа -->
          <form action="{{ route('tariffs.activate', $tariff) }}" method="POST">
            @csrf
            <button type="submit" 
              class="w-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg py-3 px-6 text-lg font-semibold text-center hover:from-cyan-600 hover:to-blue-600 transition-all duration-300"
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