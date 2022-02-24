<?php

	return [
			'~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
			'~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
			'~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
			'~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
			'~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
			'~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'],
			'~^logout$~' => [\MyProject\Controllers\UsersController::class, 'logout'],
			'~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
			'~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
      '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'],
      '~^before/(\d+)$~' => [\MyProject\Controllers\MainController::class, 'before'],
      '~^after/(\d+)$~' => [\MyProject\Controllers\MainController::class, 'after'],
	];
