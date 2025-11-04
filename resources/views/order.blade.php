<x-guest-layout>
  <form method="POST" action="{{ route('orders.store') }}">
    @csrf
    <div>
      <x-input-label for="service_id" :value="__('Выберите услугу')" />
      <select id="service_id" name="service_id" class="mt-1 block w-full" required>
        <option value="">Выберите услугу</option>
        @foreach ($services as $service)
          <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
            {{ $service->name }}
          </option>
        @endforeach
      </select>
      <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="description" :value="__('Описание')" />
      {{-- <x-text-input id="description" class="mt-1 block w-full" type="text" name="description" :value="old('description')"
        required autofocus autocomplete="description" /> --}}
      <textarea id="description" class="mt-1 block w-full" name="description" required autofocus>{{ old('description') }}</textarea>
      <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="order_date" :value="__('Дата заявки')" />
      <x-text-input id="order_date" class="mt-1 block w-full" type="date" name="order_date" :value="old('order_date')"
        required autocomplete="order_date" />
      <x-input-error :messages="$errors->get('order_date')" class="mt-2" />
    </div>

    <div class="mt-4 flex items-center justify-between">
      <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
        href="{{ route('home') }}">
        {{ __('Отмена') }}
      </a>

      <x-primary-button class="ml-4">
        {{ __('Оставить заявку') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
