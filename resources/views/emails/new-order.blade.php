<!DOCTYPE html>
<html>

<head>
  <title>Новая заявка</title>
</head>

<body>
  <h1>Новая заявка на перевозку</h1>
  <p><strong>Имя:</strong> {{ $order->name }}</p>
  <p><strong>Телефон:</strong> {{ $order->phone }}</p>
  <p><strong>Email:</strong> {{ $order->email }}</p>
  <hr>
  <p><strong>Маршрут:</strong> из "{{ $order->from_address }}" в "{{ $order->to_address }}"</p>
  <p><strong>Расстояние:</strong> {{ $order->distance }} км</p>
  <p><strong>Стоимость:</strong> {{ $order->cost }} руб.</p>
</body>

</html>
