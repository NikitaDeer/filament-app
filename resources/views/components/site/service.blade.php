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
          <a href="{{ route('profile.edit') }}"
            class="w-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg py-3 px-6 text-lg font-semibold text-center hover:from-cyan-600 hover:to-blue-600 transition-all duration-300"
          >
            Выбрать тариф
          </a>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section>



<!-- <section class="bg-slate-800">
  <div class="mx-auto max-w-screen-xl py-8 px-10 sm:py-16 lg:px-6">
    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @forelse ($tariffs as $tariff)
        <div class="bg-violet-200 border-2 border-violet-400 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
          <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-violet-500">
            {{-- Иконка монеты --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0 8c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z" />
            </svg>
          </div>
          <h3 class="mb-2 text-2xl font-extrabold text-gray-800">{{ $tariff->title }}</h3>
          <h4 class="mb-4 text-lg font-bold text-green-600">{{ $tariff->price }} &#8381;</h4>
          <p class="text-gray-700">{!! $tariff->description !!}</p>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section> -->


<!-- <section class="bg-gray-800">
  <div class="mx-auto max-w-screen-xl py-8 px-10 sm:py-16 lg:px-6">
    {{-- @if ($page)
      <div class="mb-8 max-w-screen-md lg:mb-16">
        <h2 class="mb-4 text-4xl font-extrabold text-gray-900">{{ $page->SecondTitle }}</h2>
        <p class="text-gray-500 sm:text-xl">{!! $page->main_content !!}</p>
      </div>
    @endif --}}
    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @forelse ($tariffs as $tariff)
        <div>
          <div
            class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-600 lg:h-12 lg:w-12">
            {{ $loop->iteration }}
          </div>
          <h3 class="mb-2 text-xl font-bold">{{ $tariff->title }}</h3>
          <h4 class="mb-2 text-xs font-bold">{{ $tariff->price }} &#8381;</h4>
          <p class="text-gray-500">{!! $tariff->description !!}</p>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section> -->
