<x-main-layout>
  <!-- Hero -->
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
      <div class="mx-auto max-w-2xl text-center">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-white sm:text-5xl">
          Цены и тарифы
        </h1>
        <p class="mx-auto mt-4 max-w-3xl text-lg text-gray-600 dark:text-gray-400">
          Прозрачные условия и понятные тарифы на грузоперевозки. Выберите подходящий вариант или
          оставьте заявку для индивидуального расчёта.
        </p>
      </div>
    </div>
  </section>

  <!-- Тарифные карточки -->
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-8 sm:pb-12">
      <div class="mx-auto max-w-6xl">
        <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-3">
          <!-- Базовый -->
          <div class="relative rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
            <div class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Базовый</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">от 50 ₽/км</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Перевозки по городу. Идеально для небольших грузов и коротких расстояний.</p>
            <ul class="mt-6 space-y-3 text-sm text-gray-700 dark:text-gray-200">
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Минимальный заказ от 2 часов</li>
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Стандартный кузов</li>
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Страховка груза базовая</li>
            </ul>
            <div class="mt-8">
              <a href="{{ route('calculator.index') }}" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 dark:focus:ring-offset-neutral-800">
                Заказать расчет
              </a>
            </div>
          </div>

          <!-- Популярный -->
          <div class="relative rounded-2xl border border-primary-300 bg-white p-6 shadow-md ring-1 ring-primary-200 transition-all hover:-translate-y-1 hover:shadow-lg dark:border-primary-500/40 dark:bg-neutral-800 dark:ring-primary-500/20">
            <span class="absolute right-4 top-4 rounded-full bg-primary-500/10 px-3 py-1 text-xs font-semibold text-primary-700 dark:text-primary-300">Популярный</span>
            <div class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Город + пригороды</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">от 65 ₽/км</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Оптимально для переездов и доставки по области с расширенными опциями.</p>
            <ul class="mt-6 space-y-3 text-sm text-gray-700 dark:text-gray-200">
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Увеличенный кузов</li>
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Гибкие окна подачи</li>
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Страховка груза расширенная</li>
            </ul>
            <div class="mt-8">
              <a href="{{ route('calculator.index') }}" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 dark:focus:ring-offset-neutral-800">
                Заказать расчет
              </a>
            </div>
          </div>

          <!-- Межгород -->
          <div class="relative rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
            <div class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Межгород</div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">индивидуально</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Для дальних направлений. Цена рассчитывается по маршруту, весу и срокам.</p>
            <ul class="mt-6 space-y-3 text-sm text-gray-700 dark:text-gray-200">
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Индивидуальная логистика</li>
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Контроль температуры (опция)</li>
              <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 rounded-full bg-primary-500"></span>Приоритетная поддержка</li>
            </ul>
            <div class="mt-8">
              <a href="{{ route('calculator.index') }}" class="inline-flex w-full items-center justify-center rounded-lg border border-neutral-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-800 transition-colors hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600 dark:focus:ring-offset-neutral-800">
                Оставить заявку
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Таблица сравнения -->
  <section class="bg-white py-16 dark:bg-gray-900 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
      <div class="mx-auto max-w-6xl">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Сравнение тарифов</h2>
        <div class="mt-6 overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
              <thead class="bg-neutral-50 dark:bg-neutral-700/40">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Опция</th>
                  <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Базовый</th>
                  <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Популярный</th>
                  <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Межгород</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">Цена за км</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">50 ₽</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">65 ₽</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Индивид.</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">Страховка</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Базовая</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Расширенная</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Опции</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">Кузов</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Стандарт</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Увеличенный</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Индивидуально</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">Подача</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">По расписанию</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Гибкие окна</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-700 dark:text-gray-200">Договорная</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Указанные цены ориентировочные и могут отличаться в зависимости от маршрута, веса и сроков.</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="bg-white py-16 dark:bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
      <div class="mx-auto max-w-3xl">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Вопросы и ответы</h2>
        <div class="mt-6 divide-y divide-neutral-200 overflow-hidden rounded-xl border border-neutral-200 bg-white shadow-sm dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-800">
          <details class="group p-6">
            <summary class="flex cursor-pointer list-none items-center justify-between">
              <span class="text-base font-medium text-gray-900 dark:text-white">Как формируется стоимость?</span>
              <span class="ml-4 inline-flex h-6 w-6 items-center justify-center rounded-full bg-neutral-100 text-gray-600 transition group-open:rotate-180 dark:bg-neutral-700 dark:text-gray-300">⌄</span>
            </summary>
            <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">Стоимость зависит от расстояния, типа кузова, веса и дополнительных опций. Точный расчет — в калькуляторе.</div>
          </details>
          <details class="group p-6">
            <summary class="flex cursor-pointer list-none items-center justify-between">
              <span class="text-base font-medium text-gray-900 dark:text-white">Есть ли минимальный заказ?</span>
              <span class="ml-4 inline-flex h-6 w-6 items-center justify-center rounded-full bg-neutral-100 text-gray-600 transition group-open:rotate-180 dark:bg-neutral-700 dark:text-gray-300">⌄</span>
            </summary>
            <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">Да, минимальный заказ составляет 2 часа работы. Подробности уточняйте у менеджера.</div>
          </details>
          <details class="group p-6">
            <summary class="flex cursor-pointer list-none items-center justify-between">
              <span class="text-base font-medium text-gray-900 dark:text-white">Работаете ли вы ночью и в выходные?</span>
              <span class="ml-4 inline-flex h-6 w-6 items-center justify-center rounded-full bg-neutral-100 text-gray-600 transition group-open:rotate-180 dark:bg-neutral-700 dark:text-gray-300">⌄</span>
            </summary>
            <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">Да, работаем по предварительной договоренности. Возможны повышающие коэффициенты.</div>
          </details>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="bg-white py-16 dark:bg-gray-900">
    <div class="container mx-auto my-16 px-4 sm:my-20 sm:px-6 lg:my-24 lg:px-8">
      <div class="overflow-hidden rounded-2xl border border-neutral-200 bg-white p-10 text-center shadow-sm dark:border-neutral-700 dark:bg-neutral-800 sm:p-12">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Готовы к переезду?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-gray-600 dark:text-gray-300">Рассчитайте стоимость в нашем калькуляторе или оставьте заявку — мы предложим лучшее решение под вашу задачу.</p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
          <a href="{{ route('calculator.index') }}" class="inline-flex items-center justify-center rounded-lg bg-primary-600 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 sm:px-8">
            Перейти к калькулятору
          </a>
          <a href="{{ route('contacts.index') }}" class="inline-flex items-center justify-center rounded-lg border border-neutral-300 bg-white px-6 py-3 text-sm font-semibold text-gray-800 transition-colors hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600 dark:focus:ring-offset-neutral-800 sm:px-8">
            Связаться с нами
          </a>
        </div>
      </div>
    </div>
  </section>
 <x-site.footer />
</x-main-layout>
