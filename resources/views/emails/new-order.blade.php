<!DOCTYPE html>
<html>
<head>
  <title>Новая заявка на перевозку</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Базовые стили для email клиентов, которые не поддерживают внешние стили */
    body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.5; color: #1a202c; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f7fafc; }
    .card { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); padding: 1.5rem; margin-bottom: 1rem; }
    .header { text-align: center; margin-bottom: 1.5rem; border-bottom: 2px solid #4299e1; padding-bottom: 1rem; }
    .title { color: #2b6cb0; font-size: 1.5rem; font-weight: 700; margin: 0; }
    .subtitle { color: #4a5568; font-size: 1rem; margin-top: 0.5rem; }
    .section { margin-bottom: 1.5rem; }
    .section-title { font-size: 1.125rem; font-weight: 600; color: #2d3748; margin-bottom: 0.75rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.25rem; }
    .info-row { display: flex; margin-bottom: 0.5rem; }
    .info-label { font-weight: 600; width: 120px; color: #4a5568; }
    .info-value { flex: 1; }
    .blue-box { background-color: #ebf8ff; border-left: 4px solid #4299e1; padding: 1rem; border-radius: 0.25rem; margin-top: 1rem; }
    .green-box { background-color: #f0fff4; border-left: 4px solid #48bb78; padding: 1rem; border-radius: 0.25rem; margin-top: 1rem; }
    .footer { text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #718096; }
  </style>
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="header">
        <h1 class="title">Новая заявка на перевозку</h1>
        <p class="subtitle">{{ date('d.m.Y H:i') }}</p>
      </div>

      <div class="section">
        <div class="section-title">Информация о клиенте</div>
        <div class="info-row">
          <div class="info-label">Имя:</div>
          <div class="info-value">{{ $order->name }}</div>
        </div>
        <div class="info-row">
          <div class="info-label">Телефон:</div>
          <div class="info-value">{{ $order->phone }}</div>
        </div>
        <div class="info-row">
          <div class="info-label">Email:</div>
          <div class="info-value">{{ $order->email }}</div>
        </div>
      </div>

      <div class="section">
        <div class="section-title">Детали заказа</div>
        <div class="blue-box">
          <div class="info-row">
            <div class="info-label">Откуда:</div>
            <div class="info-value">{{ $order->from_address }}</div>
          </div>
          <div class="info-row">
            <div class="info-label">Куда:</div>
            <div class="info-value">{{ $order->to_address }}</div>
          </div>
          <div class="info-row">
            <div class="info-label">Расстояние:</div>
            <div class="info-value">{{ number_format($order->distance, 2) }} км</div>
          </div>
        </div>

        <div class="green-box">
          <div class="info-row">
            <div class="info-label">Стоимость:</div>
            <div class="info-value"><strong>{{ number_format($order->cost, 0, '.', ' ') }} руб.</strong></div>
          </div>
        </div>
      </div>

      <div class="footer">
        <p>Это автоматическое уведомление. Пожалуйста, не отвечайте на это письмо.</p>
      </div>
    </div>
  </div>
</body>
</html>
