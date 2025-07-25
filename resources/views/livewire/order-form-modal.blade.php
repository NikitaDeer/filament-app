<div>
  @if ($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
      <div class="m-4 w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl dark:bg-neutral-800">

        @if ($orderSubmittedSuccessfully)
          <div class="text-center">
            <i class="fas fa-check-circle mb-4 text-6xl text-green-500"></i>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Заявка успешно отправлена!</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Мы скоро с вами свяжемся.</p>
            <button wire:click="closeModal"
              class="mt-6 w-full rounded-md bg-primary-500 px-4 py-2.5 font-semibold text-white transition hover:bg-primary-600">
              Закрыть
            </button>
          </div>
        @else
          <h3 class="mb-6 text-2xl font-bold text-gray-800 dark:text-white">Оформление заказа</h3>
          <form wire:submit.prevent="submitOrder">
            <div class="space-y-4">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Имя</label>
                <input type="text" wire:model.defer="name" id="name"
                  class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900">
                @error('name')
                  <span class="text-xs text-danger-500">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Телефон</label>
                <input type="tel" wire:model.defer="phone" id="phone"
                  class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900">
                @error('phone')
                  <span class="text-xs text-danger-500">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" wire:model.defer="email" id="email"
                  class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900">
                @error('email')
                  <span class="text-xs text-danger-500">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <label for="comment"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300">Комментарий</label>
                <textarea wire:model.defer="comment" id="comment" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-4 py-2 focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900"></textarea>
              </div>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
              <button type="button" wire:click="closeModal"
                class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-neutral-600 dark:bg-neutral-700 dark:text-gray-300 dark:hover:bg-neutral-600">
                Отмена
              </button>
              <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-primary-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <span wire:loading.remove>Отправить заявку</span>
                <span wire:loading>Отправка...</span>
              </button>
            </div>
          </form>
        @endif
      </div>
    </div>
  @endif
</div>
