<div id="settings-tab" class="tab-pane hidden">
    <section class="bg-white shadow-md p-6 rounded-lg mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Изменить Email</h3>
        @include('profile.partials.update-profile-information-form')
    </section>

    <section class="bg-white shadow-md p-6 rounded-lg mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Изменить пароль</h3>
        @include('profile.partials.update-password-form')
    </section>

    <section class="bg-white shadow-md p-6 rounded-lg mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Удалить аккаунт</h3>
        @include('profile.partials.delete-user-form')
    </section>
</div>