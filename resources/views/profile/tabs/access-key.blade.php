<div id="access-key-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Ваш ключ доступа</h3>
        @php
            $key = Auth::user()->accessKey;
        @endphp

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
</div>