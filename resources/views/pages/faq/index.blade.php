<x-main-layout>
  {{-- Hero секция --}}
  <section class="bg-gradient-to-br from-green-50 via-white to-green-50 py-16 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <span class="inline-block rounded-full bg-green-600 px-4 py-1.5 text-sm font-semibold text-white">
          FAQ
        </span>
        <h1 class="mt-6 text-4xl font-bold text-gray-900 dark:text-white sm:text-5xl">
          Часто задаваемые вопросы
        </h1>
        <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-gray-600 dark:text-gray-400">
          Ответы на популярные вопросы о наших услугах. Если не нашли нужную информацию — звоните, мы поможем!
        </p>
      </div>
    </div>
  </section>

  {{-- FAQ контент --}}
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      @php
        $categories = \App\Models\Faq::getCategoriesWithCount();
        $allFaqs = \App\Models\Faq::published()->ordered()->get();
      @endphp

      <div x-data="{
        searchQuery: '',
        selectedCategory: 'Все вопросы',
        openFaq: null,
        categories: @js($categories->pluck('category')->toArray()),
        allFaqs: @js($allFaqs->toArray()),
        get filteredFaqs() {
          let faqs = this.allFaqs;
          
          // Фильтр по категории
          if (this.selectedCategory !== 'Все вопросы') {
            faqs = faqs.filter(faq => faq.category === this.selectedCategory);
          }
          
          // Фильтр по поисковому запросу
          if (this.searchQuery.trim() !== '') {
            const query = this.searchQuery.toLowerCase();
            faqs = faqs.filter(faq => 
              faq.question.toLowerCase().includes(query) || 
              faq.answer.toLowerCase().includes(query)
            );
          }
          
          return faqs;
        },
        toggleFaq(id) {
          this.openFaq = this.openFaq === id ? null : id;
        }
      }" class="mx-auto max-w-5xl">

        {{-- Поиск --}}
        <div class="mb-12">
          <div class="relative">
            <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input 
              type="text" 
              x-model="searchQuery"
              placeholder="Поиск по вопросам..."
              class="w-full rounded-lg border border-gray-300 bg-white py-4 pl-12 pr-4 text-gray-900 placeholder-gray-500 focus:border-green-500 focus:ring-2 focus:ring-green-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
            />
          </div>
        </div>

        {{-- Категории (Tabs) --}}
        <div class="mb-8 overflow-x-auto">
          <div class="flex gap-2 border-b border-gray-200 dark:border-gray-700">
            <button 
              @click="selectedCategory = 'Все вопросы'; openFaq = null"
              :class="selectedCategory === 'Все вопросы' ? 'border-green-600 text-green-600 dark:border-green-500 dark:text-green-500' : 'border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white'"
              class="whitespace-nowrap border-b-2 px-4 py-3 text-sm font-medium transition-colors"
            >
              Все вопросы
              <span class="ml-2 rounded-full bg-gray-100 px-2 py-0.5 text-xs dark:bg-gray-800" x-text="allFaqs.length"></span>
            </button>
            <template x-for="cat in categories" :key="cat">
              <button 
                @click="selectedCategory = cat; openFaq = null"
                :class="selectedCategory === cat ? 'border-green-600 text-green-600 dark:border-green-500 dark:text-green-500' : 'border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white'"
                class="whitespace-nowrap border-b-2 px-4 py-3 text-sm font-medium transition-colors"
                x-text="cat"
              ></button>
            </template>
          </div>
        </div>

        {{-- FAQ Аккордеон --}}
        <div class="space-y-4">
          <template x-for="faq in filteredFaqs" :key="faq.id">
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-shadow hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
              <button 
                @click="toggleFaq(faq.id)"
                class="flex w-full items-center justify-between px-6 py-5 text-left"
              >
                <span class="flex-1 pr-4 text-lg font-semibold text-gray-900 dark:text-white" x-text="faq.question"></span>
                <svg 
                  class="h-6 w-6 flex-shrink-0 text-gray-500 transition-transform dark:text-gray-400"
                  :class="{ 'rotate-180': openFaq === faq.id }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div 
                x-show="openFaq === faq.id"
                x-collapse
                class="border-t border-gray-200 bg-gray-50 px-6 py-5 dark:border-gray-700 dark:bg-gray-900"
              >
                <div class="prose prose-green max-w-none dark:prose-invert" x-html="faq.answer"></div>
              </div>
            </div>
          </template>

          {{-- Нет результатов --}}
          <div x-show="filteredFaqs.length === 0" class="py-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Ничего не найдено</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Попробуйте изменить поисковый запрос или выбрать другую категорию</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- CTA секция --}}
  <section class="bg-green-600 py-16 dark:bg-green-700">
    <div class="container mx-auto px-4 text-center sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-white">Не нашли ответ на свой вопрос?</h2>
      <p class="mx-auto mt-4 max-w-2xl text-lg text-green-50">
        Свяжитесь с нами любым удобным способом, и мы с радостью поможем!
      </p>
      <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
        <a href="tel:+78121234567" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 font-semibold text-green-600 transition-colors hover:bg-gray-100">
          <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
          Позвонить
        </a>
        <a href="{{ route('contacts.index') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-colors hover:bg-white hover:text-green-600">
          Все контакты
        </a>
      </div>
    </div>
  </section>

</x-main-layout>


