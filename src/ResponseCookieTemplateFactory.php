<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

use Psr\Container\ContainerInterface;

class ResponseCookieTemplateFactory
{
	public function __invoke(ContainerInterface $container) : ResponseCookieTemplate
	{
		$config = $container->get('config');
		$cookies = $config['cookie_template'] ?? [];

		$preferBasePath = $cookies['prefer_base_path'] ?? false;

		if ($preferBasePath && isset($config['base_path'])) {
			$cookies['path'] = $config['base_path'];
		}

		return new ResponseCookieTemplate($cookies);
	}
}
