<?php
	$startTime = microtime(true);
	require __DIR__ . '/../vendor/autoload.php';

	try {
		$route = $_GET['route'] ?? '';
		$routes = require __DIR__ . '/../src/routes.php';

		$isRouteFound = false;
		foreach ($routes as $pattern => $controllerAndAction) {
			preg_match($pattern, $route, $matches);
			if (!empty($matches)) {
				$isRouteFound = true;
				break;
			}
		}

		if (!$isRouteFound) {
			throw new \MyProject\Exceptions\NotFoundException();
		}

		unset($matches[0]);

		$controllerName = $controllerAndAction[0];
		$actionName = $controllerAndAction[1];

		$controller = new $controllerName();
		$controller->$actionName(...$matches);
	} catch (\MyProject\Exceptions\DbException $e) {
		$view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
		$view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
	} catch (\MyProject\Exceptions\NotFoundException $e) {
		$view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
		$view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
	} catch (\MyProject\Exceptions\UnauthorizedException $e) {
		$view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
		$view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
	} catch (\MyProject\Exceptions\ForbiddenException $e) {
		$view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
		$view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
	}
	$endTime = microtime(true);
	printf('<div style="text-align: center; padding: 5px">Время генерации страницы: %f</div>', $endTime - $startTime );
?>
<!doctype html >
<html lang='ru'>
<head>
<meta charset="UTF-8">
             <meta name="viewport"
									 content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                         <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title> Сайтег</title>

</head>
<body>

</body>
</html>