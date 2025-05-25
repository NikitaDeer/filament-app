<div id="access-key-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Ваши ключи доступа</h3>

        @if ($key && $key->is_active)
            <div class="bg-gradient-to-r from-orange-200 to-pink-200 p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h4 class="font-medium">Основной ключ</h4>
                        <div class="text-xs text-gray-500 mt-1">
                            <div>Создан: {{ $key->generated_at->format('d M Y') }}</div>
                            <div>Истекает: {{ $key->expires_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                        Активен
                    </span>
                </div>

                <div class="relative">
                    <input 
                        type="text" 
                        value="{{ $key->encrypted_key }}" 
                        class="w-full bg-white border-none focus:ring-0 text-sm px-4 py-3 truncate"
                        readonly
                    >
                    <button 
                        onclick="copyToClipboard('{{ $key->encrypted_key }}')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white w-8 h-8 flex items-center justify-center rounded-full hover:bg-blue-700 transition-colors"
                    >
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                <p class="text-gray-600">Нет активного ключа доступа</p>
            </div>
        @endif
    </section>
</div>

<!-- <div id="access-key-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Ключ доступа</h3>

        @if ($key)
            <div class="bg-gray-50 p-4 rounded-lg mb-4 relative">
                <code class="font-mono text-sm text-gray-800 truncate">{{ Crypt::decryptString($key->encrypted_key) }}</code>
                <button onclick="copyToClipboard('{{ Crypt::decryptString($key->encrypted_key) }}')" class="absolute right-2 top-3 text-cyan-500 hover:text-cyan-700">
                    <i class="far fa-copy"></i>
                </button>
            </div>
            <div class="text-sm text-gray-600 mb-4">
                <div class="flex justify-between mb-1">
                    <span>Действует до:</span>
                    <span>{{ $key->expires_at->format('d.m.Y') }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 70%"></div>
                </div>
            </div>
        @else
            <p class="text-gray-600">Нет активного ключа</p>
        @endif
    </section>
</div> -->

<!-- <div id="access-key-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Ключ доступа</h3>

        @if ($key)
            <div class="bg-gray-50 p-4 rounded-lg mb-4 relative">
                <code class="font-mono text-sm text-gray-800 truncate">{{ $key->key }}</code>
                <button onclick="copyToClipboard('{{ $key->key }}')" class="absolute right-2 top-3 text-cyan-500 hover:text-cyan-700">
                    <i class="far fa-copy"></i>
                </button>
            </div>
            <div class="text-sm text-gray-600 mb-4">
                <div class="flex justify-between mb-1">
                    <span>Действует до:</span>
                    <span>{{ $key->expiration_date }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 70%"></div>
                </div>
            </div>
        @else
            <p class="text-gray-600">Нет активного ключа</p>
        @endif
    </section>
</div> -->