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

    .text-gray-500 {
      color: #6b7280;
    }

    .text-gray-600 {
      color: #4b5563;
    }

    .text-gray-700 {
      color: #374151;
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

    .text-green-600 {
      color: #16a34a;
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

    .p-0 {
      padding: 0;
    }

    .p-2 {
      padding: 0.5rem;
    }

    .p-4 {
      padding: 1rem;
    }

    .p-6 {
      padding: 1.5rem;
    }

    .px-4 {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .py-2 {
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
    }

    .py-4 {
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    .pt-2 {
      padding-top: 0.5rem;
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

    .mt-1 {
      margin-top: 0.25rem;
    }

    .mt-2 {
      margin-top: 0.5rem;
    }

    .mt-4 {
      margin-top: 1rem;
    }

    .mt-6 {
      margin-top: 1.5rem;
    }

    .mb-1 {
      margin-bottom: 0.25rem;
    }

    .mb-2 {
      margin-bottom: 0.5rem;
    }

    .mb-4 {
      margin-bottom: 1rem;
    }

    .mb-6 {
      margin-bottom: 1.5rem;
    }

    .ml-0 {
      margin-left: 0;
    }

    .mr-2 {
      margin-right: 0.5rem;
    }

    .max-w-md {
      max-width: 28rem;
    }

    .max-w-lg {
      max-width: 32rem;
    }

    .max-w-xl {
      max-width: 36rem;
    }

    .w-full {
      width: 100%;
    }

    .rounded {
      border-radius: 0.25rem;
    }

    .rounded-md {
      border-radius: 0.375rem;
    }

    .rounded-lg {
      border-radius: 0.5rem;
    }

    .border {
      border-width: 1px;
    }

    .border-t {
      border-top-width: 1px;
    }

    .border-b {
      border-bottom-width: 1px;
    }

    .border-l-4 {
      border-left-width: 4px;
    }

    .border-gray-200 {
      border-color: #e5e7eb;
    }

    .border-blue-500 {
      border-color: #3b82f6;
    }

    .border-green-500 {
      border-color: #22c55e;
    }

    .shadow {
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .shadow-md {
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .flex {
      display: flex;
    }

    .items-center {
      align-items: center;
    }

    .justify-between {
      justify-content: space-between;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
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
  </style>
</head>

<body class="m-0 bg-gray-100 p-0 font-sans text-base text-gray-800">
  <div class="m-auto max-w-xl bg-gray-50 p-4">
    <div class="mb-4 rounded-lg bg-white p-6 shadow">
      <div class="mb-6 border-b border-gray-200 pb-4 text-center">
        {{-- <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Логотип" class="m-auto mb-4" style="max-width: 150px;"> --}}
        <h1 class="m-0 text-2xl font-bold text-blue-700">Новая заявка №{{ $order->id }}</h1>
        <p class="mt-2 text-gray-600">{{ $order->created_at->format('d.m.Y H:i') }}</p>
      </div>

      <div class="mb-6">
        <h2 class="mb-2 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800">Информация о клиенте</h2>
        <div class="mb-2 flex">
          <div class="w-32 font-semibold text-gray-600">Имя:</div>
          <div>{{ $order->name }}</div>
        </div>
        <div class="mb-2 flex">
          <div class="w-32 font-semibold text-gray-600">Телефон:</div>
          <div><a href="tel:{{ $order->phone }}" class="text-blue-600">{{ $order->phone }}</a></div>
        </div>
        <div class="mb-2 flex">
          <div class="w-32 font-semibold text-gray-600">Email:</div>
          <div><a href="mailto:{{ $order->email }}" class="text-blue-600">{{ $order->email }}</a></div>
        </div>
      </div>

      <div class="mb-6">
        <h2 class="mb-2 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800">Детали заказа</h2>
        <div class="mt-4 rounded-md border-l-4 border-blue-500 bg-blue-50 p-4">
          <div class="mb-2 flex">
            <div class="w-32 font-semibold text-gray-600">Откуда:</div>
            <div>{{ $order->from_address }}</div>
          </div>
          <div class="mb-2 flex">
            <div class="w-32 font-semibold text-gray-600">Куда:</div>
            <div>{{ $order->to_address }}</div>
          </div>
          <div class="mb-2 flex">
            <div class="w-32 font-semibold text-gray-600">Расстояние:</div>
            <div>{{ number_format($order->distance, 2) }} км</div>
          </div>
        </div>

        <div class="mt-4 rounded-md border-l-4 border-green-500 bg-green-50 p-4">
          <div class="mb-2 flex">
            <div class="w-32 font-semibold text-gray-600">Стоимость:</div>
            <div class="text-xl font-bold">{{ number_format($order->cost, 0, '.', ' ') }} руб.</div>
          </div>
        </div>
      </div>

      @if ($order->comment)
        <div class="mb-6">
          <h2 class="mb-2 border-b border-gray-200 pb-2 text-lg font-semibold text-gray-800">Комментарий клиента</h2>
          <div class="mt-2 text-gray-700">
            <p>{{ $order->comment }}</p>
          </div>
        </div>
      @endif

      <div class="mt-6 text-center">
        <a href="{{ url('/admin/orders/' . $order->id) }}" class="btn btn-primary">Просмотреть заказ в админ-панели</a>
      </div>

      <div class="mt-6 border-t border-gray-200 pt-2 text-center text-base text-gray-500">
        <p>Это автоматическое уведомление. Пожалуйста, не отвечайте на это письмо.</p>
      </div>
    </div>
  </div>
</body>

</html>
