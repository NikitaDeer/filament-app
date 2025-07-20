<!DOCTYPE html>
<html>
<head>
  <title>Новая заявка на перевозку</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      color: #333;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f9f9f9;
    }
    .email-container {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }
    .header {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 2px solid #3490dc;
      padding-bottom: 15px;
    }
    .header h1 {
      color: #3490dc;
      margin: 0;
      font-size: 24px;
    }
    .section {
      margin-bottom: 25px;
    }
    .section-title {
      font-size: 18px;
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 10px;
      border-bottom: 1px solid #e2e8f0;
      padding-bottom: 5px;
    }
    .info-row {
      display: flex;
      margin-bottom: 8px;
    }
    .info-label {
      font-weight: 600;
      width: 120px;
      color: #4a5568;
    }
    .info-value {
      flex: 1;
    }
    .route-info {
      background-color: #ebf4ff;
      border-left: 4px solid #3490dc;
      padding: 15px;
      border-radius: 4px;
      margin-top: 15px;
    }
    .price-info {
      background-color: #f0fff4;
      border-left: 4px solid #48bb78;
      padding: 15px;
      border-radius: 4px;
      margin-top: 15px;
    }
    .footer {
      text-align: center;
      margin-top: 30px;
      font-size: 14px;
      color: #718096;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <div class="header">
      <h1>Новая заявка на перевозку</h1>
      <p>{{ date('d.m.Y H:i') }}</p>
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
      <div class="route-info">
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
      
      <div class="price-info">
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
</body>
</html>
