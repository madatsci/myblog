<h2>Авторизация пользователя</h2>

<div class="form-block">
    <form action="%base_url%user/login" method="post" name="auth_user">
        <div class="form-field">
            <label for="auth-login">Логин:</label>
            <input type="text" name="login" id="auth-login" required>
        </div>
        <div class="form-field">
            <label for="auth-password">Пароль:</label>
            <input type="password" name="password" id="auth-password" required>
        </div>
        <div class="form-field">
            <input type="submit" value="Войти">
        </div>
    </form>
</div>