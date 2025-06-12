<div id="settings-tab" class="tab-pane hidden">
    <section class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Настройки профиля</h3>
        <p class="text-sm text-gray-600 mb-6">Здесь вы можете изменить свои личные данные и настройки безопасности.</p>
    </section>

    <!-- Форма изменения основной информации -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
            <i class="fas fa-user text-cyan-500 mr-2"></i>
            Основная информация
        </h4>
        
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')
            
            <!-- Имя пользователя -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Имя пользователя
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', Auth::user()->name) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Электронная почта
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', Auth::user()->email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200"
                    required
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Telegram ID (опционально) -->
            <div>
                <label for="telegram_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Telegram ID <span class="text-gray-500 text-xs">(необязательно)</span>
                </label>
                <input 
                    type="text" 
                    id="telegram_id" 
                    name="telegram_id" 
                    value="{{ old('telegram_id', Auth::user()->telegram_id) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200"
                    placeholder="Введите ваш Telegram ID"
                >
                @error('telegram_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-3 rounded-lg font-medium hover:from-cyan-600 hover:to-blue-600 transition-all duration-300 flex items-center"
                >
                    <i class="fas fa-save mr-2"></i>
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>

    <!-- Форма изменения пароля -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
            <i class="fas fa-lock text-cyan-500 mr-2"></i>
            Изменение пароля
        </h4>
        
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')
            
            <!-- Текущий пароль -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Текущий пароль
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200"
                        required
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('current_password')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                    >
                        <i class="fas fa-eye" id="current_password_icon"></i>
                    </button>
                </div>
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Новый пароль -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Новый пароль
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200"
                        required
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                    >
                        <i class="fas fa-eye" id="password_icon"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Подтверждение пароля -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Подтвердите новый пароль
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200"
                        required
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword('password_confirmation')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                    >
                        <i class="fas fa-eye" id="password_confirmation_icon"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-lg font-medium hover:from-orange-600 hover:to-red-600 transition-all duration-300 flex items-center"
                >
                    <i class="fas fa-key mr-2"></i>
                    Изменить пароль
                </button>
            </div>
        </form>
    </div>

    <!-- Опасная зона -->
    <div class="bg-red-50 border border-red-200 p-6 rounded-lg">
        <h4 class="text-lg font-medium text-red-800 mb-4 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
            Опасная зона
        </h4>
        <p class="text-sm text-red-600 mb-4">
            Удаление учетной записи приведет к безвозвратной потере всех ваших данных, включая подписки и ключи доступа.
        </p>
        
        <button 
            onclick="openDeleteModal()"
            class="bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition-all duration-300 flex items-center"
        >
            <i class="fas fa-trash mr-2"></i>
            Удалить аккаунт
        </button>
    </div>
</div>

<!-- Модальное окно подтверждения удаления -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="flex items-center mb-4">
            <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-3"></i>
            <h3 class="text-lg font-semibold text-gray-800">Подтверждение удаления</h3>
        </div>
        
        <p class="text-gray-600 mb-6">
            Вы уверены, что хотите удалить свой аккаунт? Это действие нельзя отменить.
        </p>
        
        <form method="POST" action="{{ route('profile.destroy') }}" class="mb-4" id="deleteForm">
            @csrf
            @method('delete')
            
            <div class="mb-4">
                <label for="delete_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Введите ваш пароль для подтверждения
                </label>
                <input 
                    type="password" 
                    id="delete_password" 
                    name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    required
                >
                <!-- Добавляем блок для отображения ошибок -->
                <div id="delete-password-error" class="mt-1 text-sm text-red-600 hidden"></div>
                @error('password', 'userDeletion')
                    <p class="mt-1 text-sm text-red-600" id="server-password-error">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-3">
                <button 
                    type="button"
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200"
                >
                    Отмена
                </button>
                <button 
                    type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200"
                    id="deleteSubmitButton"
                >
                    Удалить аккаунт
                </button>
            </div>
        </form>
        
        <!-- Альтернативная форма без AJAX -->
        <form method="POST" action="{{ route('profile.destroy') }}" class="hidden" id="simpleDeleteForm">
            @csrf
            @method('delete')
            <input type="password" name="password" id="simple_password" required>
        </form>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const currentPasswordField = document.getElementById('current_password');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    const passwordForm = passwordField.closest('form');
    
    let currentPasswordValid = false;

    // Валидация текущего пароля через AJAX
    function validateCurrentPassword() {
        const currentPassword = currentPasswordField.value;
        
        if (!currentPassword) {
            removeCurrentPasswordError();
            currentPasswordValid = false;
            return;
        }

        // Показываем индикатор загрузки
        showCurrentPasswordLoading();

        // AJAX запрос для проверки текущего пароля
        fetch('/profile/validate-current-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                current_password: currentPassword
            })
        })
        .then(response => response.json())
        .then(data => {
            removeCurrentPasswordLoading();
            
            if (data.valid) {
                showCurrentPasswordSuccess();
                currentPasswordValid = true;
            } else {
                showCurrentPasswordError('Неверный текущий пароль');
                currentPasswordValid = false;
            }
        })
        .catch(error => {
            console.error('Error validating password:', error);
            removeCurrentPasswordLoading();
            // В случае ошибки сети разрешаем продолжить (валидация на сервере)
            currentPasswordValid = true;
        });
    }

    // Функции для отображения состояний текущего пароля
    function showCurrentPasswordError(message) {
        removeCurrentPasswordFeedback();
        
        const errorElement = document.createElement('p');
        errorElement.className = 'mt-1 text-sm text-red-600';
        errorElement.id = 'current-password-error';
        errorElement.textContent = message;
        
        currentPasswordField.parentNode.appendChild(errorElement);
        currentPasswordField.classList.add('border-red-500');
        currentPasswordField.classList.remove('border-gray-300', 'border-green-500');
    }

    function showCurrentPasswordSuccess() {
        removeCurrentPasswordFeedback();
        
        const successElement = document.createElement('p');
        successElement.className = 'mt-1 text-sm text-green-600 flex items-center';
        successElement.id = 'current-password-success';
        successElement.innerHTML = '<i class="fas fa-check-circle mr-1"></i>Пароль подтвержден';
        
        currentPasswordField.parentNode.appendChild(successElement);
        currentPasswordField.classList.add('border-green-500');
        currentPasswordField.classList.remove('border-gray-300', 'border-red-500');
    }

    function showCurrentPasswordLoading() {
        removeCurrentPasswordFeedback();
        
        const loadingElement = document.createElement('p');
        loadingElement.className = 'mt-1 text-sm text-blue-600 flex items-center';
        loadingElement.id = 'current-password-loading';
        loadingElement.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Проверка пароля...';
        
        currentPasswordField.parentNode.appendChild(loadingElement);
        currentPasswordField.classList.add('border-blue-500');
        currentPasswordField.classList.remove('border-gray-300', 'border-red-500', 'border-green-500');
    }

    function removeCurrentPasswordFeedback() {
        const existing = currentPasswordField.parentNode.querySelectorAll('#current-password-error, #current-password-success, #current-password-loading');
        existing.forEach(el => el.remove());
        
        currentPasswordField.classList.remove('border-red-500', 'border-green-500', 'border-blue-500');
        currentPasswordField.classList.add('border-gray-300');
    }

    function removeCurrentPasswordError() {
        const errorElement = document.getElementById('current-password-error');
        if (errorElement) {
            errorElement.remove();
        }
        currentPasswordField.classList.remove('border-red-500');
        currentPasswordField.classList.add('border-gray-300');
    }

    function removeCurrentPasswordLoading() {
        const loadingElement = document.getElementById('current-password-loading');
        if (loadingElement) {
            loadingElement.remove();
        }
        currentPasswordField.classList.remove('border-blue-500');
    }

    // Функция для проверки совпадения паролей
    function validatePasswordMatch() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;
        
        removePasswordMatchError();
        
        if (confirmPassword && password !== confirmPassword) {
            showPasswordMatchError('Пароли не совпадают');
            return false;
        }
        
        return true;
    }

    function showPasswordMatchError(message) {
        removePasswordMatchError();
        
        const errorElement = document.createElement('p');
        errorElement.className = 'mt-1 text-sm text-red-600';
        errorElement.id = 'password-match-error';
        errorElement.textContent = message;
        
        confirmPasswordField.parentNode.appendChild(errorElement);
        confirmPasswordField.classList.add('border-red-500');
        confirmPasswordField.classList.remove('border-gray-300');
    }

    function removePasswordMatchError() {
        const existingError = document.getElementById('password-match-error');
        if (existingError) {
            existingError.remove();
        }
        
        confirmPasswordField.classList.remove('border-red-500');
        confirmPasswordField.classList.add('border-gray-300');
    }

    // Проверка силы пароля
    function validatePasswordStrength(password) {
        let strengthElement = document.getElementById('password-strength');
        
        if (!password) {
            if (strengthElement) strengthElement.remove();
            return;
        }

        const requirements = [
            { regex: /.{8,}/, text: 'минимум 8 символов', met: false },
            { regex: /[a-z]/, text: 'строчные буквы', met: false },
            { regex: /[A-Z]/, text: 'заглавные буквы', met: false },
            { regex: /\d/, text: 'цифры', met: false },
            { regex: /[!@#$%^&*(),.?":{}|<>]/, text: 'специальные символы', met: false }
        ];

        requirements.forEach(req => {
            req.met = req.regex.test(password);
        });

        const metCount = requirements.filter(req => req.met).length;
        
        if (!strengthElement) {
            strengthElement = document.createElement('div');
            strengthElement.id = 'password-strength';
            strengthElement.className = 'mt-2';
            passwordField.parentNode.appendChild(strengthElement);
        }

        const strengthColors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
        const strengthTexts = ['Очень слабый', 'Слабый', 'Средний', 'Хороший', 'Отличный'];
        const strengthIndex = Math.max(0, metCount - 1);

        strengthElement.innerHTML = `
            <div class="flex items-center space-x-2 mb-2">
                <div class="flex space-x-1">
                    ${Array(5).fill(0).map((_, i) => 
                        `<div class="h-2 w-6 rounded ${i < metCount ? strengthColors[strengthIndex] : 'bg-gray-200'}"></div>`
                    ).join('')}
                </div>
                <span class="text-sm font-medium ${metCount >= 4 ? 'text-green-600' : metCount >= 3 ? 'text-blue-600' : 'text-red-600'}">
                    ${strengthTexts[strengthIndex] || 'Слишком слабый'}
                </span>
            </div>
            <div class="grid grid-cols-1 gap-1 text-xs">
                ${requirements.map(req => 
                    `<div class="flex items-center">
                        <i class="fas ${req.met ? 'fa-check text-green-500' : 'fa-times text-red-500'} mr-2 w-3"></i>
                        <span class="${req.met ? 'text-green-600' : 'text-gray-500'}">${req.text}</span>
                    </div>`
                ).join('')}
            </div>
        `;
    }

    // Debounce функция для оптимизации запросов
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Обработчики событий с debounce
    const debouncedValidateCurrentPassword = debounce(validateCurrentPassword, 500);

    currentPasswordField.addEventListener('input', function() {
        if (this.value.length >= 3) {
            debouncedValidateCurrentPassword();
        } else {
            removeCurrentPasswordFeedback();
            currentPasswordValid = false;
        }
    });

    currentPasswordField.addEventListener('blur', function() {
        if (this.value) {
            validateCurrentPassword();
        }
    });

    passwordField.addEventListener('input', function() {
        validatePasswordStrength(this.value);
        if (confirmPasswordField.value) {
            validatePasswordMatch();
        }
    });

    confirmPasswordField.addEventListener('input', validatePasswordMatch);
    confirmPasswordField.addEventListener('blur', validatePasswordMatch);

    // Валидация при отправке формы
    passwordForm.addEventListener('submit', function(e) {
        let isValid = true;
        let focusElement = null;

        // Проверяем текущий пароль
        if (!currentPasswordField.value) {
            showCurrentPasswordError('Введите текущий пароль');
            if (!focusElement) focusElement = currentPasswordField;
            isValid = false;
        } else if (!currentPasswordValid) {
            showCurrentPasswordError('Неверный текущий пароль');
            if (!focusElement) focusElement = currentPasswordField;
            isValid = false;
        }

        // Проверяем новый пароль
        if (!passwordField.value) {
            if (!focusElement) focusElement = passwordField;
            isValid = false;
        }

        // Проверяем совпадение паролей
        if (!validatePasswordMatch()) {
            if (!focusElement) focusElement = confirmPasswordField;
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            if (focusElement) {
                focusElement.focus();
            }
            return false;
        }

        // Блокируем форму во время отправки
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Обновление пароля...';
        
        // Через 10 секунд разблокируем кнопку на случай проблем
        setTimeout(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        }, 10000);
    });

    // Обработка ответа формы
    passwordForm.addEventListener('submit', function(e) {
        const formData = new FormData(this);
        
        // Можно добавить AJAX обработку для более плавного UX
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                showNotification('Пароль успешно изменен!', 'success');
                // Очищаем форму
                this.reset();
                removeCurrentPasswordFeedback();
                const strengthElement = document.getElementById('password-strength');
                if (strengthElement) strengthElement.remove();
            } else {
                return response.json().then(data => {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            if (field === 'current_password') {
                                showCurrentPasswordError(data.errors[field][0]);
                            }
                        });
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Позволяем стандартной обработке формы сработать
        });
    });
});

