<section class="bg-base-100 dark:bg-dark-base-100 py-16">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    @if ($page)
      <div class="mb-8 max-w-screen-md lg:mb-16">
        <h2 class="mb-4 text-4xl font-extrabold text-primary-800 dark:text-primary-200">{{ $page->SecondTitle }}</h2>
        <p class="text-primary-700 dark:text-primary-300 sm:text-xl">{!! $page->main_content !!}</p>
      </div>
    @endif

    <div class="space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0 lg:grid-cols-3">
      @forelse ($advantages as $advantage)
        <div class="bg-gray-50 dark:bg-neutral-800 rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow">
          <!-- Иконка преимущества -->
          <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900 shadow-md">
            <i class="fas fa-shield-check text-primary-600 dark:text-primary-400 text-2xl"></i>
          </div>
          
          <!-- Заголовок и описание -->
          <h3 class="mb-4 text-2xl font-extrabold text-primary-800 dark:text-primary-200">{{ $advantage->title }}</h3>
          <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{!! $advantage->description !!}</p>
        </div>
      @empty
        <x-site.no-items />
      @endforelse
    </div>
  </div>
</section>