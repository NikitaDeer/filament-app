<div id="access-key-tab" class="tab-pane hidden">
    <h3 class="text-xl font-semibold mb-4">Ключ доступа</h3>
    @if($accessKey && $accessKey->is_active)
        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-700">Статус ключа:</p>
                <span class="px-3 py-1 rounded-full bg-green-200 text-green-800">
                    Активен
                </span>
            </div>
            <div class="mb-4">
                <p class="text-gray-700 mb-2">Зашифрованный ключ:</p>
                <div class="flex items-center bg-gray-100 p-2 rounded-lg">
                    <input 
                        type="text" 
                        readonly 
                        value="{{ $accessKey->encrypted_key }}" {{-- Выводим зашифрованный ключ --}}
                        class="w-full bg-gray-100 focus:outline-none"
                    >
                    <button 
                        onclick="copyToClipboard('{{ $accessKey->encrypted_key }}')"
                        class="ml-2 text-cyan-500 hover:text-cyan-700"
                    >
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-gray-700 mb-2">Срок действия:</p>
                <div class="flex items-center">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div 
                            class="bg-cyan-500 h-2.5 rounded-full" 
                            style="width: {{ $accessKey->remainingPercentage() }}%"
                        ></div>
                    </div>
                    <span class="ml-3 text-sm text-gray-700">
                        {{ $accessKey->expires_at->diffInDays(now()) }} дней осталось
                    </span>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-700">У вас нет активного ключа доступа.</p>
            <a href="" class="text-cyan-500 hover:text-cyan-700 mt-2 inline-block">
                Оформить подписку
            </a>
        </div>
    @endif
</div>

