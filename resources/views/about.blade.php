<x-app-layout>
  <div class="bg-base-100 py-20 dark:bg-dark-base-100">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white">О нашей компании</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
          Мы — команда профессионалов, которая любит свою работу и ценит каждого клиента.
        </p>
      </div>

      <div class="grid items-center gap-16 lg:grid-cols-2">
        <div class="prose prose-lg max-w-none dark:prose-invert">
          <h3 class="font-semibold">Наша история</h3>
          <p>
            Наша компания была основана в 2015 году с целью предоставлять качественные и доступные услуги по
            грузоперевозкам в Санкт-Петербурге и Ленинградской области. С тех пор мы значительно выросли, расширили наш
            автопарк и завоевали доверие сотен клиентов, от частных лиц до крупных компаний.
          </p>
          <h3 class="mt-8 font-semibold">Наша миссия</h3>
          <p>
            Мы стремимся сделать процесс грузоперевозок максимально простым, удобным и прозрачным для наших клиентов.
            Наша цель — не просто доставить груз, а сделать это так, чтобы вы остались довольны и рекомендовали нас
            своим друзьям и партнерам.
          </p>
        </div>
        <div>
          <img class="h-auto w-full rounded-2xl shadow-2xl"
            src="https://images.unsplash.com/photo-1586282023398-bb319c546b13?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
            alt="Грузовой автомобиль на дороге">
        </div>
      </div>

      <div class="mt-20">
        <h3 class="text-center text-3xl font-bold text-gray-800 dark:text-white">Наша команда</h3>
        <div class="mt-12 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
          <div class="text-center">
            <img class="mx-auto h-32 w-32 rounded-full shadow-lg" src="https://randomuser.me/api/portraits/men/32.jpg"
              alt="Сотрудник 1">
            <h4 class="mt-5 text-xl font-medium text-gray-800 dark:text-white">Иван Петров</h4>
            <p class="text-base text-primary-500">Генеральный директор</p>
          </div>
          <div class="text-center">
            <img class="mx-auto h-32 w-32 rounded-full shadow-lg" src="https://randomuser.me/api/portraits/women/44.jpg"
              alt="Сотрудник 2">
            <h4 class="mt-5 text-xl font-medium text-gray-800 dark:text-white">Мария Сидорова</h4>
            <p class="text-base text-primary-500">Менеджер по работе с клиентами</p>
          </div>
          <div class="text-center">
            <img class="mx-auto h-32 w-32 rounded-full shadow-lg" src="https://randomuser.me/api/portraits/men/35.jpg"
              alt="Сотрудник 3">
            <h4 class="mt-5 text-xl font-medium text-gray-800 dark:text-white">Алексей Иванов</h4>
            <p class="text-base text-primary-500">Логист</p>
          </div>
          <div class="text-center">
            <img class="mx-auto h-32 w-32 rounded-full shadow-lg" src="https://randomuser.me/api/portraits/women/36.jpg"
              alt="Сотрудник 4">
            <h4 class="mt-5 text-xl font-medium text-gray-800 dark:text-white">Елена Смирнова</h4>
            <p class="text-base text-primary-500">Водитель-экспедитор</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
