<footer class="bg-gradient-to-b from-white to-gray-50 border-t border-gray-200">
  <div class="mx-auto max-w-screen-xl px-6 lg:px-16">
    <!-- Main Footer Content -->
    <div class="py-12 lg:py-16">
      <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        
        <!-- Company Info -->
        <div class="lg:col-span-2">
          <div class="mb-6">
            <h3 class="text-2xl font-bold text-cyan-800 mb-4">Okolo™</h3>
            <p class="text-gray-700 leading-relaxed mb-6">
              Безопасный и надежный сервис для управления доступом к вашим ресурсам. 
              Мы обеспечиваем высочайший уровень защиты данных с использованием современных 
              технологий шифрования.
            </p>
          </div>
          
          <!-- Features -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="flex items-center">
              <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-shield text-cyan-600 text-sm"></i>
              </div>
              <span class="text-sm text-gray-700">256-битное шифрование</span>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-clock text-cyan-600 text-sm"></i>
              </div>
              <span class="text-sm text-gray-700">24/7 поддержка</span>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-users text-cyan-600 text-sm"></i>
              </div>
              <span class="text-sm text-gray-700">Многопользовательский доступ</span>
            </div>
            <div class="flex items-center">
              <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-chart-line text-cyan-600 text-sm"></i>
              </div>
              <span class="text-sm text-gray-700">Аналитика использования</span>
            </div>
          </div>
        </div>

        <!-- Navigation Links -->
        <div>
          <h4 class="text-lg font-semibold text-cyan-800 mb-4">Навигация</h4>
          <ul class="space-y-3">
            <li>
              <a href="#" class="text-gray-700 hover:text-cyan-600 transition-colors flex items-center">
                <i class="fas fa-home mr-2 text-sm"></i>
                Главная
              </a>
            </li>
            <li>
              <a href="#" class="text-gray-700 hover:text-cyan-600 transition-colors flex items-center">
                <i class="fas fa-info-circle mr-2 text-sm"></i>
                О нас
              </a>
            </li>
            <li>
              <a href="#" class="text-gray-700 hover:text-cyan-600 transition-colors flex items-center">
                <i class="fas fa-dollar-sign mr-2 text-sm"></i>
                Тарифы
              </a>
            </li>
            <li>
              <a href="#" class="text-gray-700 hover:text-cyan-600 transition-colors flex items-center">
                <i class="fas fa-headset mr-2 text-sm"></i>
                Поддержка
              </a>
            </li>
            <li>
              <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-cyan-600 transition-colors flex items-center">
                <i class="fas fa-user mr-2 text-sm"></i>
                Личный кабинет
              </a>
            </li>
          </ul>
        </div>

        <!-- Support & Contact -->
        <div>
          <h4 class="text-lg font-semibold text-cyan-800 mb-4">Поддержка</h4>
          <div class="space-y-4">
            <!-- Telegram Support -->
            <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
              <div class="flex items-center mb-2">
                <i class="fab fa-telegram-plane text-cyan-500 text-lg mr-2"></i>
                <span class="font-medium text-gray-800">Telegram</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">Быстрая поддержка 24/7</p>
              <a href="#" target="_blank" 
                 class="inline-flex items-center text-sm bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-3 py-2 rounded-lg hover:from-cyan-600 hover:to-blue-600 transition-colors">
                Написать
                <i class="fas fa-external-link-alt ml-1 text-xs"></i>
              </a>
            </div>

            <!-- Email Support -->
            <div class="space-y-2">
              <div class="flex items-center">
                <i class="fas fa-envelope text-gray-500 mr-2"></i>
                <span class="text-sm text-gray-700">support@okolo.com</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-phone text-gray-500 mr-2"></i>
                <span class="text-sm text-gray-700">+7 (800) 123-45-67</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-gray-200 py-6">
      <div class="flex flex-col items-center justify-between space-y-4 sm:flex-row sm:space-y-0">
        <!-- Copyright -->
        <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4">
          <span class="text-sm text-gray-700">
            © 2025
            <a href="#" class="font-medium text-cyan-600 hover:text-cyan-800">Okolo™</a>. 
            Все права защищены.
          </span>
          <div class="hidden sm:block text-gray-400">•</div>
          <div class="flex space-x-4 text-sm">
            <a href="#" class="text-gray-600 hover:text-cyan-600 transition-colors">
              Политика конфиденциальности
            </a>
            <a href="#" class="text-gray-600 hover:text-cyan-600 transition-colors">
              Условия использования
            </a>
          </div>
        </div>

        <!-- Social Links -->
        <div class="flex items-center space-x-4">
          <span class="text-sm text-gray-600">Мы в соцсетях:</span>
          <div class="flex space-x-3">
            <!-- GitHub -->
            <a href="#" 
               class="w-10 h-10 bg-gray-100 hover:bg-cyan-100 rounded-lg flex items-center justify-center transition-colors group" 
               aria-label="GitHub">
              <i class="fab fa-github text-gray-600 group-hover:text-cyan-600 text-lg"></i>
            </a>

            <!-- Telegram -->
            <a href="#" 
               class="w-10 h-10 bg-gray-100 hover:bg-cyan-100 rounded-lg flex items-center justify-center transition-colors group" 
               aria-label="Telegram">
              <i class="fab fa-telegram-plane text-gray-600 group-hover:text-cyan-600 text-lg"></i>
            </a>

            <!-- VK -->
            <a href="#" 
               class="w-10 h-10 bg-gray-100 hover:bg-cyan-100 rounded-lg flex items-center justify-center transition-colors group" 
               aria-label="VK">
              <i class="fab fa-vk text-gray-600 group-hover:text-cyan-600 text-lg"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Security Badge -->
    <div class="border-t border-gray-200 py-4">
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 text-xs text-gray-500">
        <div class="flex items-center">
          <i class="fas fa-shield-check text-green-500 mr-1"></i>
          SSL защищено
        </div>
        <div class="flex items-center">
          <i class="fas fa-lock text-blue-500 mr-1"></i>
          RSA-256 шифрование
        </div>
        <div class="flex items-center">
          <i class="fas fa-server text-purple-500 mr-1"></i>
          99.9% аптайм
        </div>
      </div>
    </div>
  </div>
</footer>