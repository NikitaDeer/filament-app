<div id="subscriptions-tab" class="tab-pane hidden">
  <section class="mb-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">История подписок</h3>

    @if ($subscriptions->isEmpty())
      <div class="bg-white p-6 rounded-lg shadow-sm text-center">
        <i class="fas fa-history text-gray-400 text-4xl mb-4"></i>
        <p class="text-gray-600">У вас пока нет подписок</p>
      </div>
    @else
      <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
              <th class="py-3 px-4 text-left">Тариф</th>
              <th class="py-3 px-4 text-left">Период</th>
              <th class="py-3 px-4 text-left">Статус</th>
              <th class="py-3 px-4 text-right">Цена</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subscriptions as $subscription)
              <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td class="py-3 px-4 font-medium">{{ $subscription->tariff->title }}</td>
                <td class="py-3 px-4">
                  {{ $subscription->start_date->format('d.m.Y') }} - 
                  {{ $subscription->end_date->format('d.m.Y') }}
                </td>
                <td class="py-3 px-4">
                  @if ($subscription->status === 'active')
                    <span class="text-green-800 bg-green-100 px-2 py-1 rounded">Активна</span>
                  @elseif ($subscription->status === 'expired')
                    <span class="text-yellow-800 bg-yellow-100 px-2 py-1 rounded">Просрочена</span>
                  @else
                    <span class="text-red-800 bg-red-100 px-2 py-1 rounded">Отменена</span>
                  @endif
                </td>
                <td class="py-3 px-4 text-right font-medium">{{ $subscription->final_price }} ₽</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </section>
</div>

<!-- <div id="subscriptions-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">История подписок</h3>

        @if ($subscriptions->isEmpty())
            <p class="text-gray-600">Подписок пока нет.</p>
        @else
            <table class="w-full text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-600">
                    <tr>
                        <th class="py-3 px-4">Тариф</th>
                        <th class="py-3 px-4">Дата начала</th>
                        <th class="py-3 px-4">Дата окончания</th>
                        <th class="py-3 px-4">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $subscription->tariff->title }}</td>
                            <td class="py-3 px-4">{{ $subscription->start_date->format('d.m.Y') }}</td>
                            <td class="py-3 px-4">{{ $subscription->end_date->format('d.m.Y') }}</td>
                            <td class="py-3 px-4">
                                @if ($subscription->status === 'active')
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Активна</span>
                                @elseif ($subscription->status === 'expired')
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Просрочена</span>
                                @else
                                    <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Неактивна</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</div> -->

<!-- <div id="subscriptions-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">История подписок</h3>

        @if ($subscriptions->isEmpty())
            <p class="text-gray-600">Подписок пока нет.</p>
        @else
            <table class="w-full text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-600">
                    <tr>
                        <th class="py-3 px-4">Тариф</th>
                        <th class="py-3 px-4">Дата начала</th>
                        <th class="py-3 px-4">Дата окончания</th>
                        <th class="py-3 px-4">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $subscription->tariff->name }}</td>
                            <td class="py-3 px-4">{{ $subscription->start_date }}</td>
                            <td class="py-3 px-4">{{ $subscription->end_date }}</td>
                            <td class="py-3 px-4">
                                @if ($subscription->status === 'active')
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Активна</span>
                                @elseif ($subscription->status === 'expired')
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Просрочена</span>
                                @else
                                    <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Неактивна</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</div> -->