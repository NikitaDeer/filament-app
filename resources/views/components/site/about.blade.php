{{-- @props(['advantages']) --}}

<section class="bg-gray-800">
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
        <div>
          <div
            class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-violet-500 font-bold text-violet-200 lg:h-12 lg:w-12">
            {{ $loop->iteration }}
          </div>
          <h3 class="mb-2 text-xl font-bold text-violet-200">{{ $advantage->title }}</h3>
          <p class="text-violet-200">{!! $advantage->description !!}</p>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section>