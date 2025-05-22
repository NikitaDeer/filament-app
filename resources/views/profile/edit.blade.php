<x-main-layout>
    <!-- Ваша шапка -->
    <x-site.header />

    <!-- Блок с ключом доступа -->
    <section class="bg-white py-12 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6 relative">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Ваш ключ доступа</h2>

                @if (Auth::user()->access_key)
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg mb-4">
                        <code class="font-mono text-sm text-gray-800 truncate">{{ Auth::user()->access_key->key }}</code>
                        <button onclick="copyToClipboard('{{ Auth::user()->access_key->key }}')"
                                class="text-cyan-500 hover:text-cyan-700 transition">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>

                    <div class="text-sm text-gray-600 mb-2">
                        <div class="flex justify-between mb-1">
                            <span>Срок действия:</span>
                            <span class="font-medium">{{ Auth::user()->access_key->expiration_date }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-cyan-500 h-2 rounded-full" style="width: {{ $trialProgress }}%"></div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-600">Ключ недоступен</p>
                @endif

                <a href="#" class="inline-block mt-4 px-4 py-2 bg-cyan-500 text-white rounded-lg hover:bg-cyan-600">
                    Получить новый ключ
                </a>
            </div>
        </div>
    </section>

    <!-- Информация о пользователе + формы -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Информация о пользователе -->
                <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-user-circle text-cyan-500 text-xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Информация о пользователе</h3>
                    </div>
                    <div class="space-y-3 text-sm text-gray-600">
                        <p><strong>Имя:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Статус подписки:</strong>
                            @if (Auth::user()->subscription_status === 'active')
                                Активна
                            @elseif (Auth::user()->subscription_status === 'trial')
                                Триальный период
                            @else
                                Неактивна
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Изменение Email -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-envelope text-cyan-500 text-xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Изменение Пароля -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-lock text-cyan-500 text-xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Пароль</h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- История подписок -->
                <div class="md:col-span-3 bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">История подписок</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left">Тариф</th>
                                    <th class="px-4 py-3 text-left">Дата начала</th>
                                    <th class="px-4 py-3 text-left">Дата окончания</th>
                                    <th class="px-4 py-3 text-left">Статус</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($subscriptions as $subscription)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $subscription->tariff->name }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $subscription->start_date }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $subscription->end_date }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $status = $subscription->status;
                                                $color = match($status) {
                                                    'active' => 'bg-green-100 text-green-800',
                                                    'expired' => 'bg-yellow-100 text-yellow-800',
                                                    default => 'bg-red-100 text-red-800'
                                                };
                                            @endphp
                                            <span class="px-2 py-1 text-xs rounded {{ $color }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Удаление аккаунта -->
                <div class="md:col-span-3 bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Удалить аккаунт</h3>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </section>
</x-main-layout>