// Валидация пароля в реальном времени
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    const passwordForm = passwordField.closest('form');

    // Функция для проверки совпадения паролей
    function validatePasswordMatch() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;
        
        // Удаляем предыдущие сообщения об ошибках
        removePasswordMatchError();
        
        if (confirmPassword && password !== confirmPassword) {
            showPasswordMatchError('Пароли не совпадают');
            return false;
        }
        
        return true;
    }

    // Функция для показа ошибки несовпадения паролей
    function showPasswordMatchError(message) {
        // Удаляем существующую ошибку
        removePasswordMatchError();
        
        // Создаем новый элемент ошибки
        const errorElement = document.createElement('p');
        errorElement.className = 'mt-1 text-sm text-red-600';
        errorElement.id = 'password-match-error';
        errorElement.textContent = message;
        
        // Добавляем после поля подтверждения пароля
        confirmPasswordField.parentNode.appendChild(errorElement);
        
        // Добавляем красную границу
        confirmPasswordField.classList.add('border-red-500');
        confirmPasswordField.classList.remove('border-gray-300');
    }

    // Функция для удаления ошибки несовпадения паролей
    function removePasswordMatchError() {
        const existingError = document.getElementById('password-match-error');
        if (existingError) {
            existingError.remove();
        }
        
        // Убираем красную границу
        confirmPasswordField.classList.remove('border-red-500');
        confirmPasswordField.classList.add('border-gray-300');
    }

    // Функция для проверки силы пароля
    function validatePasswordStrength(password) {
        const strengthIndicator = document.getElementById('password-strength');
        
        if (!password) {
            if (strengthIndicator) strengthIndicator.remove();
            return;
        }

        const requirements = [
            { regex: /.{8,}/, text: 'минимум 8 символов' },
            { regex: /[a-z]/, text: 'строчные буквы' },
            { regex: /[A-Z]/, text: 'заглавные буквы' },
            { regex: /\d/, text: 'цифры' },
            { regex: /[!@#$%^&*(),.?":{}|<>]/, text: 'специальные символы' }
        ];

        const met = requirements.filter(req => req.regex.test(password));
        const strength = met.length;

        // Создаем или обновляем индикатор силы пароля
        let strengthElement = document.getElementById('password-strength');
        if (!strengthElement) {
            strengthElement = document.createElement('div');
            strengthElement.id = 'password-strength';
            strengthElement.className = 'mt-2';
            passwordField.parentNode.appendChild(strengthElement);
        }

        const strengthColors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
        const strengthTexts = ['Очень слабый', 'Слабый', 'Средний', 'Хороший', 'Отличный'];

        strengthElement.innerHTML = `
            <div class="flex items-center space-x-2">
                <div class="flex space-x-1">
                    ${Array(5).fill(0).map((_, i) => 
                        `<div class="h-2 w-6 rounded ${i < strength ? strengthColors[strength - 1] : 'bg-gray-200'}"></div>`
                    ).join('')}
                </div>
                <span class="text-sm text-gray-600">${strengthTexts[strength - 1] || 'Слишком слабый'}</span>
            </div>
            <div class="mt-1 text-xs text-gray-500">
                Требования: ${requirements.map(req => 
                    `<span class="${req.regex.test(password) ? 'text-green-600' : 'text-red-600'}">${req.text}</span>`
                ).join(', ')}
            </div>
        `;
    }

    // Добавляем обработчики событий
    passwordField.addEventListener('input', function() {
        validatePasswordStrength(this.value);
        if (confirmPasswordField.value) {
            validatePasswordMatch();
        }
    });

    confirmPasswordField.addEventListener('input', validatePasswordMatch);
    confirmPasswordField.addEventListener('blur', validatePasswordMatch);

    // Валидация при отправке формы
    passwordForm.addEventListener('submit', function(e) {
        if (!validatePasswordMatch()) {
            e.preventDefault();
            confirmPasswordField.focus();
            return false;
        }
    });
});

