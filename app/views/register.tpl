<h2>Регистрация нового пользователя</h2>

<div class="form-block">
    <form action="%base_url%user/register" method="post" name="new_user">
        <div class="form-field">
            <label for="regiser-login">Логин:</label>
            <input type="text" name="login" id="regiser-login" required>
        </div>
        <div class="form-field">
            <label for="regiser-email">Email:</label>
            <input type="email" name="email" id="regiser-email" required>
        </div>
        <div class="form-field">
            <label for="regiser-password">Пароль:</label>
            <input type="password" name="password" id="regiser-password" required>
        </div>
        <div class="form-field">
            <label for="regiser-confirm-password">Подтверждение пароля:</label>
            <input type="password" name="confirm_password" id="regiser-confirm-password" required>
        </div>
        <div class="form-field">
            <input type="submit" value="Зарегистрироваться">
        </div>
    </form>
</div>