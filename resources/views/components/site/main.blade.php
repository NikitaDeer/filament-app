<section class="bg-slate-800 py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <div class="lg:grid lg:grid-cols-2 lg:gap-16">
      <!-- Text Section -->
      <div class="text-violet-200 font-light sm:text-lg">
        @if ($page)
          <h2 class="text-4xl font-extrabold text-violet-200 mb-6">{{ $page->ThirdTitle }}</h2>
          <p class="mb-4 text-lg">{!! $page->about_content !!}</p>
          <p class="text-lg">{!! $page->about_second_content !!}</p>
        @else
          <x-site.no-content />
        @endif
      </div>

      <!-- Image Section -->
      @if ($page)
        <div class="mt-8 lg:mt-0 grid grid-cols-2 gap-6">
          <img class="w-full rounded-xl shadow-lg hover:scale-105 transform transition-all duration-300" src="storage/{{ $page->first_photo_path }}" alt="Тут Доктор">
          <img class="mt-4 w-full rounded-xl shadow-lg hover:scale-105 transform transition-all duration-300 lg:mt-10" src="storage/{{ $page->second_photo_path }}" alt="Тут Доктор">
        </div>
      @endif
    </div>
  </div>

  <!-- Footer Section -->
  @if ($page)
    <div class="mx-auto max-w-screen-xl py-8 px-6 lg:px-16">
      <div class="max-w-screen-lg text-violet-200 sm:text-lg">
        <h2 class="text-4xl font-bold text-violet-200 mb-6">{{ $page->FourthTitle }}</h2>
        <p class="text-lg font-light mb-6">{!! $page->footer_content !!}</p>
        <p class="text-lg font-medium">{!! $page->footer_second_content !!}</p>
      </div>
    </div>
  @endif
</section>


<!-- <section class="bg-slate-700">
  <div class="mx-auto max-w-screen-xl items-center gap-16 py-8 px-10 lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
    <div class="font-light text-violet-200 sm:text-lg">
      @if ($page)
        <h2 class="mb-4 text-4xl font-extrabold text-violet-200">{{ $page->ThirdTitle }}</h2>
        <p class="mb-4">{!! $page->about_content !!}</p>
        <p>{!! $page->about_second_content !!}</p>
      @endif
    </div>
    @if ($page)
      <div class="mt-8 grid grid-cols-2 gap-4">
        <img class="w-full rounded-lg" src="storage/{{ $page->first_photo_path }}" alt="Тут Доктор">
        <img class="mt-4 w-full rounded-lg lg:mt-10" src="storage/{{ $page->second_photo_path }}" alt="Тут Доктор">
      </div>
    @endif
  </div>

  @if ($page)
    <div class="mx-auto max-w-screen-xl py-8 px-10 lg:py-16 lg:px-6">
      <div class="max-w-screen-lg text-violet-200 sm:text-lg">
        <h2 class="mb-4 text-4xl font-bold text-violet-200">{{ $page->FourthTitle }}</h2>
        <p class="mb-4 font-light">{!! $page->footer_content !!}</p>
        <p class="mb-4 font-medium">{!! $page->footer_second_content !!}</p>
      </div>
    </div>
  @endif
</section> -->