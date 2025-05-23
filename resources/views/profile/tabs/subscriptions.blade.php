<div id="subscriptions-tab" class="tab-pane hidden">
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
</div>