<div id="access-key-tab" class="tab-pane hidden">
    <h3 class="text-xl font-semibold mb-4">Ключ доступа</h3>
    @if($accessKey && $accessKey->isActive())
        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-700">Статус ключа:</p>
                <span class="px-3 py-1 rounded-full bg-green-200 text-green-800">
                    Активен
                </span>
            </div>
            
            <div class="mb-4">
                <p class="text-gray-700 mb-2">Тариф:</p>
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                    <span class="font-medium text-cyan-800">
                        {{ $accessKey->subscription->tariff->title ?? 'Неизвестный тариф' }}
                    </span>
                    <span class="text-sm text-gray-600">
                        {{ $accessKey->subscription->tariff->duration_days ?? 0 }} дней
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-gray-700 mb-2">Зашифрованный ключ:</p>
                <div class="flex items-center bg-gray-100 p-2 rounded-lg">
                    <input 
                        type="text" 
                        readonly 
                        value="{{ $accessKey->encrypted_key }}"
                        class="w-full bg-gray-100 focus:outline-none text-sm"
                        id="encrypted-key-input"
                    >
                    <button 
                        onclick="copyToClipboard('{{ $accessKey->encrypted_key }}')"
                        class="ml-2 text-cyan-500 hover:text-cyan-700 p-1"
                        title="Копировать ключ"
                    >
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    Ключ содержит зашифрованную информацию о вашей подписке
                </p>
            </div>

            <div class="mb-4">
                <p class="text-gray-700 mb-2">Срок действия:</p>
                <div class="flex items-center mb-2">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div 
                            class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2.5 rounded-full transition-all duration-300" 
                            style="width: {{ $accessKey->remainingPercentage() }}%"
                        ></div>
                    </div>
                    <span class="ml-3 text-sm text-gray-700 whitespace-nowrap">
                        {{ $accessKey->remainingDays() }} дней
                    </span>
                </div>
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Создан: {{ $accessKey->generated_at->format('d.m.Y H:i') }}</span>
                    <span>Истекает: {{ $accessKey->expires_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>

            @if($accessKey->remainingDays() <= 7)
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-orange-500 mr-2"></i>
                        <span class="text-orange-800 text-sm">
                            Ваш ключ истекает через {{ $accessKey->remainingDays() }} дней
                        </span>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <i class="fas fa-key text-gray-400 text-4xl mb-4"></i>
            <h4 class="text-lg font-medium text-gray-700 mb-2">Нет активного ключа доступа</h4>
            <p class="text-gray-600 mb-4">
                Для получения ключа доступа необходимо оформить подписку на один из доступных тарифов
            </p>
            <a href="{{ route('home') }}" 
               class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg py-2 px-4 font-medium hover:from-cyan-600 hover:to-blue-600 transition-colors">
                Выбрать тариф
            </a>
        </div>
    @endif
</div>