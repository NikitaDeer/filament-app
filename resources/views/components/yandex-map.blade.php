<div>
  <div>
    <input type="text" id="from" placeholder="Откуда">
    <input type="text" id="to" placeholder="Куда">
    <button onclick="calculateRoute()">Рассчитать</button>
  </div>
  <div id="result"></div>

  <form id="order-form" style="display: none;">
    <input type="text" name="name" placeholder="Ваше имя" required>
    <input type="tel" name="phone" placeholder="Ваш телефон" required>
    <input type="email" name="email" placeholder="Ваш Email" required>
    <input type="hidden" name="from_address">
    <input type="hidden" name="to_address">
    <input type="hidden" name="distance">
    <input type="hidden" name="cost">
    <button type="submit">Отправить заявку</button>
  </form>
  <div id="form-result"></div>

  <div id="map" style="width: 100%; height: 400px"></div>
</div>

<script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('services.yandex_maps.key') }}&lang=ru_RU"
  type="text/javascript"></script>
<script type="text/javascript">
  let myMap;

  ymaps.ready(init);

  function init() {
    myMap = new ymaps.Map("map", {
      center: [55.76, 37.64], // Москва
      zoom: 10
    });
  }

  function calculateRoute() {
    const from = document.getElementById('from').value;
    const to = document.getElementById('to').value;
    const resultDiv = document.getElementById('result');
    const orderForm = document.getElementById('order-form');

    if (!from || !to) {
      resultDiv.innerHTML = 'Пожалуйста, укажите оба адреса.';
      return;
    }

    myMap.geoObjects.removeAll();

    ymaps.route([from, to]).then(function(route) {
      myMap.geoObjects.add(route);

      const distance = route.getLength() / 1000;
      const pricePerKm = 50;
      const cost = Math.round(distance * pricePerKm);

      resultDiv.innerHTML = `Расстояние: ${distance.toFixed(2)} км. <br>Примерная стоимость: ${cost} руб.`;

      // Заполняем и показываем форму
      orderForm.style.display = 'block';
      orderForm.elements.from_address.value = from;
      orderForm.elements.to_address.value = to;
      orderForm.elements.distance.value = distance.toFixed(2);
      orderForm.elements.cost.value = cost;

    }, function(error) {
      resultDiv.innerHTML = 'Не удалось построить маршрут: ' + error.message;
    });
  }

  document.getElementById('order-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const formResult = document.getElementById('form-result');

    fetch('/order', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        formResult.innerHTML = data.message;
        if (data.success) {
          form.reset();
          form.style.display = 'none';
        }
      })
      .catch(error => {
        formResult.innerHTML = 'Произошла ошибка при отправке заявки.';
        console.error('Error:', error);
      });
  });
</script>
