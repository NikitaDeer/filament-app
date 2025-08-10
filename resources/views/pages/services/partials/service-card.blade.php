<div class="flex h-full flex-col">
  <div class="flex-grow">
    <div class="flex items-start">
      <div class="mr-4 flex-shrink-0 rounded-lg bg-blue-100 p-3 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
      </div>
      <div>
        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $service->name }}</h3>
        <p class="mt-1 text-gray-500 dark:text-gray-400">
          @if(($service->pricing_type ?? 'fixed') === 'hourly')
            {{ number_format((float) $service->price, 0, '.', ' ') }} ₽/час
          @else
            от {{ number_format((float) $service->price, 0, '.', ' ') }} ₽
          @endif
        </p>
      </div>
    </div>
    <p class="mt-4 text-gray-600 dark:text-gray-300">{{ $service->description }}</p>
    @if (is_array($service->features) && count($service->features) > 0)
      <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-3">
        @foreach (array_slice($service->features, 0, 6) as $feature)
          <div class="flex items-center text-gray-700 dark:text-gray-200">
            <svg class="mr-2 h-5 w-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-sm">{{ $feature }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>
  <div class="mt-8">
    <a href="{{ route('calculator.index') }}"
      class="flex w-full items-center justify-center rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-blue-700">
      <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
      </svg>
      Рассчитать стоимость
    </a>
  </div>
</div>
