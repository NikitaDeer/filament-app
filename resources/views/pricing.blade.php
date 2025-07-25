<x-app-layout>
  <div class="bg-base-100 py-20 dark:bg-dark-base-100">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white">Наши цены</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
          Мы предлагаем прозрачные и конкурентоспособные цены на все виды услуг.
        </p>
      </div>

      <div class="mx-auto max-w-4xl">
        <div class="overflow-hidden rounded-2xl shadow-xl">
          <table class="min-w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
              <tr>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white">Услуга
                </th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white">
                  Единица измерения</th>
                <th scope="col" class="px-6 py-4 text-right text-sm font-semibold text-gray-900 dark:text-white">Цена
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-neutral-700 dark:bg-neutral-900">
              <tr>
                <td class="px-6 py-5 font-medium text-gray-900 dark:text-gray-100">Перевозка малогабаритных грузов (до
                  1.5т)</td>
                <td class="px-6 py-5 text-gray-600 dark:text-gray-300">1 час</td>
                <td class="px-6 py-5 text-right font-semibold text-primary-500">1500 руб.</td>
              </tr>
              <tr>
                <td class="px-6 py-5 font-medium text-gray-900 dark:text-gray-100">Перевозка среднегабаритных грузов (до
                  5т)</td>
                <td class="px-6 py-5 text-gray-600 dark:text-gray-300">1 час</td>
                <td class="px-6 py-5 text-right font-semibold text-primary-500">2500 руб.</td>
              </tr>
              <tr>
                <td class="px-6 py-5 font-medium text-gray-900 dark:text-gray-100">Перевозка крупногабаритных грузов (до
                  10т)</td>
                <td class="px-6 py-5 text-gray-600 dark:text-gray-300">1 час</td>
                <td class="px-6 py-5 text-right font-semibold text-primary-500">3500 руб.</td>
              </tr>
              <tr>
                <td class="px-6 py-5 font-medium text-gray-900 dark:text-gray-100">Услуги грузчиков</td>
                <td class="px-6 py-5 text-gray-600 dark:text-gray-300">1 час / 1 человек</td>
                <td class="px-6 py-5 text-right font-semibold text-primary-500">500 руб.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="mx-auto mt-20 max-w-4xl">
        <h3 class="mb-10 text-center text-3xl font-bold text-gray-800 dark:text-white">Часто задаваемые вопросы</h3>
        <div class="space-y-6">
          <div class="rounded-lg bg-gray-50 p-6 dark:bg-neutral-800">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Как рассчитывается минимальное время заказа?
            </h4>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Минимальное время заказа для всех видов транспорта
              составляет 2 часа. Это время включает в себя подачу транспорта и один час работы.</p>
          </div>
          <div class="rounded-lg bg-gray-50 p-6 dark:bg-neutral-800">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Что включено в стоимость перевозки?</h4>
            <p class="mt-2 text-gray-600 dark:text-gray-300">В стоимость включена работа водителя и аренда транспорта.
              Услуги грузчиков, упаковка и другие дополнительные услуги оплачиваются отдельно.</p>
          </div>
          <div class="rounded-lg bg-gray-50 p-6 dark:bg-neutral-800">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Вы работаете в Ленинградской области?</h4>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Да, мы осуществляем перевозки как по Санкт-Петербургу, так
              и по всей Ленинградской области. Стоимость выезда за пределы КАД рассчитывается дополнительно.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
