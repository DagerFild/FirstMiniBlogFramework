<?php

	include __DIR__ . '/../header.php'; ?>
<h1><?= $article->getName() ?></h1>
	<p><?= $article->getParsedText() ?></p>
	<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php
	if ($user !== null && $user->isAdmin()) { ?>
		<div style="text-align: end;"><a href="/articles/<?= $article->getId(
			) ?>/edit">Редактировать</a></div>
		<?php
	} ?>
<?php
	include __DIR__ . '/../footer.php'; ?>
