<x-main-layout>
  <x-site.header />

  <main class="py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold sm:text-5xl">Калькулятор стоимости</h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-400">
          Рассчитайте стоимость перевозки вашего груза онлайн за несколько простых шагов.
        </p>
      </div>
      @livewire('yandex-map-calculator')
    </div>
  </main>

  <x-site.footer />
</x-main-layout>
