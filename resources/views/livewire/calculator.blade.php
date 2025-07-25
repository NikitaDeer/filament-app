<div>
  <div class="bg-base-100 py-20 dark:bg-dark-base-100">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="mx-auto max-w-3xl">
        <div class="mb-12 text-center">
          <h2 class="text-4xl font-bold text-gray-800 dark:text-white">Калькулятор стоимости</h2>
          <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
            Рассчитайте примерную стоимость перевозки вашего груза.
          </p>
        </div>

        <div class="rounded-2xl bg-white p-8 shadow-xl dark:bg-neutral-800">
          <form wire:submit.prevent="calculateCost">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <div>
                <label for="distance" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Расстояние
                  (км)</label>
                <input type="number" id="distance" wire:model.lazy="distance"
                  class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm"
                  placeholder="Например, 50">
                @error('distance')
                  <span class="mt-1 text-xs text-danger-500">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <label for="weight" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Вес
                  (кг)</label>
                <input type="number" id="weight" wire:model.lazy="weight"
                  class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm"
                  placeholder="Например, 1000">
                @error('weight')
                  <span class="mt-1 text-xs text-danger-500">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <label for="volume" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Объем
                  (м³)</label>
                <input type="number" id="volume" wire:model.lazy="volume"
                  class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm"
                  placeholder="Например, 5">
                @error('volume')
                  <span class="mt-1 text-xs text-danger-500">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <label for="transportType" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Тип
                  транспорта</label>
                <select id="transportType" wire:model="transportType"
                  class="block w-full rounded-md border-gray-300 bg-gray-100 p-3 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-neutral-700 dark:bg-neutral-900 sm:text-sm">
                  <option value="small">Малый (до 1.5т)</option>
                  <option value="medium">Средний (до 5т)</option>
                  <option value="large">Крупный (до 10т)</option>
                </select>
              </div>
            </div>

            <div class="mt-10 border-t border-gray-200 pt-8 text-center dark:border-neutral-700">
              <h3 class="text-lg font-medium text-gray-600 dark:text-gray-300">Примерная стоимость:</h3>
              <p class="mt-2 text-4xl font-bold text-primary-500">{{ number_format($cost, 2, ',', ' ') }} руб.</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
