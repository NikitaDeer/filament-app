<x-main-layout>
  <div class="container mx-auto px-4 py-8">
    <h1 class="mb-4 text-center text-3xl font-bold">Прозрачные цены</h1>
    <p class="mb-8 text-center text-gray-600">Никаких скрытых доплат. Все цены фиксированы и указаны с учетом НДС.
      Окончательная стоимость рассчитывается индивидуально.</p>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
      @foreach ($tariffs as $tariff)
        <div class="@if ($tariff->is_popular) border-blue-500 @endif rounded-lg border p-6">
          @if ($tariff->is_popular)
            <span
              class="-mt-10 mb-4 inline-block rounded-full bg-blue-500 px-3 py-1 text-xs font-bold text-white">Популярный</span>
          @endif
          <h2 class="mb-2 text-2xl font-bold">{{ $tariff->name }}</h2>
          <p class="mb-4 text-gray-500">{{ $tariff->description }}</p>
          <p class="mb-4 text-4xl font-bold">{{ $tariff->price_prefix }} {{ $tariff->price }} {{ $tariff->price_suffix }}
          </p>
          <ul class="space-y-2">
            @foreach (json_decode($tariff->features) as $feature)
              <li class="flex items-center">
                <svg class="mr-2 h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ $feature }}
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>

    <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2">
      <div>
        <h2 class="mb-4 text-2xl font-bold">Транспорт</h2>
        <div class="rounded-lg border p-6">
          @foreach ($transport as $item)
            <div class="flex items-center justify-between border-b py-2">
              <div>
                <p class="font-semibold">{{ $item->name }}</p>
                <p class="text-sm text-gray-500">{{ $item->description }}</p>
              </div>
              <p class="font-bold">{{ $item->price }} {{ $item->price_suffix }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <div>
        <h2 class="mb-4 text-2xl font-bold">Грузчики</h2>
        <div class="rounded-lg border p-6">
          @foreach ($movers as $item)
            <div class="flex items-center justify-between border-b py-2">
              <div>
                <p class="font-semibold">{{ $item->name }}</p>
                <p class="text-sm text-gray-500">{{ $item->description }}</p>
              </div>
              <p class="font-bold">{{ $item->price }} {{ $item->price_suffix }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2">
      <div>
        <h2 class="mb-4 text-2xl font-bold">Дополнительные услуги</h2>
        <div class="rounded-lg border p-6">
          @foreach ($additionalServices as $item)
            <div class="flex items-center justify-between border-b py-2">
              <div>
                <p class="font-semibold">{{ $item->name }}</p>
                <p class="text-sm text-gray-500">{{ $item->description }}</p>
              </div>
              <p class="font-bold">{{ $item->price }} {{ $item->price_suffix }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <div>
        <h2 class="mb-4 text-2xl font-bold">Межгород</h2>
        <div class="rounded-lg border p-6">
          @foreach ($intercity as $item)
            <div class="flex items-center justify-between border-b py-2">
              <div>
                <p class="font-semibold">{{ $item->name }}</p>
                <p class="text-sm text-gray-500">{{ $item->description }}</p>
              </div>
              <p class="font-bold">{{ $item->price_prefix }} {{ $item->price }} {{ $item->price_suffix }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="mt-12 rounded-lg bg-gray-100 p-8">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <div>
          <h2 class="mb-4 text-2xl font-bold">Важная информация</h2>
          <h3 class="mb-2 font-bold">Условия работы:</h3>
          <ul class="list-inside list-disc">
            <li>Минимальный заказ — 2 часа</li>
            <li>Работаем без выходных с 8:00 до 22:00</li>
            <li>Ночные заказы — доплата 50%</li>
            <li>Предоплата не требуется</li>
          </ul>
        </div>
        <div>
          <h3 class="mb-2 mt-10 font-bold">Что входит в стоимость:</h3>
          <ul class="list-inside list-disc">
            <li>Подача машины в пределах КАД</li>
            <li>Топливо и все расходы</li>
            <li>Базовая страховка груза</li>
            <li>Консультация менеджера</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-main-layout>
