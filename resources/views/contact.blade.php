<x-app-layout>
  <div class="bg-base-100 py-20 dark:bg-dark-base-100">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="mb-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white">Наши контакты</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
          Мы всегда на связи и готовы ответить на ваши вопросы.
        </p>
      </div>

      <div class="grid items-start gap-16 lg:grid-cols-2">
        <div class="space-y-10">
          <div>
            <h3 class="mb-5 text-2xl font-semibold text-gray-800 dark:text-white">Контактная информация</h3>
            <div class="space-y-5">
              <p class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-map-marker-alt w-6 text-xl text-primary-500"></i>
                <span class="ml-4 text-lg">г. Санкт-Петербург, ул. Промышленная, д. 5</span>
              </p>
              <p class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-phone-alt w-6 text-xl text-primary-500"></i>
                <a href="tel:+78121234567" class="ml-4 text-lg hover:text-primary-500">+7 (812) 123-45-67</a>
              </p>
              <p class="flex items-center text-gray-700 dark:text-gray-300">
                <i class="fas fa-envelope w-6 text-xl text-primary-500"></i>
                <a href="mailto:info@example-cargo.ru"
                  class="ml-4 text-lg hover:text-primary-500">info@example-cargo.ru</a>
              </p>
            </div>
          </div>

          <div>
            <h3 class="mb-5 text-2xl font-semibold text-gray-800 dark:text-white">Мы на карте</h3>
            <div class="h-80 overflow-hidden rounded-2xl bg-gray-200 shadow-lg dark:bg-neutral-800">
              <iframe
                src="https://yandex.ru/map-widget/v1/?um=constructor%3A5f6c2a49d5a73aa556a2979b9a65529f5f039c9115f573216c525f3c559d35a8&amp;source=constructor"
                width="100%" height="100%" frameborder="0"></iframe>
            </div>
          </div>
        </div>

        <div class="rounded-2xl bg-white p-8 shadow-xl dark:bg-neutral-800">
          <h3 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-white">Форма обратной связи</h3>
          <form action="#" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="name" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Имя</label>
              <input type="text" name="name" id="name"
                class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm"
                placeholder="Ваше имя">
            </div>
            <div>
              <label for="email"
                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
              <input type="email" name="email" id="email"
                class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm"
                placeholder="Ваш Email">
            </div>
            <div>
              <label for="message"
                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Сообщение</label>
              <textarea name="message" id="message" rows="5"
                class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm"
                placeholder="Ваше сообщение"></textarea>
            </div>
            <div>
              <button type="submit"
                class="btn w-full rounded-lg bg-primary-500 px-6 py-3 font-medium text-white transition-colors hover:bg-primary-600">
                Отправить
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