// Улучшенная функция переключения видимости пароля
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Функция для переключения видимости пароля
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Функции для модального окна
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
    // Очищаем поле пароля и ошибки при открытии
    document.getElementById('delete_password').value = '';
    hideDeletePasswordError();
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    // Очищаем ошибки при закрытии
    hideDeletePasswordError();
}

function showDeletePasswordError(message) {
    const errorDiv = document.getElementById('delete-password-error');
    errorDiv.textContent = message;
    errorDiv.classList.remove('hidden');
    
    // Добавляем красную границу к полю ввода
    const passwordField = document.getElementById('delete_password');
    passwordField.classList.add('border-red-500');
}

function hideDeletePasswordError() {
    const errorDiv = document.getElementById('delete-password-error');
    errorDiv.classList.add('hidden');
    
    // Убираем красную границу
    const passwordField = document.getElementById('delete_password');
    passwordField.classList.remove('border-red-500');
}

// Закрытие модального окна при клике вне его
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Обработка формы удаления с улучшенной логикой
document.getElementById('deleteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const password = document.getElementById('delete_password').value;
    
    if (!password) {
        showDeletePasswordError('Пожалуйста, введите пароль');
        return;
    }
    
    // Блокируем кнопку отправки
    const submitButton = document.getElementById('deleteSubmitButton');
    const originalText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Удаление...';
    
    // Пробуем AJAX запрос
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': formData.get('_token'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        
        if (response.status === 200 || response.status === 302) {
            // Успешное удаление
            showNotification('Аккаунт успешно удален', 'success');
            setTimeout(() => {
                window.location.href = '/';
            }, 1000);
            return;
        }
        
        if (response.status === 422) {
            // Ошибка валидации
            return response.json().then(data => {
                if (data.errors && data.errors.password) {
                    showDeletePasswordError(data.errors.password[0]);
                }
            });
        }
        
        throw new Error('Unexpected response status: ' + response.status);
    })
    .catch(error => {
        console.error('AJAX Error:', error);
        
        // Если AJAX не работает, используем обычную отправку формы
        console.log('Falling back to regular form submission');
        
        // Копируем пароль в скрытую форму и отправляем её
        document.getElementById('simple_password').value = password;
        document.getElementById('simpleDeleteForm').submit();
    })
    .finally(() => {
        // Разблокируем кнопку
        submitButton.disabled = false;
        submitButton.innerHTML = originalText;
    });
});

// Добавляем обработчик для простой формы как запасной вариант
function submitSimpleDelete() {
    const password = document.getElementById('delete_password').value;
    if (password) {
        document.getElementById('simple_password').value = password;
        document.getElementById('simpleDeleteForm').submit();
    }
}

// Скрываем ошибку при вводе в поле пароля
document.getElementById('delete_password').addEventListener('input', function() {
    hideDeletePasswordError();
});

// Показ уведомлений при успешном обновлении
@if(session('status') === 'profile-updated')
    showNotification('Профиль успешно обновлен!', 'success');
@endif

@if(session('status') === 'password-updated')
    showNotification('Пароль успешно изменен!', 'success');
@endif

// Автоматическое открытие модального окна при ошибке валидации пароля
@if($errors->userDeletion->has('password'))
    document.addEventListener('DOMContentLoaded', function() {
        openDeleteModal();
    });
@endif

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
    const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="${icon} mr-2"></i>
            ${message}
        </div>
    `;
    notification.className = `fixed bottom-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    
    document.body.appendChild(notification);
    
    // Показываем уведомление
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Скрываем уведомление через 4 секунды
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}
</script>