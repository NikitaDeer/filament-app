<section class="bg-white py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    @if ($page)
      <div class="mb-8 max-w-screen-md lg:mb-16">
        <h2 class="mb-4 text-4xl font-extrabold text-cyan-800">{{ $page->SecondTitle }}</h2>
        <p class="text-cyan-700 sm:text-xl">{!! $page->main_content !!}</p>
      </div>
    @endif

    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @forelse ($advantages as $advantage)
        <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow">
          <!-- Иконка преимущества -->
          <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100 shadow-md">
            <i class="fas fa-shield-check text-cyan-600 text-2xl"></i>
          </div>
          
          <!-- Заголовок и описание -->
          <h3 class="mb-4 text-2xl font-extrabold text-cyan-800">{{ $advantage->title }}</h3>
          <p class="text-gray-700 leading-relaxed">{!! $advantage->description !!}</p>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section>

<!-- {{-- @props(['advantages']) --}}

<section class="bg-slate-700">
  <div class="mx-auto max-w-screen-xl py-8 px-10 sm:py-16 lg:px-6">
    {{-- <div class="mb-8 max-w-screen-md lg:mb-16">
      <h2 class="mb-4 text-4xl font-extrabold text-violet-200">{{ $page->SecondTitle }}
      </h2>
        <p class="text-violet-200 sm:text-xl">{!! $page->main_content !!}</p>
    </div> --}}

    @if ($page)
      <div class="mb-8 max-w-screen-md lg:mb-16">
        <h2 class="mb-4 text-4xl font-extrabold text-violet-200">{{ $page->SecondTitle }}</h2>
        <p class="text-violet-200 sm:text-xl">{!! $page->main_content !!}</p>
      </div>
      {{-- @else
      <x-site.no-content /> --}}
    @endif

    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
    @forelse ($advantages as $advantage)
        <div class="bg-violet-200 p-6 rounded-lg shadow-lg">
            <div class="mb-4 flex h-10 w-10 items-center justify-center rounded bg-violet-500 lg:h-12 lg:w-12">
                {{-- Флажок вместо кружка --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v16l7-4 7 4V3z" />
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-bold text-gray-800">{{ $advantage->title }}</h3>
            <p class="text-gray-700">{!! $advantage->description !!}</p>
        </div>
    @empty
        <x-site.no-items />
    @endforelse
    </div>  
  </div>
</section> -->