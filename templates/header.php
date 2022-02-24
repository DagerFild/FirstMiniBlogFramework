<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
					<a href="/" style="color: black; text-decoration: none;">Мой блог</a>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?= !empty($user) ? 'Привет, ' . $user->getNickname() . ' | <a href="/logout">Выйти</a>' : '<a href="/users/login">Войти</a> | <a href="/users/register">Зарегистрироваться</a>' ?>
        </td>
    </tr>
    <tr>
        <td>