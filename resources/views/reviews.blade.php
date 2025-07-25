<x-app-layout>
  <div class="bg-base-100 py-20 dark:bg-dark-base-100">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white">Отзывы наших клиентов</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
          Мы гордимся доверием, которое нам оказывают наши клиенты.
        </p>
      </div>

      <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
        <div
          class="transform rounded-2xl bg-white p-8 shadow-xl transition duration-300 hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-5 flex items-center">
            <img class="mr-5 h-14 w-14 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
              alt="Клиент 1">
            <div>
              <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Анна Кузнецова</h4>
              <div class="mt-1 flex items-center text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
              </div>
            </div>
          </div>
          <p class="leading-relaxed text-gray-600 dark:text-gray-300">"Отличный сервис! Перевозили мебель на новую
            квартиру, все сделали быстро, аккуратно и в срок. Грузчики вежливые и профессиональные. Рекомендую!"</p>
        </div>

        <div
          class="transform rounded-2xl bg-white p-8 shadow-xl transition duration-300 hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-5 flex items-center">
            <img class="mr-5 h-14 w-14 rounded-full" src="https://randomuser.me/api/portraits/men/62.jpg"
              alt="Клиент 2">
            <div>
              <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Виктор Попов</h4>
              <div class="mt-1 flex items-center text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="far fa-star ml-1"></i>
              </div>
            </div>
          </div>
          <p class="leading-relaxed text-gray-600 dark:text-gray-300">"Воспользовался услугами для перевозки офисной
            техники. Все прошло хорошо, но немного задержались. В целом, доволен."</p>
        </div>

        <div
          class="transform rounded-2xl bg-white p-8 shadow-xl transition duration-300 hover:-translate-y-2 dark:bg-neutral-800">
          <div class="mb-5 flex items-center">
            <img class="mr-5 h-14 w-14 rounded-full" src="https://i.pravatar.cc/150?u=a042581f4e29026704d"
              alt="Клиент 3">
            <div>
              <h4 class="text-lg font-semibold text-gray-800 dark:text-white">ООО "СтройИнвест"</h4>
              <div class="mt-1 flex items-center text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
                <i class="fas fa-star ml-1"></i>
              </div>
            </div>
          </div>
          <p class="leading-relaxed text-gray-600 dark:text-gray-300">"Регулярно пользуемся услугами для доставки
            стройматериалов на объекты. Всегда вовремя, надежно и по хорошей цене. Отличный партнер!"</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
