<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $error ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td>
	<h1 style="text-align: center; background-color: red; color: white;"><?= $error ?></h1>
	<a href="/">Вернуться на главную страницу</a>
<?php include __DIR__ . '/../footer.php'; ?>