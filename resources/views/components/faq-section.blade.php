@php
  $popularFaqs = \App\Models\Faq::published()->popular()->ordered()->take(5)->get();
@endphp

@if($popularFaqs->isNotEmpty())
<section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
      {{-- Заголовок --}}
      <div class="mb-12 text-center">
        <span class="inline-block rounded-full bg-green-100 px-4 py-1.5 text-sm font-semibold text-green-700 dark:bg-green-900/30 dark:text-green-400">
          Популярные вопросы
        </span>
        <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
          Часто задаваемые вопросы
        </h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
          Быстрые ответы на самые популярные вопросы о наших услугах
        </p>
      </div>

      {{-- FAQ Аккордеон --}}
      <div x-data="{ openFaq: null }" class="space-y-4">
        @foreach($popularFaqs as $faq)
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-shadow hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <button 
              @click="openFaq = openFaq === {{ $faq->id }} ? null : {{ $faq->id }}"
              class="flex w-full items-center justify-between px-6 py-5 text-left"
            >
              <span class="flex-1 pr-4 text-lg font-semibold text-gray-900 dark:text-white">
                {{ $faq->question }}
              </span>
              <svg 
                class="h-6 w-6 flex-shrink-0 text-gray-500 transition-transform dark:text-gray-400"
                :class="{ 'rotate-180': openFaq === {{ $faq->id }} }"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <div 
              x-show="openFaq === {{ $faq->id }}"
              x-collapse
              class="border-t border-gray-200 bg-gray-50 px-6 py-5 dark:border-gray-700 dark:bg-gray-900"
            >
              <div class="prose prose-green max-w-none dark:prose-invert">
                {!! $faq->answer !!}
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Ссылка на все вопросы --}}
      <div class="mt-12 text-center">
        <a href="{{ route('faq.index') }}" class="inline-flex items-center justify-center rounded-lg bg-green-600 px-8 py-3 font-semibold text-white transition-colors hover:bg-green-700">
          Посмотреть все вопросы
          <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>
@endif


