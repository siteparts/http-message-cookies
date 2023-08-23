<?php

declare(strict_types=1);

namespace SiteParts\Cookies\HttpMessage;

use Psr\Container\ContainerInterface;

class ResponseCookieTemplateFactory
{
	public function __invoke(ContainerInterface $container) : ResponseCookieTemplate
	{
		/**
		 * @var array{
		 *     base_path?: string,
		 *     cookie_template?: array{
		 *         prefer_base_path?: bool,
		 *         expires?: \DateTime,
		 *         max_age?: int,
		 *         domain?: string,
		 *         path?: string,
		 *         secure?: bool,
		 *         http_only?: bool,
		 *         same_site?: string,
		 *     },
		 * } $config
		 */
		$config = $container->get('config');
		$cookies = $config['cookie_template'] ?? [];

		$preferBasePath = $cookies['prefer_base_path'] ?? false;

		if ($preferBasePath && isset($config['base_path'])) {
			$cookies['path'] = $config['base_path'];
		}

		return new ResponseCookieTemplate($cookies);
	}
}
