<div class="flex items-start">
  <div class="mr-4 rounded-lg bg-gray-100 p-3 text-gray-600 dark:bg-gray-700/50 dark:text-gray-300">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
    </svg>
  </div>
  <div>
    <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $service->name }}</h3>
    <p class="mt-1 text-gray-500 dark:text-gray-400">от {{ $service->price }} ₽</p>
  </div>
</div>
<p class="mt-4 text-gray-600 dark:text-gray-300">{{ $service->description }}</p>
<ul class="mt-6 space-y-3">
  @if (is_array($service->features))
    @foreach ($service->features as $feature)
      <li class="flex items-center text-gray-700 dark:text-gray-200">
        <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span>{{ $feature }}</span>
      </li>
    @endforeach
  @endif
</ul>
<div class="mt-8">
  <a href="#"
    class="flex w-full items-center justify-center rounded-lg bg-gray-800 px-6 py-3 font-semibold text-white transition-colors hover:bg-gray-700 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-gray-300">
    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    </svg>
    Рассчитать стоимость
  </a>
</div>
