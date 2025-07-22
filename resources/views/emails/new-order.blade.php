@php
  use App\Filament\Resources\OrderResource;
@endphp
<!DOCTYPE html>
<html>

<head>
  <title>Новая заявка на перевозку</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Tailwind-подобные стили для email клиентов */
    .font-sans {
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .text-base {
      font-size: 1rem;
      line-height: 1.5;
    }

    .text-lg {
      font-size: 1.125rem;
      line-height: 1.75;
    }

    .text-xl {
      font-size: 1.25rem;
      line-height: 1.75;
    }

    .text-2xl {
      font-size: 1.5rem;
      line-height: 2;
    }

    .font-bold {
      font-weight: 700;
    }

    .font-semibold {
      font-weight: 600;
    }

    .text-gray-400 {
      color: #9ca3af;
    }

    .text-gray-600 {
      color: #4b5563;
    }

    .text-gray-800 {
      color: #1f2937;
    }

    .text-gray-900 {
      color: #111827;
    }

    .text-blue-600 {
      color: #2563eb;
    }

    .text-blue-700 {
      color: #1d4ed8;
    }

    .bg-white {
      background-color: #ffffff;
    }

    .bg-gray-50 {
      background-color: #f9fafb;
    }

    .bg-gray-100 {
      background-color: #f3f4f6;
    }

    .bg-blue-50 {
      background-color: #eff6ff;
    }

    .bg-green-50 {
      background-color: #f0fdf4;
    }

    .bg-purple-50 {
      background-color: #faf5ff;
    }

    .p-0 {
      padding: 0;
    }

    .p-4 {
      padding: 1rem;
    }

    .p-8 {
      padding: 2rem;
    }

    .py-3 {
      padding-top: 0.75rem;
      padding-bottom: 0.75rem;
    }

    .pb-2 {
      padding-bottom: 0.5rem;
    }

    .pb-4 {
      padding-bottom: 1rem;
    }

    .m-0 {
      margin: 0;
    }

    .m-auto {
      margin: 0 auto;
    }

    .mt-2 {
      margin-top: 0.5rem;
    }

    .mt-4 {
      margin-top: 1rem;
    }

    .mt-8 {
      margin-top: 2rem;
    }

    .mt-12 {
      margin-top: 3rem;
    }

    .mb-2 {
      margin-bottom: 0.5rem;
    }

    .mb-4 {
      margin-bottom: 1rem;
    }

    .mb-5 {
      margin-bottom: 1.25rem;
    }

    .mb-10 {
      margin-bottom: 2.5rem;
    }

    .max-w-150 {
      max-width: 150px;
    }

    .max-w-xl {
      max-width: 36rem;
    }

    .w-full {
      width: 100%;
    }

    .rounded-lg {
      border-radius: 0.5rem;
    }

    .border-b {
      border-bottom-width: 1px;
    }

    .border-gray-200 {
      border-color: #e5e7eb;
    }

    .border-t {
      border-top-width: 1px;
    }

    .shadow {
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .text-center {
      text-align: center;
    }

    .italic {
      font-style: italic;
    }

    .text-sm {
      font-size: 0.875rem;
      line-height: 1.25rem;
    }

    .btn {
      display: inline-block;
      padding: 12px 24px;
      font-size: 16px;
      font-weight: 600;
      text-decoration: none;
      border-radius: 0.375rem;
    }

    .btn-primary {
      background-color: #2563eb;
      color: #ffffff;
    }

    .border-purple-500 {
      border-color: #9333ea;
    }

    .text-purple-700 {
      color: #7e22ce;
    }

    .details-block {
      border-left-width: 4px;
      padding: 1.25rem;
      border-radius: 0.375rem;
    }

    .info-label {
      font-weight: 600;
      color: #4b5563;
      font-size: 0.875rem;
      line-height: 1.25rem;
      margin-bottom: 4px;
      display: block;
    }

    .info-value {
      color: #111827;
      font-size: 1rem;
      line-height: 1.5rem;
    }
  </style>
</head>

<body class="m-0 bg-gray-100 p-0 font-sans text-base text-gray-800">
  <div class="m-auto max-w-xl bg-gray-50 p-4">
    <div class="mb-4 rounded-lg bg-white p-8 shadow">
      <div class="mb-10 border-b border-gray-200 pb-4 text-center">
        {{-- <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Логотип" class="m-auto mb-4 max-w-150"> --}}
        <h1 class="m-0 text-2xl font-bold text-blue-700">Новая заявка №{{ $order->id }}</h1>
        <p class="mt-2 text-gray-600">Заявка поступила во время: {{ $order->created_at->format('d.m.Y H:i') }}</p>
      </div>

      <div class="mb-10">
        <h2 class="mb-5 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800">Информация о клиенте</h2>
        <div class="py-3"><span class="info-label">Имя:</span><span class="info-value">{{ $order->name }}</span>
        </div>
        <div class="py-3"><span class="info-label">Телефон:</span><span class="info-value"><a
              href="tel:{{ $order->phone }}" class="text-blue-600">{{ $order->phone }}</a></span></div>
        <div class="py-3"><span class="info-label">Email:</span><span class="info-value"><a
              href="mailto:{{ $order->email }}" class="text-blue-600">{{ $order->email }}</a></span></div>
      </div>

      <div class="mb-10">
        <h2 class="mb-5 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800">Детали заказа</h2>
        <div class="details-block border-blue-500 bg-blue-50">
          <div class="py-3"><span class="info-label">Откуда:</span><span
              class="info-value">{{ $order->from_address }}</span></div>
          <div class="py-3"><span class="info-label">Куда:</span><span
              class="info-value">{{ $order->to_address }}</span></div>
          <div class="py-3"><span class="info-label">Расстояние:</span><span
              class="info-value">{{ number_format($order->distance, 2) }} км</span></div>
        </div>

        <div class="details-block mt-4 border-green-500 bg-green-50">
          <div><span class="info-label">Стоимость:</span><span
              class="info-value text-xl font-bold">{{ number_format($order->cost, 0, '.', ' ') }} руб.</span></div>
        </div>
      </div>

      @if ($order->comment)
        <div class="mb-10">
          <h2 class="mb-5 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800">Комментарий клиента</h2>
          <div class="details-block border-purple-500 bg-purple-50">
            <p class="italic text-purple-700">{{ $order->comment }}</p>
          </div>
        </div>
      @endif

      <div class="mt-12 text-center">
        <a href="{{ OrderResource::getUrl('edit', ['record' => $order]) }}" class="btn btn-primary">Просмотреть заказ в
          админ-панели</a>
      </div>

      <div class="mt-8 border-t border-gray-200 pt-4 text-center text-sm italic text-gray-400">
        <p>Это автоматическое уведомление. Пожалуйста, не отвечайте на это письмо.</p>
      </div>
    </div>
  </div>
</body>

</html>
