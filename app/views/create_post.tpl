<h2>Создайте новый пост</h2>

<div class="form-block-wide">
    <form action="%base_url%blog/create-post" method="post" name="new_post">
        <div class="form-field">
            <label for="post-title">Заголовок:</label>
            <input type="text" name="title" id="post-title" required>
        </div>
        <div class="form-field">
            <label for="post-text">Содержание поста:</label>
            <textarea name="text" id="post-text"></textarea>
        </div>
        <div class="form-field">
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>